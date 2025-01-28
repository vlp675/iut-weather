<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserRessource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'user_id' => $this->user_id,
            'place_id' => $this->place_id,
            'is_favorite' => $this->is_favorite,
            'send_forecast' => $this->send_forecast,
            'place' => $this->place ? [
                'name' => $this->place->name,
                'created_at' => $this->place->created_at,
                'updated_at' => $this->place->updated_at,
            ] : null,
        ];
    }
}
