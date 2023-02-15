<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use TiMacDonald\JsonApi\JsonApiResource;

class PostResource extends JsonApiResource
{
    public function toAttributes(Request $request): array
    {
        return [
            'title' => $this->title,
            'content' => $this->content,
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }

    public function toRelationships(Request $request): array
    {
        return [
            'user' => fn () => UserResource::make($this->user),
            'comments' => fn () => CommentResource::collection($this->comments),
            'tags' => fn () => TagResource::collection($this->tags),
        ];
    }
}
