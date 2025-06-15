<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SkillCharacterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            'skill_name' => $this->skill_name,
            'cooldown' => $this->cooldown,
            'efficiency' => $this->efficiency,
            'description' => $this->description,
            'created_at' => $this->created_at,
        ];
    }
}
