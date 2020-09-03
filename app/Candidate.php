<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    public function technologies(){
        return $this->belongsToMany(Technology::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
