<?php

namespace App\Support;

class UploadFileName
{
    public static function sanitize(string $fileName, int $maxLength = 120): string
    {
        // Strip path separators, filesystem-reserved characters, and characters
        // that break URLs or shell contexts: # is a URL fragment separator,
        // ' causes issues in HTML attribute values and some shell contexts.
        $clean = preg_replace('/[\\\\\\/:*?"\'<>#|\\x00-\\x1F\\x7F]+/u', '', $fileName) ?? $fileName;
        $clean = preg_replace('/\\s+/u', ' ', $clean) ?? $clean;
        $clean = trim($clean);

        if ($clean === '') {
            return '';
        }

        return mb_substr($clean, 0, $maxLength);
    }
}
