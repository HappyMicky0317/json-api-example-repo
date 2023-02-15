<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use TiMacDonald\JsonApi\JsonApiResource;

class CommentResource extends JsonApiResource
{
    public function toAttributes(Request $request): array
    {
        return [
            'content' => $this->content,
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }

    public function toRelationships(Request $request): array
    {
        return [
            'user' => fn () => UserResource::make($this->user),
            'post' => fn () => PostResource::make($this->post),
        ];
    }
}
