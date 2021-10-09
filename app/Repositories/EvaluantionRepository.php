<?php

namespace App\Repositories;

use App\Models\Evaluation;
use App\Repositories\Contracts\EvaluationRepositoryInterface;

class EvaluantionRepository implements EvaluationRepositoryInterface
{
    protected $entity;

    public function newEvaluationOrder(int $orderId, int $clientId)
    {
    }
}
