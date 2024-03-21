<?php
declare(strict_types=1);

namespace App\Models;

use App\Interfaces\Data\UserInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements UserInterface
{
    use HasFactory;

    protected $table = "users";
}
