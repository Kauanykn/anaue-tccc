<?php

namespace App\Services;

use App\Models\ChatMessage;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class GeminiChatService
{
    public function answer(
        string $question,
        string $documentationContext,
        Collection $history
    ): string {
        $systemInstruction = <<<TEXT
Você é a Mia, assistente virtual do Anauê, um buffet infantil em Tatuí-SP.

Converse de forma natural, simpática e alegre, como no WhatsApp. Entenda abreviações, erros de digitação e perguntas informais; não exija que a pessoa use os mesmos termos da documentação.

REGRAS:
- Para fatos específicos do Anauê (preços, pacotes, regras do site, horários, contato), use a documentação abaixo. Nunca invente nem deduza esses detalhes. Se não estiver na documentação, diga com naturalidade que não tem essa informação e sugira falar com a equipe.
- Para qualquer outro assunto (cultura geral, ideias de temas e brincadeiras, conversas descontraídas, perguntas curiosas ou divertidas), responda livremente com seu conhecimento geral, sempre de forma leve e amigável.
- Se a pergunta for sobre uma possibilidade do buffet que não está na documentação (ex.: um tema muito específico), não afirme que o Anauê faz ou não faz; diga que não tem essa informação e sugira confirmar com a equipe.
- Se a pergunta pedir uma orientação geral para pedir orçamento, explique de forma simples quais informações ajudam (data, tipo de evento, número aproximado de convidados e contato) e diferencie isso dos campos realmente obrigatórios informados na documentação. Se a pessoa perguntar como solicitar pelo site, oriente-a para a página de orçamento e mencione que precisa estar conectada.
- Responda em texto simples, sem markdown (sem ** ou *).
- Respostas curtas e diretas.

DOCUMENTAÇÃO RELEVANTE (pode estar vazia se a busca não encontrou um trecho; responda a conversa mesmo assim seguindo as regras acima):
{$documentationContext}
TEXT;

        $contents = $history
            ->map(function (ChatMessage $message) {
                return [
                    'role' => $message->role === 'assistant' ? 'model' : 'user',
                    'parts' => [
                        ['text' => $message->content],
                    ],
                ];
            })
            ->push([
                'role' => 'user',
                'parts' => [
                    ['text' => $question],
                ],
            ])
            ->values()
            ->all();

        $payload = [
            'systemInstruction' => [
                'parts' => [
                    ['text' => $systemInstruction],
                ],
            ],
            'contents' => $contents,
            'generationConfig' => [
                'temperature' => 0.4,
                'maxOutputTokens' => 1500,
            ],
        ];

        $models = array_filter([
            config('services.gemini.model'),
            config('services.gemini.fallback_model'),
        ]);

        $response = null;

        foreach ($models as $model) {
            $response = Http::timeout(40)
                ->acceptJson()
                ->withHeaders(['x-goog-api-key' => config('services.gemini.key')])
                ->post(
                    'https://generativelanguage.googleapis.com/v1beta/models/' . $model . ':generateContent',
                    $payload
                );

            if (! in_array($response->status(), [429, 500, 503], true)) {
                break;
            }
        }

        if ($response->failed()) {
            throw new RequestException($response);
        }

        $parts = data_get($response->json(), 'candidates.0.content.parts', []);

        $answer = collect($parts)
        ->filter(fn ($part) => isset($part['text']) && empty($part['thought']))
        ->pluck('text')
        ->implode('');

        if (! is_string($answer) || trim($answer) === '') {
            return 'Não encontrei essa informação na documentação disponível, mas ficarei feliz em ajudar com outras dúvidas sobre o buffet! 😊';
        }

        return trim($answer);
    }
}