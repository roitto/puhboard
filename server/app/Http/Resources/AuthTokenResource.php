<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthTokenResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * https://jsonapi.org/format/#error-objects
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $this->resource = (object) [
            'id' => (string) '1000',
            'type' => (string) 'authorization',
            'attributes' => (object) [
                'access_token' => (string) $this->token,
                'token_type' => (string) 'bearer',
                'access_token' => (string) $this->token,
            ],
        ];
    }
}
