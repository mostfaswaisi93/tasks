<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    // protected $guarded = [];
    protected $fillable = [
        'name'
    ];

    public function employees()
    {
        return $this->belongsToMany('App\Employee');
    }

}
