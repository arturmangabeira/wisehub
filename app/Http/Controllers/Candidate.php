<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class Candidate extends Controller
{
    //
    public function listarUsuario(){


        $user = User::where("id","1")->first();
        //dd($user);
        return view("listarUsuario", [ 'user' => $user]);
    }
}
