<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    //
    public function technologies(){
        return $this->belongsToMany(Technology::class);
    }

    public function candidates(){
        return $this->belongsToMany(Candidate::class);
    }
}
