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
                    <form method="POST" action="{{ route('candidato.gravar') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>

                            <div class="col-md-6">
                                <input type="file" name="dsImagem">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('CPF') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="text" class="form-control" name="cpf">                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Cidade') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="text" class="form-control" name="city">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('UF') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="text" class="form-control" name="uf">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Idade') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="text" class="form-control" name="age">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Formacao') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="text" class="form-control" name="dsFormation" required autofocus>
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
