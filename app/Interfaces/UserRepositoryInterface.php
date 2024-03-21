<?php
declare(strict_types=1);

namespace App\Interfaces;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface UserRepositoryInterface
{
    /**
     * @param int $groupId
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getUserByGroupId(int $groupId, int $perPage): LengthAwarePaginator;

    /**
     * @param int $userId
     * @param int $groupId
     * @return int
     */
    public function changeGroupIdTo(int $userId, int $groupId): int;
}
