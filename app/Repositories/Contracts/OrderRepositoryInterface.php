<?php

namespace App\Repositories\Contracts;

interface OrderRepositoryInterface
{
    public function createNewOrder(
        string $identify,
        float $total,
        string $status,
        int $tenantId,
        string $comment,
        $clientId = '',
        $tableId = ''
    );
    public function getIdentifyOrder(string $identify);
    public function registerProductsOrder(int $orderId, array $products);
    public function getOrderByIdentify(string $identify);
    public function getOrderByClientId(int $clientId);
}
