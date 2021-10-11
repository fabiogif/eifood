<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\EvaluationService;
use App\Http\Requests\Api\StoreUpdateEvaluationOrder;
use App\Http\Resources\EvaluationResource;
use Illuminate\Http\Request;


class EvaluationApiController extends Controller
{
    protected $evaluationsService;


    public function __construct(EvaluationService $evaluationsService)
    {
        $this->evaluationsService = $evaluationsService;
    }


    public function store(StoreUpdateEvaluationOrder $request)
    {
        $data = $request->only('stars', 'comment');
        $evaluantion = $this->evaluationsService->createNewEvoluation($request->identifyOrder, $data);

        return new EvaluationResource($evaluantion);
    }
}
