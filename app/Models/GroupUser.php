<?php
declare(strict_types=1);

namespace App\Models;

use App\Interfaces\Data\GroupUserInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupUser extends Model implements GroupUserInterface
{
    use HasFactory;

    protected $table = "group_user";

    /**
     * @param string $title
     * @return int
     */
    public function getRoleId(string $title): int
    {
        $roles = $this->getAllRoles();
        return $roles[$title] ?? 3;
    }

    /**
     * @return int[]
     */
    private function getAllRoles(): array
    {
        return [
            self::ROLE_ADMIN => 1,
            self::ROLE_MOD => 2,
            self::ROLE_MEMBER => 3
        ];
    }
}
