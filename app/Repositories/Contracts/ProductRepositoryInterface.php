<?php

namespace App\Repositories\Contracts;

interface ProductRepositoryInterface
{
    public function getProductByTenantId(int $idTentant, array $categories);
    public function getProductByUuid(string $uuid);
}
