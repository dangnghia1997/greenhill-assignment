<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Interfaces\Data\UserInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(private User $model)
    {}

    /**
     * @param int $groupId
     * @return Collection
     */
    public function getUserByGroupId(int $groupId): Collection
    {
        $query = $this->model->newQuery();
        return $query->where(UserInterface::GROUP_ID, $groupId)->get();
    }
}
