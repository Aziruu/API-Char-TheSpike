<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SkillCharacters extends Model
{
    protected $fillable = ['character_id', 'skill_name', 'cooldown', 'efficiency', 'description'];

    public function character()
    {
        return $this->belongsTo(Character::class);
    }
}
