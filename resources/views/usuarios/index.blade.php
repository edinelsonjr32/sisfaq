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
                            <h3 class="mb-0">Usuários</h3>
                        </div>
                        <div class="col-4 text-right">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#exampleModal">
                                Adicionar Usuário
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">

                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Cadastro de Usuário</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form role="form" method="POST" action="{{ route('usuario.store') }}">
                                                @csrf
                                                <div class="pl-lg-4">
                                                    <div
                                                        class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                                        <div class="text-left">
                                                            <label class="form-control-label"
                                                                for="input-current-name">{{ __('Nome') }}</label>
                                                        </div>

                                                        <input type="text" name="name" id="name"
                                                            class="form-control
                                                            form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                            placeholder="{{ __('Digite o nome do cliente') }}" value=""
                                                            required>

                                                        @if ($errors->has('name'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('name') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>

                                                    <div
                                                        class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                                        <div class="text-left">
                                                            <label class="form-control-label"
                                                                for="input-current-password">{{ __('Email') }}</label>
                                                        </div>

                                                        <input type="email" name="email" id="email"
                                                            class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                            placeholder="{{ __('Digite o dominio do cliente') }}"
                                                            value="" required>

                                                        @if ($errors->has('email'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>

                                                    <div
                                                        class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                                        <div class="text-left">
                                                            <label class="form-control-label"
                                                                for="password">{{ __('Senha') }}</label>
                                                        </div>
                                                        <input type="password" name="password" id="password"
                                                            class="form-control
                                                            form-control-alternative{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                            placeholder="{{ __('Digite sua senha') }}" value="" required>

                                                        @if ($errors->has('password'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('password') }}</strong>
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
                                <th scope="col">email</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuarios as $dado)
                            <tr>
                                <td>{{$dado->name}}</td>
                                <td>
                                    {{$dado->email}}
                                </td>
                                <td class="text-right">
                                    <form action="{{ route('usuario.destroy', $dado->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <a type="button" href="{{route('usuario.edit', $dado->id)}}"
                                            class="btn btn-sm btn-warning">
                                            <i class="ni ni-settings"></i>
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
