<?php

namespace  App\Services;

use App\Repositories\Contracts\{
    OrderRepositoryInterface,
    TableRepositoryInterface,
    TenantRepositoryInterface
};
use Dotenv\Util\Str;

class OrderService
{
    protected $orderRepository, $tenantRepository, $tableRepository;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        TenantRepositoryInterface $tenantRepository,
        TableRepositoryInterface $tableRepository
    ) {
        $this->orderRepository = $orderRepository;
        $this->tenantRepository = $tenantRepository;
        $this->tableRepository = $tableRepository;
    }

    public function createNewOrder(array $order)
    {
        $identify = $this->getIdentifyOrder();
        $total    = $this->getTotalOrder([]);
        $status   = 'Aberto';
        $tenantId = $this->getTenantIdByOrder($order['token_company']);
        $clientId = $this->getClientIdByOrder();
        $tableId  = $this->getTableIdByOrder($order['table']);

        $order = $this->orderRepository->createNewOrder(
            $identify,
            $total,
            $status,
            $tenantId,
            $clientId,
            $tableId
        );

        return $order;
    }

    private function getIdentifyOrder(int $qtyCaracteres = 8)
    {
        $smalLetters = str_shuffle('adbcdefghijlmnopqrstuvxz');

        $numbers = (((date('Ymd') / 12) * 24) + mt_rand(800, 9999));
        $numbers .= 1234567890;

        $characters = $smalLetters . $numbers;
        $identify = substr(str_shuffle($characters), 0, $qtyCaracteres);

        return $identify;
    }


    private function getTotalOrder(array $products): float
    {
        return (float) 90; //value fake
    }

    private function getTenantIdByOrder(string $uuid)
    {
        $tenant = $this->tenantRepository->getTenantByUuid($uuid);
        return $tenant->id;
    }

    private function getClientIdByOrder()
    {
        return  auth()->check() ?  auth()->user() : '';
    }

    private function getTableIdByOrder(string $uuid = '')
    {
        if ($uuid) {
            $table = $this->tableRepository->getTableByUuid($uuid);
            return $table->id;
        }
        return '';
    }
}
