<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scope extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->hasMany(User::class, 'scope_id', 'id');
    }

    public function scope()
    {
        return $this->hasMany(Project::class, 'scope_id', 'id');
    }
}
