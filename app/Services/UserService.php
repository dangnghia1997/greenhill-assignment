<?php
declare(strict_types=1);

namespace App\Services;

use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\UserServiceInterface;
use Illuminate\Database\Eloquent\Collection;

class UserService implements UserServiceInterface
{

    public function __construct(private UserRepositoryInterface $userRepository)
    {}

    /**
     * @return Collection
     */
    public function getMembers(): Collection
    {
        return $this->userRepository->getUserByGroupId(3);
    }
}
