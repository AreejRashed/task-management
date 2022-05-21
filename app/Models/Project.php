<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public function projectBeneficiaries()
    {
        return $this->hasMany(ProjectBeneficiaries::class, 'project_id', 'id');
    }

    public function donor()
    {
        return $this->belongsTo(Donor::class, 'donor_id', 'id');
        
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
        
    }

    public function scope()
    {
        return $this->belongsTo(Scope::class, 'scope_id', 'id');
    }

}
