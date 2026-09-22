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
Você é o assistente virtual do sistema.

Responda exclusivamente usando a documentação fornecida abaixo.
Não use conhecimento externo, não invente recursos, não faça suposições e não responda perguntas que não estejam sustentadas pela documentação.

Se a resposta não estiver claramente presente na documentação, responda exatamente:

"Não encontrei essa informação na documentação disponível."

DOCUMENTAÇÃO:
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
                        'temperature' => 0.1,
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
            return 'Não encontrei essa informação na documentação disponível.';
        }

        return trim($answer);
    }
}