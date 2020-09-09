<?php

namespace App\Http\Controllers;

use App\Technology;
use Illuminate\Http\Request;

class TechnologyController extends Controller
{
    private $technology;
    public function __construct(Technology $technology){
        $this->technology = $technology;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $technology = new Technology();

        $technologies = $technology::all();
        
        return view("technology.listarTechnologia",["technologies"  => $technologies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("technology.registrarTechnologia");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = validator($request->all(), $this->technology->rules, $this->technology->messages);
        if($validate->fails()){
            return redirect()
            ->route('technologia.registrar')
            ->withErrors($validate)
            ->withInput();
        }
        //dd($request);        

        $technology = new Technology();

        $technology->dsTechnology = $request["dsTechnology"];
        
        if($request->hasFile('dsImage'))
        {
            $dsImage = $request->file('dsImage');

            $nome = uniqid() . '.' . $dsImage->getClientOriginalExtension();
       
            $destinationPath = 'img/technologias';       
       
            $dsImage->move($destinationPath, $nome);
            $technology->dsImage = $destinationPath."/".$nome; 
        }

        $technology->save();        

        return redirect()->route('technologia.listar');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function show(Technology $technology)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function edit(Technology $technology)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Technology $technology)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function destroy(Technology $technology)
    {
        //
    }
}
