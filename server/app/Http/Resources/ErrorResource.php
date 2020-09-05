<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ErrorResource extends JsonResource
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
        JsonResource::wrap('errors');

        return (object) [
            'id' => (string) $this->id,
            'status' => (string) $this->status,
            'code' => (string) $this->code,
        ];
    }
}
