<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    // Relationships
    public function components()
    {
        return $this->belongsToMany(Component::class);
    }
}
