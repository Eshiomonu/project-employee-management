<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'project_id',
        'name',
        'email',
        'role',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
