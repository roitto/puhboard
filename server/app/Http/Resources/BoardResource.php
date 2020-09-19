<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BoardResource extends JsonResource
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
            'id' => (string) $this->url,
            'type' => (string) 'board',
            'attributes' => (object) [
                'name' => (string) $this->name,
                'url' => (string) $this->url,
                'url_short' => (string) $this->url_short,
                'description' => (string) $this->description,
                'icon' => (string) $this->icon,
            ],
        ];
    }
}
