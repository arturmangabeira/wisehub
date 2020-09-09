<?php

namespace App\Http\Controllers;

use App\Candidate;
use App\Company;
use App\Vacancy;
use Faker\Provider\Uuid;
use Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{

    private $company;
    public function __construct(Company $company){
        $this->company = $company;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = new Company();

        $companies = $company::all();
        return view("company.listarEmpresa",["companies" => $companies]);
    }

    public function listar()
    {
        $company = new Company();
        //DB::enableQueryLog();
        $candidate = Candidate::where("user_id",Auth::User()->id)->first();
        
        if($candidate){
            $technologys  =  $candidate->technologies;      
            $arrayTechs = [];
            foreach ($technologys as $techs) {
                $arrayTechs[] = $techs->id;
            }
        }
        //dd($arrayTechs);
        $vacancies = Vacancy::select("vacancies.*")->distinct()
                            ->join("companies","vacancies.company_id","companies.id")
                            ->leftjoin("technology_vacancy","technology_vacancy.vacancy_id","vacancies.id")                            
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
        return view("company.registrarEmpresa");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = validator($request->all(), $this->company->rules, $this->company->messages);
        if($validate->fails()){
            return redirect()
            ->route('empresa.registrar')
            ->withErrors($validate)
            ->withInput();
        }
        //dd($request);
        $userId = Auth::user()->id;

        $company = new Company();

        $company->fantasyName = $request["fantasyName"];

        $company->cnpj = $request["cnpj"];
        $company->city = $request["city"];
        $company->uf = $request["uf"];
        $company->dsCompany = $request["dsCompany"];
        $company->user_id = $userId;

        if($request->hasFile('dsImagem'))
        {
            $dsImagem = $request->file('dsImagem');

            $nome = uniqid() . '.' . $dsImagem->getClientOriginalExtension();
       
            $destinationPath = 'img/company';
       
            /*$resize = Image::make($dsImagem->getRealPath());
       
            $resize->resize(120, 120, function($constraint){
             $constraint->aspectRatio();
            })->save($destinationPath . '/' . $nome);       
            */
       
            $dsImagem->move($destinationPath, $nome);
            $company->dsImagem = $destinationPath."/".$nome; 
        }

        $company->save();

        return  redirect()->route('empresa.listar');
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
