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
                            <h3 class="mb-0">Clientes</h3>
                        </div>
                        <div class="col-4 text-right">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#exampleModal">
                                Adicionar Cliente
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">

                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Cadastro de Cliente</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form role="form" method="POST" action="{{ route('cliente.store') }}">
                                                @csrf
                                                <div class="pl-lg-4">
                                                    <div
                                                        class="form-group{{ $errors->has('nome') ? ' has-danger' : '' }}">
                                                        <div class="text-left">
                                                            <label class="form-control-label"
                                                                for="input-current-password">{{ __('Nome') }}</label>
                                                        </div>

                                                        <input type="text" name="nome" id="nome"
                                                            class="form-control form-control-alternative{{ $errors->has('nome') ? ' is-invalid' : '' }}"
                                                            placeholder="{{ __('Digite o nome do cliente') }}" value=""
                                                            required>

                                                        @if ($errors->has('nome'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('nome') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>

                                                    <div
                                                        class="form-group{{ $errors->has('dominio') ? ' has-danger' : '' }}">
                                                        <div class="text-left">
                                                            <label class="form-control-label"
                                                                for="input-current-password">{{ __('Dominio') }}</label>
                                                        </div>

                                                        <input type="text" name="dominio" id="dominio"
                                                            class="form-control form-control-alternative{{ $errors->has('dominio') ? ' is-invalid' : '' }}"
                                                            placeholder="{{ __('Digite o dominio do cliente') }}"
                                                            value="" required>

                                                        @if ($errors->has('dominio'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('dominio') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>

                                                    <div
                                                        class="form-group{{ $errors->has('versao') ? ' has-danger' : '' }}">
                                                        <div class="text-left">
                                                            <label class="form-control-label"
                                                                for="input-current-password">{{ __('Versão') }}</label>
                                                        </div>

                                                        <input type="text" name="versao" id="versao"
                                                            class="form-control form-control-alternative{{ $errors->has('versao') ? ' is-invalid' : '' }}"
                                                            placeholder="{{ __('Versão') }}" value="" required>

                                                        @if ($errors->has('versao'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('versao') }}</strong>
                                                        </span>
                                                        @endif
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
                                <th scope="col">Nome</th>
                                <th scope="col">Dominio</th>
                                <th scope="col">Versão</th>
                                <th scope="col">Ultima Alteração</th>
                                <th scope="col">Link</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clientes as $dado)
                            <tr>
                                <td>{{$dado->nome}}</td>
                                <td>
                                    {{$dado->dominio}}
                                </td>
                                <td>{{$dado->versao}}</td>
                                <td>{{date('d/m/Y H:i:s', strtotime($dado->updated_at))}}</td>
                                <td><a href="/site/{{$dado->link_acesso}}/index">{{$dado->link_acesso}}</a></td>
                                <td class="text-right">
                                    <form action="{{ route('cliente.destroy', $dado->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <a type="button" href="{{route('cliente.show', $dado->id)}}"
                                            class="btn btn-sm btn-default">
                                            Detalhe
                                        </a>
                                        <a type="button" href="{{route('cliente.edit', $dado->id)}}"
                                            class="btn btn-sm btn-warning">
                                            Editar
                                        </a>
                                        <button type="button" href="#" class="btn btn-sm bg-danger text-white"
                                            onclick="confirm('{{ __("Você tem certeza que deseja excluir?") }}') ? this.parentElement.submit() : ''">
                                            <i class="fa fa-trash "></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach

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
