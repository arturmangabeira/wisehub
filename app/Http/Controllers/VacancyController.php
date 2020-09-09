<?php

namespace App\Http\Controllers;

use App\Company;
use App\Technology;
use App\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VacancyController extends Controller
{
    private $vacancy;
    public function __construct(Vacancy $vacancy){
        $this->vacancy = $vacancy;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Company $company)
    {        
        $technology = new Technology();
        $techonolias = $technology::all();

        return view("vacancy.registrarVaga",["technologias" => $techonolias, "company" => $company]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = validator($request->all(), $this->vacancy->rules, $this->vacancy->messages);
        if($validate->fails()){
            return redirect()
            ->route('vaga.registrar',$request["company_id"])
            ->withErrors($validate)
            ->withInput();
        }
        //dd($request);        

        $vacancy = new Vacancy();

        $vacancy->dsVacancy = $request["dsVacancy"];
        $vacancy->qtVacancy = $request["qtVacancy"];
        $vacancy->company_id = $request["company_id"];

        if($request->hasFile('dsImagem'))
        {
            $dsImagem = $request->file('dsImagem');

            $nome = uniqid() . '.' . $dsImagem->getClientOriginalExtension();
       
            $destinationPath = 'img/vagas';       
       
            $dsImagem->move($destinationPath, $nome);
            $vacancy->dsImagem = $destinationPath."/".$nome; 
        }

        $vacancy->save();
        $vacancy->technologies()->attach($request['technologies']);

        return redirect()->route('empresa.listar');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vacancy  $vacancy
     * @return \Illuminate\Http\Response
     */
    public function show(Vacancy $vacancy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vacancy  $vacancy
     * @return \Illuminate\Http\Response
     */
    public function edit(Vacancy $vacancy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vacancy  $vacancy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vacancy $vacancy)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vacancy  $vacancy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vacancy $vacancy)
    {
        //
    }
}
