<?php

namespace App\Http\Controllers;

use App\Candidate;
use App\Company;
use App\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CandidateController extends Controller
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

    public function candidatar(Request $request)
    {   
        $vaga = Vacancy::find($request->vaga);
        $candidate = Candidate::where("user_id",Auth::User()->id)->first();
        //dd($candidate);
        $vaga->candidates()->attach($candidate->id);    
        echo json_encode($vaga);
    }

    public function vagas(){
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
                            ->whereIn("technology_vacancy.technology_id",$arrayTechs)
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
        return view('listarVagas',[
            'companies' => $retorno,
            'vacancies' => $vagas
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
     * @param  \App\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function show(Candidate $candidate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function edit(Candidate $candidate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Candidate $candidate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Candidate $candidate)
    {
        //
    }
}
