<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CharacterSkillResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'character_id' => $this->id,
            'character_name' => $this->name,
            'skills' => $this->skills->map(function ($skill) {
                return [
                    'id' => $skill->id,
                    'name' => $skill->name,
                    'cooldown' => $skill->pivot->cooldown,
                    'efficiency' => $skill->pivot->efficiency,
                ];
            }),
        ];
    }
}