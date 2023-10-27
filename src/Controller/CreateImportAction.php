<?php

namespace App\Controller;

use App\Entity\Import;
use App\Import\Importer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

#[AsController]
final class CreateImportAction extends AbstractController
{
    public function __invoke(Request $request, Importer $importer): Import
    {
        $uploadedFile = $request->files->get('file');
        if (!$uploadedFile) {
            throw new BadRequestHttpException('"file" is required');
        }

        if (!$importer->support($uploadedFile)) {
            throw new BadRequestHttpException('Unsupported File Type');
        }

        $import = new Import();
        $import->file = $uploadedFile;
        $importer->import($uploadedFile);

        return $import;
    }
}
