<?php
declare(strict_types=1);

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

interface TempFileRepositoryInterface
{
    /**
     * @param int $id
     * @return Model|null
     */
    public function get(int $id): Model|null;

    /**
     * @param string $path
     * @return int|null
     */
    public function save(string $path): int|null;
}
