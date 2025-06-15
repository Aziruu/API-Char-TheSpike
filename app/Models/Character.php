<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    protected $fillable = [
        'name',
        'rank', 
        'role',
        'power',
        'speed',
        'jump',
        'deff',
        'avatar'
    ];

     public function team()
    {
        return $this->belongsTo(Team::class);
    }

        public function skillEfficiencies()
    {
        return $this->hasMany(SkillCharacters::class);
    }
}