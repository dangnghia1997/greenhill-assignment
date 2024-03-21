<?php
declare(strict_types=1);

namespace App\Interfaces;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface UserServiceInterface
{
    /**
     * @return LengthAwarePaginator
     */
    public function getMembers(): LengthAwarePaginator;

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
}
