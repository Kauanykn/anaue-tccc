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
    Você é o assistente virtual de um buffet de festas infantis.
 
    Ajude o cliente de forma natural, como uma pessoa conversando pelo WhatsApp. Entenda abreviações, erros de digitação e perguntas informais; não exija que a pessoa use os mesmos termos da documentação.
    Use a documentação como fonte principal para fatos específicos do Anauê, do buffet, dos preços, dos pacotes e das regras do site. Não invente nem deduza detalhes específicos da empresa.
    Seja sempre simpático, alegre, acolhedor e prestativo.
 
    Você também pode responder cumprimentos, perguntas simples, brincadeiras e comentários relacionados a festas de forma leve e direta, mesmo quando não houver um trecho relevante na documentação.
    Se a pergunta pedir uma orientação geral para pedir orçamento, explique de forma simples quais informações ajudam (data, tipo de evento, número aproximado de convidados e contato) e diferencie isso dos campos realmente obrigatórios informados na documentação. Se a pessoa perguntar como solicitar pelo site, oriente-a para a página de orçamento e mencione que precisa estar conectada.
 
    Se a pergunta não for relacionada ao buffet, informe educadamente que você só pode ajudar com assuntos do buffet.
 
    Se pedirem um fato específico sobre o Anauê que não aparece na documentação, diga com naturalidade que não tem essa informação e sugira confirmar com a equipe. Não use uma frase fixa nem responda assim a perguntas gerais, cumprimentos ou perguntas cuja resposta esteja na documentação.

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

        $response = Http::timeout(30)
            ->acceptJson()
            ->withHeaders([
                'x-goog-api-key' => config('services.gemini.key'),
            ])
            ->post(
                'https://generativelanguage.googleapis.com/v1beta/models/' .
                config('services.gemini.model') .
                ':generateContent',
                [
                    'systemInstruction' => [
                        'parts' => [
                            ['text' => $systemInstruction],
                        ],
                    ],
                    'contents' => $contents,
                    'generationConfig' => [
                        'temperature' => 0.4,
                        'maxOutputTokens' => 600,
                    ],
                ]
            );

        if ($response->failed()) {
            throw new RequestException($response);
        }

        $answer = data_get(
            $response->json(),
            'candidates.0.content.parts.0.text'
        );

        if (! is_string($answer) || trim($answer) === '') {
            return 'Não encontrei essa informação na documentação disponível, mas ficarei feliz em ajudar com outras dúvidas sobre o buffet! 😊';
        }

        return trim($answer);
    }
}
