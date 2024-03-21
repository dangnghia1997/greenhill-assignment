<?php
declare(strict_types=1);

namespace App\Interfaces\Data;

interface GroupUserInterface
{
    const ROLE_ADMIN = "Admin";
    const ROLE_MOD = "Mod";
    const ROLE_MEMBER = "Member";

    const ID = "id";
    const TITLE = "title";
    const ACTIVE = "active";
}
