<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{

    public $rules = [
        'dsFormation'=> 'required',        
        'dsImagem' => 'mimes:jpeg,png'
       
    ];
    public $messages = [        
        'dsFormation.required'=> 'O campo descricão é obrigatório!',               
        'dsImagem.mimes' => 'Tipo de arquivo não permitido!'
    ];

    public function technologies(){
        return $this->belongsToMany(Technology::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function analisar()
    {
        return "teste";
    }
}
