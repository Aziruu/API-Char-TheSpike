<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function characters()
    {
        return $this->belongsToMany(Character::class, 'character_skill')
                    ->withPivot('cooldown', 'efficiency')
                    ->withTimestamps();
    }
}

