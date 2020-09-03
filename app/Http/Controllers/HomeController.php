<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;

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

        $companies = $company::all();
        $vagas = 0;
        foreach ($companies as $company) {
            $vagas += $company->vacancies()->count();
        }
        return view('home',[
            'companies' => $companies,
            'vacancies' => $vagas
        ]);
    }
}
