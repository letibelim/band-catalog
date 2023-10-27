<?php

namespace App\Import;

use LogicException;
use Symfony\Component\DependencyInjection\Attribute\TaggedIterator;
use Symfony\Component\HttpFoundation\File\File;

/**
 * General Importer for all file
 * Implement Chain of Responsability pattern
 */
class Importer implements ImporterInterface
{

    public function __construct(
        #[TaggedIterator('app.importer', exclude: [self::class])]
        private readonly iterable $importer
    ) {
    }

    public function support(File $file): bool
    {
        /** @var ImporterInterface $importer */
        foreach ($this->importer as $importer) {
            if ($importer->support($file)) {
                return true;
            }
        }

        return false;
    }

    public function import(File $file): void
    {
        /** @var ImporterInterface $importer */
        foreach ($this->importer as $importer) {
            if ($importer->support($file)) {
                $importer->import($file);
                return;
            }
        }
        throw new LogicException(
            'No importer exists for this file. A call to the support method must be done first'
        );
    }
}
