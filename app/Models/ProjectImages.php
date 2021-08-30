<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Project;

class ProjectImages extends Model
{
    protected $fillable = ['projects_id','image'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
