<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\TenantResource;
use App\Http\Resources\EvaluationResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'identify' => $this->identify,
            'total' => $this->total,
            'status' => $this->status,
            'date' => Carbon::parse($this->created_at)->format('d/m/Y'),
            'company' => new TenantResource($this->tenant),
            'client' => $this->client_id ? new ClientResource($this->client) : '',
            'table' => $this->table_id ? new TableResource($this->table) : '',
            'products' => ProductResource::collection($this->products),
            'evaluantion' => EvaluationResource::collection($this->evaluantion),

        ];
    }
}
