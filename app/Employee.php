<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public function department(){
        return $this->belongsTo('App\Department');
    }

    public function tags(){
        return $this->belongsToMany('App\Tag');
    }

    public function job(){
        return $this->belongsTo('App\Job');
    }
}
