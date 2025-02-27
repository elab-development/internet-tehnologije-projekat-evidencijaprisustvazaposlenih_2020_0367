<?php

namespace App\Http\Resources\Desk;

use Illuminate\Http\Resources\Json\JsonResource;

class DeskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public static $wrap = 'desk';

    public function toArray($request)
    {
        return [
            'name' => $this->resource->name,
        ];
    }
}
