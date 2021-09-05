<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable =
    [
        'user_id',
        'project_id',
        'dboy_id',
        'to_user'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function dboy()
    {
        return $this->belongsTo('App\User','dboy_id','id');
    }

    public function touser()
    {
        return $this->belongsTo('App\User','to_user','id');
    }
    public function project()
    {
        return $this->belongsTo("App\Models\Project");
    }
}
