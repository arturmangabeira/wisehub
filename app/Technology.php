<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    public $rules = [
        'dsTechnology'=> 'required',        
        'dsImagem' => 'mimes:jpeg,png'
       
    ];
    public $messages = [        
        'dsTechnology.required'=> 'O campo descricão é obrigatório!',               
        'dsImagem.mimes' => 'Tipo de arquivo não permitido!'
      
    ];
}
