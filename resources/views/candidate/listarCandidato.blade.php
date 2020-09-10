@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Candidatos cadastrados') }}</div>

                <div class="card-body">                    
                {{ __('Total de '). $candidates->count().__(' Candidatos ')  }} <a href="{{ route('candidato.registrar') }}" class="btn btn-sm btn-primary">{{__('Cadastrar Novo')}}</a>                    
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
    @foreach ($candidates as $candidate)
    <div class="card">
        <div class="card-header"><h3>Candidato: {{$candidate->user->name}}  </h3>
        @if(isset($candidate->dsImagem))
            <img height="120" width="300" src="{{asset($candidate->dsImagem)}}"/>
        @endif         
        <a href="{{ route('candidato.editar', $candidate->id)}}" class="btn btn-sm btn-primary">{{__('Editar')}}</a>                    
        </div> 
        <div class="card-body">                 
            <div class="row mb-5">                        
                <div class="col-md-4">
                    <div class="card">                            
                        <div class="card-body">                        
                            @if ($candidate->technologies)
                                <div>Tecnologias:</div>                                        
                                @foreach ($candidate->technologies as $tech)                        
                                <span class="badge badge-pill badge-secondary">                   
                                    {{$tech->dsTechnology}}
                                </span>
                                @endforeach
                            @else
                                <p class="card-text">Sem tecnologias cadastradas</p>     
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
