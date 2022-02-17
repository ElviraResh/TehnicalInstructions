<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instruction extends Model
{
    public function reports(){
        return $this->hasMany(Report::class);
    }

    public function author(){
        return $this->belongsTo(User::class,'user_id');
    }
}
