<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'flag' => $this->flag,
            'title' => $this->title,
            'image' => $this->image,
            'price' => $this->price,
            'description' => $this->description,
            'data_created' => Carbon::parse($this->created_at)->format('d/m/Y')
        ];
    }
}
