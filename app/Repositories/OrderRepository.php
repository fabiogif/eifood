<?php

namespace App\Repositories;

use App\Models\Order;
use App\Repositories\Contracts\OrderRepositoryInterface;
use Illuminate\Support\Facades\DB;

class OrderRepository implements OrderRepositoryInterface
{
    protected $entify;

    public function __construct(Order $order)
    {
        $this->entify = $order;
    }

    public function createNewOrder(
        string $identify,
        float $total,
        string $status,
        int $tenantId,
        string $comment = '',
        $clientId = '',
        $tableId = ''
    ) {

        $data = [
            'identify' => $identify,
            'total' => $total,
            'status' => $status,
            'tenant_id' => $tenantId,
            'comment' => $comment
        ];

        if ($clientId) {
            $data['client_id'] = $clientId;
        }
        if ($tableId) {
            $data['table_id'] = $tableId;
        }

        $order = $this->entify->create($data);

        return $order;
    }

    public function getIdentifyOrder(string $identify)
    {
        return $this->entify->where('identify', $identify)->first();
    }

    public function registerProductsOrder(int $orderId, array $products)
    {
        $orderProduct = array();
        $order = $this->entify->find($orderId);
        foreach ($products as $product) {
            $orderProduct[$product['id']] = [
                'amount' => $product['amount'],
                'price' => $product['price']
            ];
        }
        $order->products()->attach($orderProduct);
    }
    public function getOrderByIdentify(string $identify)
    {
        return $this->entify->where('identify', $identify)->first();
    }

    public function getOrderByClientId(int $clientId)
    {
        $orders = $this->entify->where('client_id', $clientId)->paginate(5);

        return $orders;
    }
}
