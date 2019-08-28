<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function employee(){
        return $this->belongsTo('App\Employee');
    }
}
