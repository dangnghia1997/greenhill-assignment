<?php

namespace App\Http\Resources;

use App\Interfaces\GroupUserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
{
    private Collection $availableGroupUserIds;

    public function __construct($resource, Collection $availableGroupUserIds)
    {
        parent::__construct($resource);
        $this->availableGroupUserIds = $availableGroupUserIds;
    }

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection->map(function ($user) {
                return [
                    'id' => $user->id,
                    'group_id' => $user->group_id,
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'active' => $user->active,
                ];
            }),
            'available_group_user_ids' => $this->availableGroupUserIds->pluck('id')
        ];
    }
}
