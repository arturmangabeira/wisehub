@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Technologias cadastradas') }}</div>

                <div class="card-body">                    
                {{ __('Total de '). $technologies->count().__(' Technologias ')  }} <a href="{{ route('technologia.registrar') }}" class="btn btn-sm btn-primary">{{__('Cadastrar Nova')}}</a>                    
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
    @foreach ($technologies as $technology)
    <div class="card">
        <div class="card-header"><h3>Nome da technologia: {{$technology->dsTechnology}}  </h3>        
        </div> 
        <div class="card-body">                             
        @if(isset($technology->dsImage))
            <img height="120" width="300" src="{{asset($technology->dsImage)}}"/>
        @endif         
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
