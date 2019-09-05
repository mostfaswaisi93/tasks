<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'full_name', 'email', 'phone',
        'address', 'job_title', 'department_id',
        'user_id', 'status'
    ];

    public function department()
    {
        return $this->belongsTo('App\Department');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    public function tasks()
    {
        return $this->hasMany('App\Task');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
