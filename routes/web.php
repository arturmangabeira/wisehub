<?php

use Illuminate\Support\Facades\Auth;
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
    Route::get('/empresa/listar',['as'=> 'empresa.listar','uses'=>'CompanyController@index']);
    Route::get('/empresa/registrar',['as'=> 'empresa.registrar','uses'=>'CompanyController@create']);
    Route::post('/empresa/gravar',['as'=> 'empresa.gravar','uses'=>'CompanyController@store']);

    //Rotas para o candidato
    Route::get('/candidato/vagas',['as'=> 'candidato.vagas','uses'=>'CandidateController@vagas']);
    Route::get('/candidato/vagas/candidatar',['as'=> 'candidatar','uses'=>'CandidateController@candidatar']);


    Route::get('/technologia/listar',['as'=> 'technologia.listar','uses'=>'TechnologyController@index']);
    Route::get('/technologia/registrar',['as'=> 'technologia.registrar','uses'=>'TechnologyController@create']);
    Route::post('/technologia/gravar',['as'=> 'technologia.gravar','uses'=>'TechnologyController@store']);

    Route::get('/vaga/listar',['as'=> 'vaga.listar','uses'=>'VacancyController@index']);
    Route::get('/vaga/registrar/{company}',['as'=> 'vaga.registrar','uses'=>'VacancyController@create']);
    Route::post('/vaga/gravar',['as'=> 'vaga.gravar','uses'=>'VacancyController@store']);
     

});
