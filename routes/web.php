<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

if(!Auth::check()){
    Route::get('/', 'HomeController@index')->name('home');
}else{
    Route::get('/', function () {
        return view('welcome');
    });
}

//Route::get('listar-usuario','Candidate@listarUsuario');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware'=>'auth'], function(){

    if(Auth::check() && Auth::User()->type == "dev"){
        Route::get('/', ['as'=> 'auth.desenvolvedor','uses'=>'Auth\Desenvolvedor\DesenvolvedorController@index']);
           }else{
        //Route::get('/',['as'=> 'site.login.sair','uses'=>'Site\LoginController@sair']);
        Route::get('/home', 'HomeController@index')->name('home');
        }
    
        Route::get('listar-usuario','Candidate@listarUsuario');
    //Rotas para gestao das vagas        

    Route::get('/empresa/vaga/{vaga}/candidatos',['as'=> 'empresa.vaga.candidatos','uses'=>'CompanyController@listarcandidatos']);
    Route::get('/empresa/vaga/listar',['as'=> 'empresa.vagas.listar','uses'=>'CompanyController@listar']);

    //Rotas para o candidato
    Route::get('/candidato/vagas',['as'=> 'candidato.vagas','uses'=>'CandidateController@vagas']);
    Route::get('/candidato/vagas/candidatar',['as'=> 'candidatar','uses'=>'CandidateController@candidatar']);
     

});
