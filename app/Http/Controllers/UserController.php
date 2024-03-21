<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\MemberUpdateRequest;
use App\Http\Resources\UserCollection;
use App\Interfaces\UserServiceInterface;
use Illuminate\Database\QueryException;
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

    /**
     * @param MemberUpdateRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(MemberUpdateRequest $request, int $id): \Illuminate\Http\JsonResponse
    {
        $changeTo = (int)$request->get('change_to');

        try {
            $success = (bool)$this->userService->changeGroupIdTo($id, $changeTo);
            return response()->json([
                'success' => $success
            ]);
        } catch (QueryException $queryException) {
            $availableGroupIds = $this->userService->getAvailableGroupUserIDs()->pluck('id')->toArray();
            return response()->json([
                'error' => "change_to value should be in these values [" . implode(",", $availableGroupIds) . "]"
            ], 422);
        }
    }
}
