@extends('layouts.app')

@section('content')
<div class="header bg-success pb-8 pt-5 pt-md-8">
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
                            <h3 class="mb-0">Tutoriais</h3>
                        </div>
                        <div class="col-4 text-right">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#exampleModal">
                                Adicionar Passo a Passo
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">

                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Cadastro de Sub Categoria</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form role="form" method="POST" action="{{ route('tutorial.primeira_parte') }}">
                                                @csrf
                                                <div class="pl-lg-4">
                                                    <div
                                                        class="form-group{{ $errors->has('nome') ? ' has-danger' : '' }}">
                                                        <div class="text-left">
                                                            <label class="form-control-label"
                                                                for="input-current-nome">{{ __('Nome') }}</label>
                                                        </div>

                                                        <input type="text" name="nome" id="nome"
                                                            class="form-control
                                                            form-control-alternative{{ $errors->has('nome') ? ' is-invalid' : '' }}"
                                                            placeholder="{{ __('Digite o nome') }}" value=""
                                                            required>

                                                        @if ($errors->has('nome'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('nome') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="text-left">
                                                            <label for="exampleFormControlSelect1">Categoria</label>
                                                        </div>
                                                        <select class="form-control" id="exampleFormControlSelect1" name="categoria_id">
                                                            @foreach ($categorias as $dado)
                                                                <option value="{{$dado->id}}">{{$dado->nome}}</option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="text-left">
                                                            <label for="exampleFormControlSelect1">Cliente</label>
                                                        </div>
                                                        <select class="form-control" id="exampleFormControlSelect1"
                                                            name="cliente_id">
                                                            @foreach ($clientes as $dado)
                                                            <option value="{{$dado->id}}">{{$dado->nome}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Sair</button>
                                            <button type="submit" class="btn btn-primary">Salvar</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Título</th>
                                <th scope="col">Sub Categoria / Categoria</th>
                                <th scope="col">Cliente</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($tutoriais == '')
                            @else
                                @foreach ($tutoriais as $dado)
                                <tr>
                                    <td>{{$dado->titulo}}</td>
                                    <td>{{$dado->nomeSubCategoria}}  /  {{$dado->nomeCategoria}}</td>
                                    <td>{{$dado->nomeCliente}}</td>
                                    <td class="text-right">

                                        <form action="{{ route('tutorial.destroy', $dado->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <a type="button" href="{{route('tutorial.show', $dado->id)}}"
                                                class="btn btn-sm btn-default">
                                                Show
                                            </a>
                                            
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            @endif


                        </tbody>
                    </table>
                </div>
                <div class="card-footer py-4">
                    <nav class="d-flex justify-content-end" aria-label="...">

                    </nav>
                </div>
            </div>
        </div>
    </div>


</div>
@endsection

@push('js')
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush
