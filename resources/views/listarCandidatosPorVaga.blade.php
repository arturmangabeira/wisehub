<head>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $vaga->dsVacancy }} </div>

                <div class="card-body">                             
                    @if ($vaga->candidates)
                    <div class="row mb-5">            
                        @foreach ($vaga->candidates as $candidate)                                   
                                <div class="col-md-4">
                                    <div class="card">
                                        @if(isset($candidate->dsImagem))
                                                <img height="120" src="{{asset($candidate->dsImagem)}}"/>
                                        @endif
                                        <div class="card-body">
                                            <h5 class="card-title">Nome ({{$candidate->user->name}})</h5>
                                            <p class="card-text descricao">Email: {{$candidate->user->email}}</p>                                            
                                            <p class="card-text descricao">Idade: {{$candidate->age}}</p>                                            
                                            <p class="card-text descricao">Formação: {{$candidate->dsFormation}}</p>                                            
                                            <div>
                                            @if ($candidate->technologies)
                                                <div>Tecnologias:</div>                                        
                                                @foreach ($candidate->technologies as $tech)                        
                                                <span class="badge badge-pill badge-secondary">                   
                                                    {{$tech->dsTechnology}}
                                                </span>
                                                @endforeach
                                            @endif
                                            </div>                                            
                                        </div>
                                    </div>
                                </div>                   
                        @endforeach
                        </div>
                        @endif()           
                    </div>                    
                </div>
            
</div>
</div>
