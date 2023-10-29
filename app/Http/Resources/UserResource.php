<?php

namespace App\Http\Resources;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name'=> $this->name,
            'family' => $this->family,
            'email' => $this->email,
            'block' => $this->block,
            'images' =>   $this->whenLoaded('medias', function () {
                return MediaResource::collection($this->medias);
            }),
           'comments' => $this->whenLoaded('comments' , fn()=> CommentResource::collection($this->comments)),
            'views' => $this->whenLoaded('views' , function (){
                ViewResource::collection($this->views);
            }),


        ];
    }
}
