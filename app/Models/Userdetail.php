<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Userdetail extends Model
{
    protected $fillable = ['user_id','bio','address','city','country','lat','long','bank','acc_no','acc_title'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
