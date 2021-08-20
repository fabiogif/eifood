<?php

namespace App\Repositories\Contracts;

interface ProductRepositoryInterface
{
    public function getProductByTenantId(int $idTentant, array $categories);
    public function getProductByFlag(string $flag);
}
