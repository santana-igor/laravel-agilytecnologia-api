<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Timelog extends Model
{
    // Relationships
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function issue()
    {
        return $this->hasOne(Issue::class, 'id', 'issue_id');
    }

    // Getters and Mutators
    public function getUserIdAttribute($value)
    {
        return (int) $value;
    }

    public function getSecondsLoggedAttribute($value)
    {
        return (int) $value;
    }

    public function getComponentIdAttribute($value)
    {
        return (int) $value;
    }

    public function getNumberOfIssuesAttribute($value)
    {
        return (int) $value;
    }

}
