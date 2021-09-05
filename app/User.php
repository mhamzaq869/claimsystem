<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role','photo','status','provider','provider_id','online'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function orders(){
        return $this->hasMany('App\Models\Order');
    }
    public function userdetail(){
        return $this->hasOne('App\Models\Userdetail');
    }
    public function bid(){
        return $this->hasOne('App\Models\Bid');
    }
    public function product(){
        return $this->hasMany('App\Models\Product');
    }
    public function contract(){
        return $this->belongsTo('App\Models\Contract');
    }
    public function contbyreq(){
        return $this->belongsTo('App\Models\Contract','req_by_user');
    }
    public function chat(){
        return $this->hasMany('App\Models\Chat');
    }

    public function payout(){
        return $this->hasMany('App\Models\Payout');
    }

    public function review(){
        return $this->hasMany('App\Models\ProfileReview','to','id');
    }
    public function cart()
    {
        return $this->hasMany('App\Models\Cart');
    }
    public function task()
    {
        return $this->hasMany('App\Models\Task');
    }
}
