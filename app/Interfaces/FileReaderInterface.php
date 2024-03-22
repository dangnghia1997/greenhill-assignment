<?php
declare(strict_types=1);

namespace App\Interfaces;

interface FileReaderInterface
{
    public function read(string $path, string $type): array;
}
