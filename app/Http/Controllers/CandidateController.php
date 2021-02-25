<?php

namespace App\Http\Controllers;

use App\Candidate;
use App\Company;
use App\Technology;
use App\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CandidateController extends Controller
{
    private $candidate;
    public function __construct(Candidate $candidate){
        $this->candidate = $candidate;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //ARTUR TESTE GIT APOS RESET HARD.

        $candidate = new Candidate();

        $candidates = $candidate::all();
        return view("candidate.listarCandidato",["candidates" => $candidates]);

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
        
        
        $arrayTechs = [];
        if($candidate){
        $technologys  =  $candidate->technologies;      
        foreach ($technologys as $techs) {
            $arrayTechs[] = $techs->id;
        }
        }
        //dd($arrayTechs);
        $vacancies = Vacancy::select("vacancies.*")->distinct()
                            ->join("companies","vacancies.company_id","companies.id")
                            ->leftjoin("technology_vacancy","technology_vacancy.vacancy_id","vacancies.id")                            
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
        $technology = new Technology();
        $techonolias = $technology::all();
        return view("candidate.registrarCandidato",["technologias" => $techonolias]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = validator($request->all(), $this->candidate->rules, $this->candidate->messages);
        if($validate->fails()){
            return redirect()
            ->route('candidato.registrar')
            ->withErrors($validate)
            ->withInput();
        }
        //dd($request);
        $userId = Auth::user()->id;

        $candidate = new Candidate();

        $candidate->dsFormation = $request["dsFormation"];

        $candidate->cpf = $request["cpf"];
        $candidate->city = $request["city"];
        $candidate->uf = $request["uf"];
        $candidate->age = $request["age"];
        $candidate->user_id = $userId;

        if($request->hasFile('dsImagem'))
        {
            $dsImagem = $request->file('dsImagem');

            $nome = uniqid() . '.' . $dsImagem->getClientOriginalExtension();
       
            $destinationPath = 'img/candidatos';
       
            /*$resize = Image::make($dsImagem->getRealPath());
       
            $resize->resize(120, 120, function($constraint){
             $constraint->aspectRatio();
            })->save($destinationPath . '/' . $nome);       
            */
       
            $dsImagem->move($destinationPath, $nome);
            $candidate->dsImagem = $destinationPath."/".$nome; 
        }

        $candidate->save();
        if(isset($request['technologies']))
        {
            $candidate->technologies()->attach($request['technologies']);
        }

        return  redirect()->route('candidato.listar');
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
    public function edit(Candidate $candidato)
    {
        $technology = new Technology();
        $techonolias = $technology::all();

        $tecnologiasCandidate = $candidato->technologies;
        $arrTecnologiasCandidate = [];
        
        foreach ($tecnologiasCandidate as $tech){
            $arrTecnologiasCandidate[] = $tech->id;
        }
        //dd($candidato);
        return view("candidate.editarCandidato",["arrTecnologiasCandidate" => $arrTecnologiasCandidate, "candidate" => $candidato,"technologias" => $techonolias]);
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
        $validate = validator($request->all(), $this->candidate->rules, $this->candidate->messages);
        if($validate->fails()){
            return redirect()
            ->route('candidato.registrar')
            ->withErrors($validate)
            ->withInput();
        }
        //dd($request);
        $userId = Auth::user()->id;

        $candidate->dsFormation = $request["dsFormation"];

        $candidate->cpf = $request["cpf"];
        $candidate->city = $request["city"];
        $candidate->uf = $request["uf"];
        $candidate->age = $request["age"];
        $candidate->user_id = $userId;

        if($request->hasFile('dsImagem'))
        {
            $dsImagem = $request->file('dsImagem');

            $nome = uniqid() . '.' . $dsImagem->getClientOriginalExtension();
       
            $destinationPath = 'img/candidatos';
       
            /*$resize = Image::make($dsImagem->getRealPath());
       
            $resize->resize(120, 120, function($constraint){
             $constraint->aspectRatio();
            })->save($destinationPath . '/' . $nome);       
            */
       
            $dsImagem->move($destinationPath, $nome);
            $candidate->dsImagem = $destinationPath."/".$nome; 
        }

        $candidate->save();
        if(isset($request['technologies']))
        {
            $candidate->technologies()->sync($request['technologies']);
        }

        return  redirect()->route('candidato.listar');
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
