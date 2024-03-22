<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\MemberBulkUpdateRequest;
use App\Http\Requests\MemberUpdateRequest;
use App\Http\Resources\UserCollection;
use App\Interfaces\UserServiceInterface;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
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
        $fileId = (int)$request->get('file_id', 0);
        $members = $this->userService->getMembers($fileId);
        $availableGroupUserIds = $this->userService->getAvailableGroupUserIDs();
        return new UserCollection($members, $availableGroupUserIds);
    }

    /**
     * @param MemberUpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(MemberUpdateRequest $request, int $id): JsonResponse
    {
        $changeTo = (int)$request->get('change_to');

        try {
            $success = (bool)$this->userService->changeGroupIdTo($id, $changeTo);
            return response()->json([
                'success' => $success
            ]);
        } catch (QueryException $exception) {
            $availableGroupIds = $this->userService->getAvailableGroupUserIDs()->pluck('id')->toArray();
            return response()->json([
                'error' => "change_to value should be in these values [" . implode(",", $availableGroupIds) . "]"
            ], 422);
        }
    }

    /**
     * @param MemberBulkUpdateRequest $request
     * @return JsonResponse
     */
    public function bulkUpdate(MemberBulkUpdateRequest $request): JsonResponse
    {
        $items = $request->get('items', []);
        foreach ($items as $item) {
            try {
                $this->userService->changeGroupIdTo((int)$item['user_id'], (int)$item['change_to']);
            } catch (QueryException $e) {
                $availableGroupIds = $this->userService->getAvailableGroupUserIDs()->pluck('id')->toArray();
                return response()->json([
                    'error' => "Fail on user_id=". $item['user_id'] ." change_to value should be in these values [" . implode(",", $availableGroupIds) . "]"
                ], 422);
            }
        }

        return response()->json([
            'success' => true
        ]);
    }
}
