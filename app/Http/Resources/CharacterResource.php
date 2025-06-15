<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CharacterResource extends JsonResource
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
            'name' => $this->name,
            'rank' => $this->rank,
            'skills' => $this->skillEfficiencies->map(function ($skill) {
                return [
                    'name' => $skill->skill_name,
                    'efficiency' => $skill->efficiency,
                    'description' => $skill->description,
                ];
            }),
            'team' => $this->team ? $this->team->name : null,
            'role' => $this->role,
            'power' => $this->power,
            'speed' => $this->speed,
            'jump' => $this->jump,
            'defense' => $this->deff,
            'avatar_url' => $this->avatar ? asset($this->avatar) : asset('uploads/avatars/default.png'),
        ];
    }
}
//