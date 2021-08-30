<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProjectImages;
use App\Models\Bid;
use App\Models\Contract;

class Project extends Model
{
    protected $fillable = ['user_id','title','delivery','price','description'];

    public function project_image()
    {
        return $this->hasOne(ProjectImages::class);
    }

    public function bid(){
        return $this->hasMany(Bid::class);
    }

    public function contract(){
        return $this->hasOne(Contract::class);
    }

}
