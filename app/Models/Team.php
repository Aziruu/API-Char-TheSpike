<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    public function characters()
    {
        return $this->hasMany(Character::class);
    }
}
