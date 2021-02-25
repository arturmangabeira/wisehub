@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if (isset($errors) && count($errors) > 0)

                @foreach ($errors->all() as $error)
                <div class="">
                
                <p class="z-depth-3 red lighten-2">{{$error}}</p>
                </div>                               
                @endforeach   
                @endif                 
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('vaga.gravar') }}" enctype="multipart/form-data">
                        @csrf
                        <input id="name" type="hidden" name="company_id" value="{{ $company->id }}">
                        <div class="form-group row">
                        @if(isset($company->dsImagem))
                            <img height="120" width="300" src="{{asset($company->dsImagem)}}"/>
                        @endif 
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Descrição da Vaga') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('dsVacancy') is-invalid @enderror" name="dsVacancy" value="{{isset($companie->fantasyName) ? $companie->fantasyName : '' }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Quantidade') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('qtVacancy') is-invalid @enderror" name="qtVacancy" value="{{isset($companie->fantasyName) ? $companie->fantasyName : '' }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Imagem') }}</label>

                            <div class="col-md-6">
                                <input type="file" name="dsImagem">
                            </div>
                        </div>

                        <div class="input-field col s12">
                            <label for="technologies" class="col-md-4 col-form-label text-md-right">{{ __('Tecnologias') }}</label>
                            <div class="col-md-6">
                                <select multiple name="technologies[]" id="technologies">                                    
                                    @foreach($technologias as $item)
                                    <option value="{{$item->id}}">{{$item->dsTechnology}}</option>
                                    @endforeach                                            
                                </select>             
                            </div>      
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Registrar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
