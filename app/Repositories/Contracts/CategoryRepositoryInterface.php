<?php

namespace App\Repositories\Contracts;

interface CategoryRepositoryInterface
{
    public function getCategoryByTenantUuid(string $uuid);
    public function getCategoryByTenantId(int $id);
    public function getCategoryById(int $id);
}
