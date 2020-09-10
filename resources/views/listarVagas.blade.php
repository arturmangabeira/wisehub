@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Vagas disponíveis') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ Auth::user()->name }} {{ __('aproveite e candadate-se! Possuímos ') }} {{ $vacancies }} {{ __('de seu interesse.') }}
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
    @foreach ($companies as $nome => $vagas)
    <div class="card">
        <div class="card-header"><h3>Empresa {{$nome}} contrata </h3></div> 
        <div class="card-body">         
        @if ($vagas)
        <div class="row mb-5">            
            @foreach ($vagas as $vaga)            
                    <div class="col-md-4">
                        <div class="card">
                            @if(isset($vaga->dsImagem))
                                    <img height="120" src="{{asset($vaga->dsImagem)}}"/>
                                @endif
                            <div class="card-body">
                                <h5 class="card-title">Quantidade de vagas ({{$vaga->qtVacancy}})</h5>
                                <p class="card-text">Descrição: {{$vaga->dsVacancy}}</p>
                                <div>
                                @if ($vaga->technologies)
                                    <div>Tecnologias:</div>                                        
                                    @foreach ($vaga->technologies as $tech)                        
                                    <span class="badge badge-pill badge-secondary">                   
                                        {{$tech->dsTechnology}}
                                    </span>
                                    @endforeach
                                @endif
                                </div>
                                <a href="#" class="btn btn-sm btn-primary" vagaid={{$vaga->id}}>Candidatar</a>
                            </div>
                        </div>
                    </div>                   
            @endforeach
            </div>
            @endif()           
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
        $(".btn").each(function(){
            var botao = $(this);
            $(this).click(function(){                
                var idVaga = $(this).attr("vagaid");
                $.ajax({
                    url: "{{route('candidatar')}}",
                    data: {vaga:idVaga},
                    type: 'GET',
                    dataType: 'json',
                    beforeSend: function () {
                        botao.html("Enviando...");
                    },
                    success: function (data) {
                        console.log("Retorno => ",data);
                        botao.html("Sucesso !");
                    }
                });
            });
        })
    });
  </script>    
@endsection
