<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileReview extends Model
{
    protected $fillable = ['review', 'by', 'to','rating'];


    public function user(){
        return $this->belongsTo('App\User');
    }
}
