<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ViewResource extends JsonResource
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
            'user' => UserResource::make($this->user),
            'viewable_id' => $this->viewable_id,
            'viewable_type' => $this-> viewable_type,
            'is_view' => $this->is_view,
        ];
    }
}
