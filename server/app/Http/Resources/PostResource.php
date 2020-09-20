<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $response = (object) [
            'id' => (string) $this->id,
            'type' => (string) 'post',
            'attributes' => (object) [
                'title' => (string) $this->title,
                'content' => (string) $this->content,
                'unique_identifier' => (string) $this->unique_identifier,
                'bumped_at' => (string) $this->bumped_at,
            ],
        ];

        if ($this->relationLoaded('children')) {
            $response->attributes->children = PostResource::collection($this->children);
        }

        return $response;
    }
}
