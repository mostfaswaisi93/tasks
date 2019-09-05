<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title', 'description', 'department_id', 'status'
    ];

    public function department(){
        return $this->belongsTo('App\Department');
    }
}
