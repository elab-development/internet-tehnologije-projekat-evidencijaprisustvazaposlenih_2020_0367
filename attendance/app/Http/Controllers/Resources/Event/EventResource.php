<?php

namespace App\Http\Resources\Event;

use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public static $wrap = 'event';

    public function toArray($request)
    {
        return [
            'title' => $this->resource->title,
            'description' => $this->resource->description,
            'date' => $this->resource->date,
            'user' => $this->resource->user->name,
            'category' => $this->resource->category->name,
        ];
    }
}
