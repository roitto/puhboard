<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'id' => (string) $this->uuid,
            'type' => (string) 'user',
            'attributes' => (object) [
                'name' => (string) $this->name,
                'email' => isset($this->email) ? (string) $this->email : null,
                'settings' => isset($this->settings) ? (object) $this->settings : null,
            ],
        ];
    }
}
