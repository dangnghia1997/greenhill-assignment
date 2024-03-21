<?php
declare(strict_types=1);

namespace App\Interfaces\Data;

interface UserInterface
{
    const ID = "id";
    const GROUP_ID = "group_id";
    const FIRST_NAME = "first_name";
    const LAST_NAME = "last_name";
    const EMAIL = "email";
    const PHONE = "phone";
    const ACTIVE = "active";
    const CREATED_AT = "created_at";
    const UPDATED_AT = "updated_at";
}
