<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    // Relationships
    public function issues()
    {
        return $this->hasMany(Issue::class);
    }
}
