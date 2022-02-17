<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = ['description'];
    
    public function instruction(){
        return $this->belongsTo(Instruction::class);
    }

    public function reporter(){
        return $this->belongsTo(User::class,'user_id');
    }
}
