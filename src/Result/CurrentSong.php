<?php

declare(strict_types=1);

namespace NowPlaying\Result;

final class CurrentSong
{
    public string $text;

    public string $title;

    public string $artist;

    public function __construct(
        string $text = '',
        string $title = '',
        string $artist = '',
        string $delimiter = '-'
    ) {
        $text = $this->cleanUpString($text);
        $title = $this->cleanUpString($title);
        $artist = $this->cleanUpString($artist);

        if (empty($text) && (!empty($title) || !empty($artist))) {
            $textParts = [$artist, $title];
            $text = implode(' - ', array_filter($textParts));
        }

        if (!empty($text) && (empty($title) || empty($artist))) {
            $string_parts = explode($delimiter, $text) ?: [$text];

            // If not normally delimited, return "text" only.
            if (1 === \count($string_parts)) {
                $title = $text;
            } else {
                $title = trim(array_pop($string_parts) ?? '');
                $artist = trim(implode($delimiter, $string_parts));
            }
        }

        $this->text = $text;
        $this->title = $title;
        $this->artist = $artist;
    }

    private function cleanUpString(string $value): string
    {
        $value = htmlspecialchars_decode($value);

        return trim($value, " \t\n\r\0\x0B-");
    }
}
