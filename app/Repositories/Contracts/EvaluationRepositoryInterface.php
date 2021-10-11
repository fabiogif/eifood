<?php

namespace App\Repositories\Contracts;

interface EvaluationRepositoryInterface
{
    public function newEvaluationOrder(int $orderId, int $clientId, array $evaluation);
    public function getEvaluationByOrder(int $orderId);
    public function getEvaluationByClient(int $clientId);
    public function getEvaluationById(int $id);
    public function getEvaluationByOrderIdClientId(int $orderId, int $clientId);
}
