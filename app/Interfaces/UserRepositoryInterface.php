<?php
declare(strict_types=1);

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    /**
     * @param int $groupId
     * @return Collection
     */
    public function getUserByGroupId(int $groupId): Collection;
}
