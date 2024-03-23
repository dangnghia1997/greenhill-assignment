<?php
declare(strict_types=1);

namespace App\Exports;

use App\Interfaces\Data\UserInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromQuery, WithHeadings
{
    use Exportable;

    private array $ids = [];

    /**
     * @param array $ids
     */
    public function __construct(array $ids)
    {
        $this->ids = $ids;
    }

    /**
     * @return string[]
     */
    public function headings(): array
    {
        return [
            'ID',
            'Group ID',
            'First Name',
            'Last Name',
            'Email',
            'Phone',
            'Created Date',
            'Updated Date',
        ];
    }

    public function query()
    {
        return User::query()
            ->select([
                UserInterface::ID,
                UserInterface::GROUP_ID,
                UserInterface::FIRST_NAME,
                UserInterface::LAST_NAME,
                UserInterface::EMAIL,
                UserInterface::PHONE,
                Model::CREATED_AT,
                Model::UPDATED_AT
            ])
            ->where('group_id', 3) // Get only member
            ->whereIn('id', $this->ids);
    }
}
