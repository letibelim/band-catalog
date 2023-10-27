<?php

namespace App\Import;

use Symfony\Component\HttpFoundation\File\File;

class XlsxFileImporter implements ImporterInterface
{
    private const MIME_TYPE = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';

    public function support(File $file): bool
    {
        return $file->getMimeType() === self::MIME_TYPE;
    }

    public function import(File $file): void
    {
        dump('import file');

    }
}
