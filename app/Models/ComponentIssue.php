<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComponentIssue extends Model
{
    // Relationships
    public function component()
    {
        return $this->hasOne(Component::class, 'id', 'component_id');
    }

    public function issue()
    {
        return $this->hasOne(Issue::class, 'id', 'issue_id');
    }

    // Getters and Mutators
    public function getComponentIdAttribute($value)
    {
        return (int) $value;
    }

    public function getIssueIdAttribute($value)
    {
        return (int) $value;
    }
}
