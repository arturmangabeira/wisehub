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
                    <form method="POST" action="{{ route('empresa.gravar') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nome Fantasia') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('fantasyName') is-invalid @enderror" name="fantasyName" value="{{isset($companie->fantasyName) ? $companie->fantasyName : '' }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>

                            <div class="col-md-6">
                                <input type="file" name="dsImagem">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Cnpj') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="text" class="form-control" name="cnpj">                                
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
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Descricao') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="text" class="form-control" name="dsCompany" required autofocus>
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
