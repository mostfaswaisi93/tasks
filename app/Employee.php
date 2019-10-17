<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'fullName', 'email', 'phone',
        'address', 'jobTitle', 'department_id',
        'user_id', 'status'
    ];

    public function tasks()
    {
        return $this->belongsToMany('App\Task');
    }

    public function department()
    {
        return $this->belongsTo('App\Department');
    }

    public function skills()
    {
        return $this->belongsToMany('App\Skill');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
