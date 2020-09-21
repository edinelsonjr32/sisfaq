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
        <div class="col-xl-12 order-xl-1">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        @foreach ($subCategoria as $dado)
                        <div class="col-md-7">

                            <h3 class="col-12 mb-0">Sub Categoria: <span
                                    class="badge badge-pill badge-primary">{{$dado->nome }}</span>
                            </h3>
                            <h4 class="col-12 mb-0">Categoria: <span
                                    class="badge badge-pill badge-success">{{$dado->nomeCategoria }}</span>
                            </h4>
                            <h5 class="col-12 mb-0">Cliente: <span
                                    class="badge badge-pill badge-danger">{{$dado->nomeCliente }}</span>
                            </h5>
                        </div>
                        <div class="col-md-3">
                            <a type="button" href="{{route('cliente.show', $dado->cliente_id)}}"
                                class="btn btn-block btn-danger mb-3 text-white">Voltar para Gerenciamento de
                                Cliente</a>
                        </div>
                        <div class="col-md-2">
                            <a type="button" class="btn btn-block btn-success mb-3 text-white" data-toggle="modal"
                                data-target="#tutorial">Inserir Novo Tutorial</a>
                        </div>



                    </div>
                </div>
            </div>
            <br>
        </div>
        <div class="modal fade" id="tutorial" tabindex="-1" role="dialog" aria-labelledby="modal-default"
            aria-hidden="true">
            <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="modal-title-default">inserir Tutorial
                        </h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <form role="form" method="POST" action="{{ route('tutorial.store') }}">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" value="{{$dado->id}}" name="sub_categoria_id">
                            <input type="hidden" value="{{$dado->cliente_id}}" name="cliente_id">

                               <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('nome') ? ' has-danger' : '' }}">
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
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>

        @endforeach

    </div>

    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            @foreach ($tutorial as $item)
                            <div class="col-sm">
                                <div class="card">
                                    <div class="card-body">
                                        <img class="card-img-top" src="{{ URL::to('/') }}/images/{{ $item->path_foto}}"
                                            alt="Card image cap" height="450px">
                                        <div class="card-body">
                                            <h5 class="card-title">{{$item->titulo}}</h5>
                                            <p class="card-text">{{substr($item->observacao, 0, 30)}} ...</p>


                                            <form action="{{ route('tutorial.destroy', $item->idTutorial) }}"
                                                method="post">
                                                @csrf
                                                @method('delete')
                                                <div class="row align-items-center">
                                                    <div class="col-md-6">
                                                        <a href="{{route('tutorial.show', $item->idTutorial)}}"
                                                            class="btn btn-block btn-primary mb-3 text-white">Acessar <i
                                                                class="ni ni-active-40"></i></a>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <a type="button"
                                                            class="btn btn-block btn-warning mb-3 text-white"
                                                            href="{{route('tutorial.edit', $item->idTutorial)}}"><i
                                                                class="ni ni-settings"></i></a>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <button type="submit" href="#"
                                                            class="btn btn-block btn-danger mb-3 text-white"
                                                            onclick="confirm('{{ __("Você tem certeza que deseja excluir?") }}') ? this.parentElement.submit() : ''">
                                                            <i class="fa fa-trash "></i>
                                                        </button>

                                                    </div>


                                                </div>

                                            </form>



                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>


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

@endpush
