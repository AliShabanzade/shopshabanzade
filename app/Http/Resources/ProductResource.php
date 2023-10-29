<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=> $this->id,
            'user' =>   $this->whenLoaded('user', function () {
                return UserResource::make($this->user);
            }),
//            'user'  => $this->whenLoaded('user' , fn()=> UserResource::make($this->user)),
//            'user' => UserResource::make($this->user),
            'title' => $this->title,
            'body' => $this->body,
            'inventory' => $this->inventory,
            'publish' => $this->published,
            'price'=> $this->price,
            'comment'    => $this->whenLoaded('comments', fn() => CommentResource::collection($this->comments)),
            'like'       => $this->whenLoaded('likes', function () {
                return LikeResource::collection($this->likes);
            }),
            'view'       => $this->whenLoaded('views', fn() => ViewResource::collection($this->views)),
            'media'      => $this->whenLoaded('medias', function () {
                return MediaResource::collection($this->medias);


            }),
            'comments_count' => $this->comments_count,
            'likes_count'=> $this->likes_count,
            'views_count'=> $this->views_count,
        ];
    }
}
