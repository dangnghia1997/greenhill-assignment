<?php
declare(strict_types=1);

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface GroupUserRepositoryInterface
{
    /**
     * @return Collection|array
     */
    public function getAvailableGroupIdList(): Collection|array;
}
