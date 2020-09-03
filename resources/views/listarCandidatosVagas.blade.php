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

                    {{ $vacancies }} {{ __('vaga(s) cadastradas no sistema.') }}
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
        <div class="card-header"><h3>Empresa {{$nome}} </h3></div> 
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
                                <p class="card-text descricao">Descrição: {{$vaga->dsVacancy}}</p>
                                <p class="card-text">Candidatos: <a href="#" class="lnkcandidatos" link="{{route('empresa.vaga.candidatos',$vaga->id)}}" vagaid={{$vaga->id}}>{{$vaga->candidates->count()}}</a></p>
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
                                <a href="#" class="btn btn-sm btn-primary" vagaid={{$vaga->id}}>Editar</a>
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

<div style="display:none;">
    <button type="button" id="btnModalFile" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Launch demo modal
    </button>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="titulovaga">Candidatos da Vaga</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <iframe id="ifrVaga" width="100%" height="600px" src="" frameBorder="0">

        </iframe>  
      </div>
      <div class="modal-footer">        
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>
<style>
.modal-dialog {
  width: 60%;
  height: 30%;
  margin: 5;
  padding: 0;
}

#dvPdf {
    width:100%;
    height:600px;
}

.modal-content {
  height: auto;
  min-height: 60%;
  border-radius: 0;
}
</style>

<script type="text/javascript">
    $(document).ready(function() {
        $(".lnkcandidatos").each(function(){
            var link = $(this);            
            $(this).click(function(){  
                var descricao = link.parent().parent().find(".descricao").html();
                var descVaga = descricao.split("Descrição:")[1];
                $("#titulovaga").html("Candidatos da Vaga: "+ descVaga);
                var idVaga = link.attr("vagaid");
                $("#btnModalFile").click();
                $("#ifrVaga").attr("src",link.attr("link"));
                /*$.ajax({
                    url: "{{route('candidatar')}}",
                    data: {vaga:idVaga},
                    type: 'GET',
                    dataType: 'json',
                    beforeSend: function () {
                        botao.html("Enviando...");
                    },
                    success: function (data) {
                        console.log("Retorno => ",data);
                        botao.html("Tudo ok !");
                    }
                });*/
            });
        })
    });
  </script>    
@endsection
