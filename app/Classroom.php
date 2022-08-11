<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    //
    protected $table = 'classrooms';

    public function owner()
    {
        return $this->belongsTo(User::class);
    }
}
