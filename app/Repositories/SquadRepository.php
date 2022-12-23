<?php

namespace App\Repositories;

use App\Interfaces\SquadInterface;
use App\Models\Squad;
use App\Models\SquadEmployee;
use Illuminate\Contracts\Pagination\Paginator;

class SquadRepository implements SquadInterface
{
    /**
     * @param  Squad  $squad
     */
    public function __construct(protected Squad $squad)
    {
    }

    /**
     * @param  string|null  $search
     * @param  int  $perPage
     * @return Paginator
     */
    public function getFiltered(?string $search = null, int $perPage = 10): Paginator
    {
        return $this->squad
            ->query()
            ->when($search, function ($query, $search) {
                $query->orWhere('name', 'ilike', "%{$search}%");
            })
            ->with(['employees', 'foreman'])
            ->paginate($perPage);
    }

    /**
     * @param  Squad  $squad
     * @param  array  $data
     * @return void
     */
    public function sync(Squad $squad, array $data): void
    {
        foreach ($data as $datum) {
            SquadEmployee::create([
                'squad_id' => $squad->id,
                'employee_id' => $datum['id'],
                'start_date' => $datum['squad_start_date'],
            ]);
        }
    }

    /**
     * @param  Squad  $squad
     * @param  array  $employees
     * @param  array  $removedEmployees
     * @return void
     */
    public function syncUpdate(Squad $squad, array $employees, array $removedEmployees): void
    {
        if (count($removedEmployees)) {
            foreach ($removedEmployees as $removedEmployee) {
                SquadEmployee::where('employee_id', $removedEmployee['id'])
                    ->whereNull('end_date')
                    ->where('squad_id', $squad->id)
                    ->update(['end_date' => is_null($removedEmployee['squad_end_date']) ? now() : $removedEmployee['squad_end_date']]);
            }
        }

        foreach ($employees as $employee) {
            SquadEmployee::firstOrCreate(
                [
                    'squad_id' => $squad->id,
                    'employee_id' => $employee['id'],
                ],
                [
                    'start_date' => $employee['squad_start_date'],
                ]
            );
        }

    }
}
