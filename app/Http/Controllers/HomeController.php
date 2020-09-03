<?php

namespace App\Http\Controllers;

use App\Candidate;
use App\Company;
use App\Technology;
use App\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
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
        return view('home',[
            'companies' => $retorno,
            'vacancies' => $vagas
        ]);
    }
}
