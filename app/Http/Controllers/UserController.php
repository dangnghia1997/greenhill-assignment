<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserCollection;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\UserServiceInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(private UserServiceInterface $userService)
    {}

    /**
     * @param Request $request
     * @return UserCollection
     */
    public function getMembers(Request $request): UserCollection
    {
        $members = $this->userService->getMembers();
        $availableGroupUserIds = $this->userService->getAvailableGroupUserIDs();
        return new UserCollection($members, $availableGroupUserIds);
    }
}
