<?php

namespace  App\Services;

use App\Repositories\Contracts\{
    OrderRepositoryInterface,
    ProductRepositoryInterface,
    TableRepositoryInterface,
    TenantRepositoryInterface
};

class OrderService
{
    protected $orderRepository, $tenantRepository, $tableRepository, $productRepository;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        TenantRepositoryInterface $tenantRepository,
        TableRepositoryInterface $tableRepository,
        ProductRepositoryInterface $productRepository,
    ) {
        $this->orderRepository = $orderRepository;
        $this->tenantRepository = $tenantRepository;
        $this->tableRepository = $tableRepository;
        $this->productRepository = $productRepository;
    }

    public function createNewOrder(array $order)
    {
        $productsOrder = $this->getProductsByOrder($order['products'] ?? []);

        $identify = $this->getIdentifyOrder();
        $total    = $this->getTotalOrder($productsOrder);
        $status   = 'Aberto';
        $tenantId = $this->getTenantIdByOrder($order['token_company']);
        $comment = isset($order['comment']) ? $order['comment'] : '';
        $clientId = $this->getClientIdByOrder();
        $tableId  = $this->getTableIdByOrder($order['table'] ?? '');

        $order = $this->orderRepository->createNewOrder(
            $identify,
            $total,
            $status,
            $tenantId,
            $comment,
            $clientId,
            $tableId
        );

        $this->orderRepository->registerProductsOrder($order->id, $productsOrder);
        return $order;
    }

    private function getProductsByOrder(array $productsOrder): array
    {
        $products = array();

        foreach ($productsOrder as $productOrder) {
            $product = $this->productRepository->getProductByUuid($productOrder['identify']);
            array_push($products, [
                'id' =>  $product->id,
                'amount' => $productOrder['amount'],
                'price' => $product->price
            ]);
        }
        return $products;
    }

    private function getIdentifyOrder(int $qtyCaracteres = 8)
    {
        $smalLetters = str_shuffle('adbcdefghijlmnopqrstuvxz');

        $numbers = (((date('Ymd') / 12) * 24) + mt_rand(800, 9999));
        $numbers .= 1234567890;

        $characters = $smalLetters . $numbers;
        $identify = substr(str_shuffle($characters), 0, $qtyCaracteres);

        $existsIdentify = $this->orderRepository->getIdentifyOrder($identify);

        if ($existsIdentify) {
            $this->getIdentifyOrder($qtyCaracteres + 1);
        }

        return $identify;
    }


    private function getTotalOrder(array $products): float
    {
        $total = 0;
        foreach ($products as $product) {
            $total += ($product['price'] * $product['amount']);
        }
        return (float) $total;
    }

    private function getTenantIdByOrder(string $uuid)
    {
        $tenant = $this->tenantRepository->getTenantByUuid($uuid);
        return $tenant->id;
    }

    private function getClientIdByOrder()
    {
        return  auth()->check() ?  auth()->user()->id : '';
    }

    private function getTableIdByOrder(string $uuid = '')
    {
        if ($uuid) {
            $table = $this->tableRepository->getTableByUuid($uuid);
            return $table->id;
        }
        return '';
    }

    public function getOrderByIdentify(string $identify)
    {
        return $this->orderRepository->getOrderByIdentify($identify);
    }

    public function getOrderByClient()
    {
        $clientId = $this->getClientIdByOrder();

        return $this->orderRepository->getOrderByClientId($clientId);
    }
}
