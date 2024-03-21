<?php
declare(strict_types=1);

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface UserServiceInterface
{
    /**
     * @return Collection
     */
    public function getMembers(): Collection;
}
