<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Interfaces\GroupUserRepositoryInterface;
use App\Models\GroupUser;
use Illuminate\Database\Eloquent\Collection;

class GroupUserRepository implements GroupUserRepositoryInterface
{

    public function __construct(private GroupUser $model)
    {}

    /**
     * @return Collection|array
     */
    public function getAvailableGroupIdList(): Collection|array
    {
        $query = $this->model->newQuery();
        return $query->select('id')->get();
    }
}
