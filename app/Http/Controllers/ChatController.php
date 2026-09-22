<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Services\DocumentationSearchService;
use App\Services\GeminiChatService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;

class ChatController extends Controller
{
    public function history(Request $request): JsonResponse
    {
        $messages = ChatMessage::query()
            ->where('user_id', $request->user()->id)
            ->latest()
            ->take(50)
            ->get()
            ->reverse()
            ->values()
            ->map(fn (ChatMessage $message) => [
                'role' => $message->role,
                'content' => $message->content,
                'created_at' => $message->created_at->format('d/m/Y H:i'),
            ]);

        return response()->json([
            'messages' => $messages,
        ]);
    }

    public function store(
        Request $request,
        DocumentationSearchService $documentationSearch,
        GeminiChatService $gemini
    ): JsonResponse {
        $validated = $request->validate([
            'message' => ['required', 'string', 'max:1000'],
        ]);

        $rateLimitKey = 'chat:user:' . $request->user()->id;

        if (RateLimiter::tooManyAttempts($rateLimitKey, 10)) {
            return response()->json([
                'message' => 'Você atingiu o limite de 10 mensagens por minuto. Aguarde um instante.',
            ], 429);
        }

        RateLimiter::hit($rateLimitKey, 60);

        $question = trim($validated['message']);

        $history = ChatMessage::query()
            ->where('user_id', $request->user()->id)
            ->latest()
            ->take(12)
            ->get()
            ->reverse()
            ->values();

        ChatMessage::create([
            'user_id' => $request->user()->id,
            'role' => 'user',
            'content' => $question,
        ]);

        $context = $documentationSearch->contextFor($question);

        if ($context === '') {
            $answer = 'Não encontrei essa informação na documentação disponível.';
        } else {
            try {
                $answer = $gemini->answer($question, $context, $history);
            } catch (RequestException $exception) {
                Log::error('Erro ao consultar Gemini.', [
                    'status' => $exception->response?->status(),
                    'body' => $exception->response?->body(),
                ]);

                return response()->json([
                    'message' => 'Não foi possível obter uma resposta agora. Tente novamente em alguns instantes.',
                ], 503);
            } catch (\Throwable $exception) {
                Log::error('Erro inesperado no chat.', [
                    'error' => $exception->getMessage(),
                ]);

                return response()->json([
                    'message' => 'Ocorreu um erro inesperado. Tente novamente.',
                ], 500);
            }
        }

        $assistantMessage = ChatMessage::create([
            'user_id' => $request->user()->id,
            'role' => 'assistant',
            'content' => $answer,
        ]);

        return response()->json([
            'message' => [
                'role' => $assistantMessage->role,
                'content' => $assistantMessage->content,
                'created_at' => $assistantMessage->created_at->format('d/m/Y H:i'),
            ],
        ]);
    }
}