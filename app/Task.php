<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $casts = [
        'start' => 'date:Y-m-d',
        'end' => 'date:Y-m-d'
    ];

    public function employee()
    {
        return $this->belongsTo('App\Employee');
    }

    public function project()
    {
        return $this->belongsTo('App\Project');
    }
}
