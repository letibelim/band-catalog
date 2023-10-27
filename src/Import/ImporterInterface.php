<?php

namespace App\Import;

use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;
use Symfony\Component\HttpFoundation\File\File;

#[AutoconfigureTag('app.importer')]
interface ImporterInterface
{
    public function support(File $file): bool;

    public function import(File $file): void;
}
