<?php

namespace App\Repositories;

use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Support\Facades\DB;

class CategoryRepository implements CategoryRepositoryInterface
{
    protected $table;

    public function __construct()
    {
        $this->table = 'categories';
    }

    public function getCategoryByTenantUuid(string $uuid)
    {
        return DB::table($this->table)->join('tenants', 'tenants.id', '=', 'categories.tenant_id')
            ->where('tenants.uuid', $uuid)
            ->select('categories.*')
            ->get();
    }
    public function getCategoryByTenantId(int $id)
    {
        return DB::table($this->table)->where('tenant_id', $id)->paginate(5);
    }


    public function getCategoryByUuid(string $uuid)
    {
        return DB::table($this->table)->where('uuid', $uuid)->first();
    }
}
