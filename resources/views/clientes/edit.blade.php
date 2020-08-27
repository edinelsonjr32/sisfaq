@extends('layouts.app')

@section('content')
<div class="header bg-warning pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

    </div>
</div>
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Clientes</h3>
                        </div>
                        <div class="col-4 text-right">
                            <!-- Button trigger modal -->
                            <a type="button" href="{{route('cliente.index')}}" class="btn btn-primary"
                                >
                                Voltar para Gerenciamento de Clientes
                            </a>
                        </div>
                    </div>
                </div>


                <form role="form" method="POST" action="{{ route('cliente.update', $cliente->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="pl-lg-4">
                        <div class="form-group{{ $errors->has('nome') ? ' has-danger' : '' }}">
                            <div class="text-left">
                                <label class="form-control-label" for="input-current-password">{{ __('Nome') }}</label>
                            </div>

                            <input type="text" name="nome" id="nome"
                                class="form-control form-control-alternative{{ $errors->has('nome') ? ' is-invalid' : '' }}"
                                placeholder="{{ __('Digite o nome do cliente') }}" value="{{$cliente->nome}}" required>

                            @if ($errors->has('nome'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('nome') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('dominio') ? ' has-danger' : '' }}">
                            <div class="text-left">
                                <label class="form-control-label"
                                    for="input-current-password">{{ __('Dominio') }}</label>
                            </div>

                            <input type="text" name="dominio" id="dominio"
                                class="form-control form-control-alternative{{ $errors->has('dominio') ? ' is-invalid' : '' }}"
                                placeholder="{{ __('Digite o dominio do cliente') }}" value="{{$cliente->dominio}}"
                                required>

                            @if ($errors->has('dominio'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('dominio') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('versao') ? ' has-danger' : '' }}">
                            <div class="text-left">
                                <label class="form-control-label"
                                    for="input-current-password">{{ __('Versão') }}</label>
                            </div>

                            <input type="text" name="versao" id="versao"
                                class="form-control form-control-alternative{{ $errors->has('versao') ? ' is-invalid' : '' }}"
                                placeholder="{{ __('Versão') }}" value="{{$cliente->versao}}" required>

                            @if ($errors->has('versao'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('versao') }}</strong>
                            </span>
                            @endif
                        </div>

                    </div>


                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            <a type="button" href="{{route('cliente.index')}}" class="btn btn-danger col-md-2 text-center text-white">Sair</a>
                            <button type="submit" class="btn btn-success col-md-2 text-white">Salvar</button>
                        </nav>
                    </div>

                </form>
            </div>
        </div>
    </div>


</div>
@endsection

@push('js')
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush
