<?php

namespace App\Repositories;

use App\Repositories\Contracts\TableRepositoryInterface;
use Illuminate\Support\Facades\DB;

class TableRepository implements TableRepositoryInterface
{
    protected $table;

    public function __construct()
    {
        $this->table = 'tables';
    }

    public function getTableByTenantUuid(string $uuid)
    {
        return DB::table($this->table)->join('tenants', 'tenants.id', '=', 'tables.tenant_id')
            ->where('tenants.uuid', $uuid)
            ->select('tables.*')
            ->get();
    }
    public function getTableByTenantId(int $id)
    {
        return DB::table($this->table)->where('tenant_id', $id)->paginate(5);
    }


    public function getTableByUuid(string $uuid)
    {
        return DB::table($this->table)->where('uuid', $uuid)->first();
    }
}
