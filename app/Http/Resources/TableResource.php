<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class TableResource extends JsonResource
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
            'identify' => $this->uuid,
            'nameIdentify' => $this->identify,
            'description' => $this->description,
            'data_created' => Carbon::parse($this->created_at)->format('d/m/Y')
        ];
    }
}
