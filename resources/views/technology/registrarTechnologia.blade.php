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
                <div class="card-header">{{ __('Registrar technologia') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('technologia.gravar') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Descrição') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('dsTechnology') is-invalid @enderror" name="dsTechnology" value="{{isset($companie->fantasyName) ? $companie->fantasyName : '' }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Imagem') }}</label>

                            <div class="col-md-6">
                                <input type="file" name="dsImage">
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
