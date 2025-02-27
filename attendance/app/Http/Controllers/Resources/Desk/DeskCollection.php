<?php

namespace App\Http\Resources\Desk;

use Illuminate\Http\Resources\Json\ResourceCollection;

class DeskCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public static $wrap = 'desks';

    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
