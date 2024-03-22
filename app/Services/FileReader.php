<?php
declare(strict_types=1);

namespace App\Services;

use App\Interfaces\FileReaderInterface;
use PhpOffice\PhpSpreadsheet\IOFactory;

class FileReader implements FileReaderInterface
{
    public function read(string $path, string $type = 'Xls'): array
    {
        $reader = IOFactory::createReader($type);
        $reader->setReadDataOnly(true);
        $spreadSheet = $reader->load($path);
        $activeSheet = $spreadSheet->getSheet($spreadSheet->getActiveSheetIndex());
        return $activeSheet->toArray();
    }
}
