<?php

namespace App\Http\Resources\User;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class UserLocationResource extends JsonResource
{
    public static $wrap = 'location';

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            'country_id'    =>  $this->country_id,
            'region_id'         =>  $this->region_id,
            'city_id'         =>  $this->city_id,
            'address'         =>  $this->address,
        ];
    }
}
