<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public $rules = [
        'fantasyName'=> 'required',
        'dsCompany'=> 'required',
        'dsImagem' => 'mimes:jpeg,png'
       
    ];
    public $messages = [
        'fantasyName.required'=> 'O campo Nome Fantasia é obrigatório!',
        'dsCompany.required'=> 'O campo descricão é obrigatório!',               
        'dsImagem.mimes' => 'Tipo de arquivo não permitido!'
      
    ];
    //
    public function vacancies(){
        return $this->hasMany(Vacancy::class);
    }
}
