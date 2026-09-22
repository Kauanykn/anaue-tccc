<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class DocumentationSearchService
{
    private const MAX_DOCUMENTS = 3;

    private const MAX_DOCUMENT_LENGTH = 5000;

    public function search(string $question): Collection
    {
        $directory = base_path('docs/chat');

        if (! File::isDirectory($directory)) {
            return collect();
        }

        $keywords = $this->keywords($question);

        if ($keywords->isEmpty()) {
            return collect();
        }

        return collect(File::allFiles($directory))
            ->filter(fn ($file) => $file->getExtension() === 'md')
            ->map(function ($file) use ($keywords) {
                $content = File::get($file->getPathname());
                $normalizedContent = Str::lower($content);

                $score = $keywords->sum(
                    fn (string $keyword) => substr_count($normalizedContent, $keyword)
                );

                return [
                    'path' => str_replace(base_path('docs/chat') . DIRECTORY_SEPARATOR, '', $file->getPathname()),
                    'content' => Str::limit($content, self::MAX_DOCUMENT_LENGTH, ''),
                    'score' => $score,
                ];
            })
            ->filter(fn (array $document) => $document['score'] > 0)
            ->sortByDesc('score')
            ->take(self::MAX_DOCUMENTS)
            ->values();
    }

    private function keywords(string $text): Collection
    {
        preg_match_all('/[\p{L}\p{N}]{3,}/u', Str::lower($text), $matches);

        return collect($matches[0])
            ->unique()
            ->values();
    }

    public function contextFor(string $question): string
    {
        $documents = $this->search($question);

        if ($documents->isEmpty()) {
            return '';
        }

        return $documents
            ->map(function (array $document) {
                return "[Documento: {$document['path']}]\n{$document['content']}";
            })
            ->implode("\n\n---\n\n");
    }
}