<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{

    public $rules = [
        'dsVacancy'=> 'required',        
        'qtVacancy'=> 'required',        
        'dsImagem' => 'mimes:jpeg,png'
       
    ];
    public $messages = [
        'dsVacancy.required'=> 'O campo Descricão é obrigatório!',        
        'qtVacancy.required'=> 'O campo Quantidade é obrigatório!',        
        'dsImagem.mimes' => 'Tipo de arquivo não permitido!'
      
    ];

    //
    public function technologies(){
        return $this->belongsToMany(Technology::class);
    }

    public function candidates(){
        return $this->belongsToMany(Candidate::class);
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }
}
