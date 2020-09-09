@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Empresas cadastradas') }}</div>

                <div class="card-body">                    
                {{ __('Total de '). $companies->count().__(' Empresas ')  }} <a href="{{ route('empresa.registrar') }}" class="btn btn-sm btn-primary">{{__('Cadastrar Nova')}}</a>                    
                </div>
            </div>
        </div>
    </div>
</div>
<div style="padding-top: 1%">    
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">            
    @foreach ($companies as $company)
    <div class="card">
        <div class="card-header"><h3>Empresa {{$company->fantasyName}}  </h3>
        @if(isset($company->dsImagem))
            <img height="120" width="300" src="{{asset($company->dsImagem)}}"/>
        @endif 
        <a href="{{ route('vaga.registrar', $company->id)}}" class="btn btn-sm btn-primary">{{__('Cadastrar Vaga')}}</a>                    
        </div> 
        <div class="card-body">                 
            <div class="row mb-5">                        
                <div class="col-md-4">
                    <div class="card">                            
                        <div class="card-body">                             
                        @if ($company->vacancies)    
                        <p class="card-text">({{$company->vacancies->count()}}) Vagas</p>                           
                            @foreach ($company->vacancies as $vaga)            
                            <div>
                                @if(isset($vaga->dsImagem))
                                    <img height="120" width="300" src="{{asset($vaga->dsImagem)}}"/>
                                @endif 
                                <p class="card-text">Descrição: {{$vaga->dsVacancy}}</p>                                
                            </div>
                            <div>
                                <p class="card-text">Quantidade de vagas: {{$vaga->qtVacancy}}</p>                                                                
                            </div>
                            <div>                                
                                <a href="#" class="btn btn-sm btn-primary" vagaid={{$vaga->id}}>Editar Vaga</a>
                            </div>
                            @endforeach                         
                        @else
                            <p class="card-text">Sem vagas cadastradas</p>                                  
                        @endif           
                        </div>
                    </div>
                </div>                 
            </div>
            
        </div>
    </div>
    <div style="padding-top: 1%">    
    </div>
    
    @endforeach  
</div>
</div>
</div>
    <!-- row -->
</div>
<script type="text/javascript">
    $(document).ready(function() {
        
    });
  </script>    
@endsection
