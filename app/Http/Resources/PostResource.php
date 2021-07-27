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
        return [
            'id' => $this->id,
            'title' =>$this->title,
            'body' => $this->body,
            'views' => $this->views,
            'category_name' => $this->category->name,
            'user' => new UserResource($this->user),
            'comments' => CommentResource::collection($this->comments),
            'tags' => TagResource::collection($this->tags)
        ];
    }
}
