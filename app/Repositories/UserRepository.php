<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Interfaces\Data\UserInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(private User $model)
    {}

    /**
     * @param int $groupId
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getUserByGroupId(int $groupId, int $perPage = 25): LengthAwarePaginator
    {
        $query = $this->model->newQuery();
        return $query->where(UserInterface::GROUP_ID, $groupId)->paginate($perPage);
    }

    /**
     * @param int $userId
     * @param int $groupId
     * @return int
     */
    public function changeGroupIdTo(int $userId, int $groupId): int
    {
        $query = $this->model->newQuery();
        return $query->where('id', $userId)->update(['group_id' => $groupId]);
    }
}
