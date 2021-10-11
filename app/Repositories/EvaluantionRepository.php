<?php

namespace App\Repositories;

use App\Models\Evaluation;
use App\Repositories\Contracts\EvaluationRepositoryInterface;

class EvaluantionRepository implements EvaluationRepositoryInterface
{
    protected $entity;

    public function __construct(Evaluation $evaluation)
    {
        $this->entity = $evaluation;
    }

    public function newEvaluationOrder(int $orderId, int $clientId, array $evaluation)
    {
        $data = [
            'client_id' => $clientId,
            'order_id' => $orderId,
            'comment' => isset($evaluation['comment']) ? $evaluation['comment'] : '',
            'stars' => isset($evaluation['stars']) ? $evaluation['stars'] : '',
        ];

        return $this->entity->create($data);
    }
    public function getEvaluationByOrder(int $orderId)
    {
        return $this->entity->where('order_id', $orderId)->get();
    }

    public function getEvaluationByClient(int $clientId)
    {
        return $this->entity->where('client_id', $clientId)->get();
    }

    public function getEvaluationById(int $id)
    {
        return $this->entity->find($id);
    }

    public function getEvaluationByOrderIdClientId(int $orderId, int $clientId)
    {
        return $this->entity
            ->where('order_id', $orderId)
            ->where('client_id', $clientId)
            ->first();
    }
}
