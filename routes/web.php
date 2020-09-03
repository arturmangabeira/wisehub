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
    Route::get('/empresa/vagas/{id}',['as'=> 'auth.empresa','uses'=>'Auth\Empresa\EmpresaController@index']);
    Route::get('/empresa/vaga/criar',['as'=> 'auth.empresa.criar','uses'=>'Auth\Empresa\EmpresaController@criar']);
    Route::post('/empresa/vaga/salvar',['as'=> 'auth.empresa.salvar','uses'=>'Auth\Empresa\EmpresaController@salvar']);
    Route::get('/empresa/vaga/editar/{id}',['as'=> 'auth.empresa.editar','uses'=>'Auth\Empresa\EmpresaController@editarvaga']);
    Route::put('/empresa/vaga/atualizar/{id}',['as'=> 'auth.empresa.vaga.atualizar','uses'=>'Auth\Empresa\EmpresaController@atualizarvaga']);
    Route::get('/empresa/vaga/excluir/{id}',['as'=> 'auth.empresa.vaga.excluir','uses'=>'Auth\Empresa\EmpresaController@excluirVaga']);

    Route::get('/empresa/vaga/{id}/candidatos',['as'=> 'auth.empresa.vaga.candidatos','uses'=>'Auth\Empresa\EmpresaController@exibircandidatos']);

    //Rotas para o desenvolvedor
    Route::get('/candidato/vagas',['as'=> 'auth.desenvolvedor','uses'=>'Auth\Desenvolvedor\DesenvolvedorController@index']);
    Route::get('/candidato/vagas/candidatar',['as'=> 'candidatar','uses'=>'CandidateController@candidatar']);
     

});
