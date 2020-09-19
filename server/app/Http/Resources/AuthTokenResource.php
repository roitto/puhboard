<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthTokenResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        JsonResource::wrap('data');

        return (object) [
            'id' => (string) '1000',
            'type' => (string) 'authorization',
            'attributes' => (object) [
                'token' => (string) $this->token,
                'expires_in' => (string) $this->expires_in,
            ],
        ];
    }
}
