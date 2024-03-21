<?php
declare(strict_types=1);

namespace App\Services;

use App\Interfaces\GroupUserRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\UserServiceInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class UserService implements UserServiceInterface
{

    const AVAILABLE_GROUP_IDS_KEY = "AVAILABLE_GROUP_IDS_KEY";

    public function __construct(
        private UserRepositoryInterface $userRepository,
        private GroupUserRepositoryInterface $groupUserRepository
    ) {}


    /**
     * @return LengthAwarePaginator
     */
    public function getMembers(): LengthAwarePaginator
    {
        return $this->userRepository->getUserByGroupId(3);
    }

    /**
     * @return Collection|array
     */
    public function getAvailableGroupUserIDs(): Collection|array
    {
        if (Cache::has(self::AVAILABLE_GROUP_IDS_KEY)) {
            return Cache::get(self::AVAILABLE_GROUP_IDS_KEY);
        }
        $result = $this->groupUserRepository->getAvailableGroupIdList();
        Cache::put(self::AVAILABLE_GROUP_IDS_KEY, $result, 60 * 60);
        return $result;
    }

    /**
     * @param int $userId
     * @param int $groupId
     * @return int
     */
    public function changeGroupIdTo(int $userId, int $groupId): int
    {
        return $this->userRepository->changeGroupIdTo($userId, $groupId);
    }
}
