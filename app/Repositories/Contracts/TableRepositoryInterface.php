<?php

namespace App\Repositories\Contracts;

interface TableRepositoryInterface
{
    public function getTableByTenantUuid(string $uuid);
    public function getTableByTenantId(int $id);
    public function getTableByIdentify(int $identify);
}
