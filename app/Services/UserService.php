<?php
declare(strict_types=1);

namespace App\Services;

use App\Interfaces\FileReaderInterface;
use App\Interfaces\GroupUserRepositoryInterface;
use App\Interfaces\TempFileRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\UserServiceInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\IOFactory;

class UserService implements UserServiceInterface
{
    const AVAILABLE_GROUP_IDS_KEY = "AVAILABLE_GROUP_IDS_KEY";

    public function __construct(
        private UserRepositoryInterface $userRepository,
        private GroupUserRepositoryInterface $groupUserRepository,
        private TempFileRepositoryInterface $tempFileRepository,
        private FileReaderInterface $fileReader
    ) {}


    /**
     * @param int $fileId
     * @return LengthAwarePaginator
     */
    public function getMembers(int $fileId): LengthAwarePaginator
    {
        $ids = $this->getUserIdsFromFile($fileId);
        return $this->userRepository->getUserByGroupId(3, $ids);
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

    /**
     * @param int $fileId
     * @return array
     */
    public function getUserIdsFromFile(int $fileId): array
    {
        $key = "UPLOADED_FILE_$fileId";
        if (Cache::has($key)) {
            return Cache::get($key);
        }

        $tempFile = $this->tempFileRepository->get($fileId);
        $path = Storage::path($tempFile?->path ?? '');
        $type = Str::title(File::extension($path));
        $result = $this->fileReader->read($path, $type);
        unset($result[0]); // Remove header row
        $ids =  array_map(function($row) {
            return $row[0];
        }, $result);
        Cache::put($key, $ids, 60 * 5);
        return $ids;
    }
}
