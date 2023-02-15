<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use TiMacDonald\JsonApi\JsonApiResource;

class UserResource extends JsonApiResource
{
    public function toAttributes(Request $request): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'created_at' => $this->created_at->toDateTimeString(),
            // 'location' => 'Melbourne',
        ];
    }

    public function toRelationships(Request $request): array
    {
        return [
            'posts' => fn () => PostResource::collection($this->posts),
            'comments' => fn () => CommentResource::collection($this->comments),
            'profile_picture' => fn () => ProfilePictureResource::make($this->profilePicture),
            'random_array' => fn () => ['hello' => 'world'],
            'non_json_api_resource' => fn () => new class ('tim') extends JsonResource {
                public function toArray($request)
                {
                    return [
                        'name' => $this->resource,
                    ];
                }
            },
        ];
    }
}
