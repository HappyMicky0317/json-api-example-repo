<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use TiMacDonald\JsonApi\JsonApiResource;

class ProfilePictureResource extends JsonApiResource
{
    public function toAttributes(Request $request): array
    {
        return [
            'url' => $this->url,
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }

    public function toRelationships(Request $request): array
    {
        return [
            'user' => fn () => UserResource::collection($this->user),
        ];
    }
}
