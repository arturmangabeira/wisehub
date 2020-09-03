<?php

namespace App\Http\Controllers;

use App\Candidate;
use App\Company;
use App\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function listar()
    {
        $company = new Company();
        //DB::enableQueryLog();
        $candidate = Candidate::where("user_id",Auth::User()->id)->first();
        
        $technologys  =  $candidate->technologies;      
        $arrayTechs = [];
        foreach ($technologys as $techs) {
            $arrayTechs[] = $techs->id;
        }
        //dd($arrayTechs);
        $vacancies = Vacancy::select("vacancies.*")->distinct()
                            ->join("companies","vacancies.company_id","companies.id")
                            ->join("technology_vacancy","technology_vacancy.vacancy_id","vacancies.id")                            
                            //->whereIn("technology_vacancy.technology_id",$arrayTechs)
                            ->get();
         // Enable query log
        //dd(DB::getQueryLog());
        //$companies = $company::all();
        //dd($companies);
        $vagas = 0;
        $retorno = [];
        foreach ($vacancies as $vaga) {
            $retorno[$vaga->company->fantasyName][] = $vaga;            
        }
        
        foreach ($retorno as $arrvagas) {
            $vagas +=  count($arrvagas);
        }

        //dd($retorno);
        return view('listarCandidatosVagas',[
            'companies' => $retorno,
            'vacancies' => $vagas
        ]);        
    }

    public function listarcandidatos(Vacancy $vaga){
        return view("listarCandidatosPorVaga", [
            'vaga' => $vaga
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        //
    }
}
