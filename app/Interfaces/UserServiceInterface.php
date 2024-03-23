<?php
declare(strict_types=1);

namespace App\Interfaces;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface UserServiceInterface
{
    /**
     * @param int $fileId
     * @return LengthAwarePaginator
     */
    public function getMembers(int $fileId): LengthAwarePaginator;

    /**
     * @return Collection|array
     */
    public function getAvailableGroupUserIDs(): Collection|array;

    /**
     * @param int $userId
     * @param int $groupId
     * @return int
     */
    public function changeGroupIdTo(int $userId, int $groupId): int;

    /**
     * @param int $fileId
     * @return array
     */
    public function getUserIdsFromFile(int $fileId): array;
}
