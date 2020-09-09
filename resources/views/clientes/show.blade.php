@extends('layouts.app')

@section('content')
<div class="header bg-danger pb-8 pt-5 pt-md-8">
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
        <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
            <div class="card card-profile shadow">
                <div class="row justify-content-center">
                    <div class="col-lg-3 order-lg-2">
                        <div class="card-profile-image">
                            <a href="#">
                                <img src="{{ asset('argon') }}/img/theme/user2.png" class="rounded-circle">
                            </a>
                        </div>
                    </div>
                </div>
                <br>
                <br>
                <br>
                <br>
                <br>
                <div class="card-body pt-0 pt-md-4">
                    <div class="text-center">
                        <h3>
                            {{$cliente->nome}}
                        </h3>
                        <h4>
                            {{$cliente->dominio}}
                        </h4>
                        <h5>
                            Versão: {{$cliente->versao}}
                        </h5>
                        <a href="/site/{{$cliente->link_acesso}}/index">{{$cliente->link_acesso}}</a>
                        <br>
                        <br>
                            <a type="button" class="btn btn-primary btn-lg btn-block text-white" data-toggle="modal"
                                data-target="#tutorial">Adicionar Tutorial</a>
                            <div class="modal fade" id="tutorial" tabindex="-1" role="dialog"
                                aria-labelledby="modal-default" aria-hidden="true">
                                <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h6 class="modal-title" id="modal-title-default">Adicionar Tutorial
                                            </h6>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>

                                        <form role="form" method="POST" action="{{ route('tutorial.primeira_parte') }}">
                                            @csrf
                                            <div class="modal-body">

                                                <input type="hidden" name="cliente_id" value="{{$idCliente}}">
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
                                                            placeholder="{{ __('Digite o nome') }}" value="" required>

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
                                                        <select class="form-control" id="exampleFormControlSelect1"
                                                            name="categoria_id">
                                                            @foreach ($categorias as $dado)
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
        </div>
        <div class="col-xl-8 order-xl-1">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h3 class="col-12 mb-0">{{ __('Categorias') }}</h3>
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-block btn-info mb-3" data-toggle="modal"
                                data-target="#categoria">Adicionar Categoria</button>
                            <div class="modal fade" id="categoria" tabindex="-1" role="dialog"
                                aria-labelledby="modal-default" aria-hidden="true">
                                <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h6 class="modal-title" id="modal-title-default">Adicione uma nova categoria
                                            </h6>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>

                                        <form role="form" method="POST" action="{{ route('categoria.store') }}">
                                            @csrf
                                            <input type="hidden" name="cliente_id" value="{{$idCliente}}">
                                            <div class="modal-body">
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
                                                            placeholder="{{ __('Digite o nome') }}" value="" required>

                                                        @if ($errors->has('nome'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('nome') }}</strong>
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
                <div class="card-body">
                    <div class="table-responsive">
                        <div>
                            <table class="table align-items-center ">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col" class="sort" data-sort="name">Nome</th>
                                        <th scope="col" class="sort" data-sort="budget">Qtd Sub Categorias</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    @foreach ($categorias as $item)
                                    <tr>
                                        <th scope="row">
                                            <div class="media align-items-center">
                                                {{$item->nome}}

                                            </div>
                                        </th>
                                        <td class="budget">
                                            <?php
                                                    $contadorSubCategorias = DB::table('sub_categoria')->select('sub_categoria.id')->where('sub_categoria.categoria_id', '=', $item->id)->count();
                                                    ?>
                                            <a href="#" class="badge badge-pill badge-success">
                                                    {{$contadorSubCategorias}}
                                            </a>
                                        </td>
                                        <td class="text-right">
                                            <form action="{{ route('categoria.destroy', $item->id) }}" method="post">
                                                @csrf
                                                @method('delete')

                                                <a type="button" href="{{route('categoria.edit', $item->id)}}"
                                                    class="btn btn-sm btn-warning">
                                                    Editar
                                                </a>
                                                <input type="hidden" name="cliente_id" value="{{$item->cliente_id}}">
                                                <button type="button" href="#" class="btn btn-sm bg-danger text-white"
                                                    onclick="confirm('{{ __("Você tem certeza que deseja excluir?") }}') ? this.parentElement.submit() : ''">
                                                    Excluir
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach



                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            <br>
            <div class="card bg-secondary shadow">
                <div class="card-header bg-secondary border-0">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h3 class="col-12 mb-0">{{ __('Sub Categorias') }}</h3>
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-block btn-info mb-3" data-toggle="modal"
                                data-target="#sub_categorias">Adicionar Sub Categoria</button>
                            <div class="modal fade" id="sub_categorias" tabindex="-1" role="dialog"
                                aria-labelledby="modal-default" aria-hidden="true">
                                <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h6 class="modal-title" id="modal-title-default">Adicione uma nova Sub - categoria
                                            </h6>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>

                                        <form role="form" method="POST" action="{{ route('sub_categoria.store') }}">
                                            @csrf
                                            <div class="modal-body">

                                                <input type="hidden" name="cliente_id" value="{{$idCliente}}">
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
                                                            placeholder="{{ __('Digite o nome') }}" value="" required>

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
                                                        <select class="form-control" id="exampleFormControlSelect1"
                                                            name="categoria_id">
                                                            @foreach ($categorias as $dado)
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
                <div class="card-body">
                    <div class="table-responsive">
                        <div>
                            <table class="table align-items-center ">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col" class="sort" data-sort="name">Nome</th>
                                        <th scope="col" class="sort" data-sort="name">Categoria</th>
                                        <th scope="col" class="sort" data-sort="budget">Qtd Tutoriais</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    @foreach ($sub_categorias as $item)
                                    <tr>
                                        <th scope="row">
                                            <div class="media align-items-center">
                                                {{$item->nome}}
                                            </div>
                                        </th>
                                        <th scope="row">
                                            <div class="media align-items-center">
                                                {{$item->nomeCategoria}}
                                            </div>
                                        </th>
                                        <td class="budget">

                                            <?php
                                                    $contadorTutoriais = DB::table('tutorial')->select('tutorial.id')->where('tutorial.sub_categoria_id', '=', $item->id)->count();
                                                    ?>
                                            <a href="#" class="badge badge-pill badge-success">
                                                {{$contadorTutoriais}}
                                            </a>
                                        </td>
                                        <td class="text-right">
                                            <form action="{{ route('sub_categoria.destroy', $item->id) }}"
                                                method="post">
                                                @csrf
                                                @method('delete')

                                                <a type="button" href="{{route('sub_categoria.show', $item->id)}}"
                                                    class="btn btn-sm btn-default">
                                                    Detalhe
                                                </a>
                                                <input type="hidden" name="cliente_id" value="{{$idCliente}}">
                                                <a type="button" href="{{route('sub_categoria.edit', $item->id)}}"
                                                    class="btn btn-sm btn-warning">
                                                    Editar
                                                </a>
                                                <button type="button" href="#" class="btn btn-sm bg-danger text-white"
                                                    onclick="confirm('{{ __("Você tem certeza que deseja excluir?") }}') ? this.parentElement.submit() : ''">
                                                    Excluir
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth')
</div>
@endsection

@push('js')
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush
