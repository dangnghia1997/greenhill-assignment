<?php
declare(strict_types=1);

namespace App\Services;

use App\Interfaces\GroupUserRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\UserServiceInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class UserService implements UserServiceInterface
{

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
        return $this->groupUserRepository->getAvailableGroupIdList();
    }

    public function changeGroupIdTo(int $userId, int $groupId): int
    {
        return $this->userRepository->changeGroupIdTo($userId, $groupId);
    }
}
