<?php

namespace  App\Services;

use App\Repositories\Contracts\EvaluationRepositoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;

class EvaluationService
{
    protected $evoluationRepository, $orderRepository;


    public function __construct(
        EvaluationRepositoryInterface $evoluationRepository,
        OrderRepositoryInterface $orderRepository
    ) {
        $this->evoluationRepository   = $evoluationRepository;
        $this->orderRepository = $orderRepository;
    }

    public function createNewEvoluation(string $identifyOrder, array $evaluation)
    {
        $clienteId = $this->getIdCliente();
        $order = $this->orderRepository->getOrderByIdentify($identifyOrder);

        return $this->evoluationRepository->newEvaluationOrder($order->id, $clienteId, $evaluation);
    }

    private function getIdCliente()
    {
        return auth()->user()->id;
    }
}
