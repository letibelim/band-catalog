<?php

namespace App\Controller;

use App\Entity\Import;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

#[AsController]
final class CreateImportAction extends AbstractController
{
    public function __invoke(Request $request): Import
    {
        $uploadedFile = $request->files->get('file');
        if (!$uploadedFile) {
            throw new BadRequestHttpException('"file" is required');
        }
        $import = new Import();
        $import->file = $uploadedFile;
        return $import;
    }
}
