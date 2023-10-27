<?php

namespace App\Import;

use ApiPlatform\Validator\ValidatorInterface;
use App\Entity\Band;
use Doctrine\ORM\EntityManagerInterface;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Symfony\Component\HttpFoundation\File\File;

class XlsxFileImporter implements ImporterInterface
{
    private const MIME_TYPE = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';

    public function __construct(
        private readonly ValidatorInterface $validator,
        private readonly EntityManagerInterface $entityManager,
    )
    {
    }

    public function support(File $file): bool
    {
        return $file->getMimeType() === self::MIME_TYPE;
    }

    public function import(File $file): void
    {
        $spreadsheet = IOFactory::load($file->getRealPath());
        $worksheet = $spreadsheet->getActiveSheet();
        foreach ($worksheet->getRowIterator(startRow: 2) as $row) {
            $rowIndex = $row->getRowIndex();
            $band = new Band();
            $band->setName($worksheet->getCell([1, $rowIndex])?->getValue());
            $band->setOrigin($worksheet->getCell([2, $rowIndex])?->getValue());
            $band->setCity($worksheet->getCell([3, $rowIndex])?->getValue());
            $band->setStartYear($worksheet->getCell([4, $rowIndex])?->getValue());
            $band->setEndYear($worksheet->getCell([5, $rowIndex])?->getValue());
            $band->setFoundingMembers($worksheet->getCell([6, $rowIndex])?->getValue());
            $band->setMembersCount($worksheet->getCell([7, $rowIndex])?->getValue());
            $band->setTrend($worksheet->getCell([8, $rowIndex])?->getValue());
            $band->setSummary($worksheet->getCell([9, $rowIndex])?->getValue());

            $this->validator->validate($band);
            $this->entityManager->persist($band);
        }

        $this->entityManager->flush();
    }
}
