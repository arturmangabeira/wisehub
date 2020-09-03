<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
    public function vacancies(){
        return $this->hasMany(Vacancy::class);
    }
}
