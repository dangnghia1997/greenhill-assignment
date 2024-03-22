<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Interfaces\TempFileRepositoryInterface;
use App\Models\TempFile;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class TempFileRepository implements TempFileRepositoryInterface
{
    public function __construct(private TempFile $model)
    {}

    /**
     * @param int $id
     * @return Model|null
     */
    public function get(int $id): Model|null
    {
        $query = $this->model->newQuery();
        return $query->where('id', $id)->first();
    }

    /**
     * @param string $path
     * @return int|null
     */
    public function save(string $path): int|null
    {
        return $this->model->create(['path' => $path])?->id ?? null;
    }
}
