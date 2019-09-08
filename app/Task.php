<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $casts = [
        'start' => 'datetime:Y-m-d H:i',
        'end' => 'datetime:Y-m-d H:i'
    ];

    protected $fillable = [
        'title', 'description',
        'project_id', 'notes', 'start',
        'end', 'status'
    ];

    public function employees()
    {
        return $this->belongsToMany('App\Employee');
    }

    public function project()
    {
        return $this->belongsTo('App\Project');
    }
}
