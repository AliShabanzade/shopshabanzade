<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
//            'uuid'       => $this->uuid,
            'title'      => $this->title,
            'body'       => $this->body,
            'published'  => $this->published,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user'       => $this->whenLoaded('user' ,fn() => UserResource::make($this->user)),
            //when loaded in short line
            'comment'    => $this->whenLoaded('comments', fn() => CommentResource::collection($this->comments)),
            //when loaded in complete form
            'like'       => $this->whenLoaded('likes', function () {
                return LikeResource::collection($this->likes);
            }),
            'view'       => $this->whenLoaded('views', fn() => ViewResource::collection($this->views)),
            'media'      => $this->whenLoaded('medias', function () {
                return MediaResource::collection($this->medias);
            }),
            'comments_count' => $this->comments_count,
            'views_count' => $this->views_count,
            'likes'=> $this->likes_count,


        ];
    }
}
