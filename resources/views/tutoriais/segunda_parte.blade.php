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
                            <h3 class="mb-0">Passo a Passo</h3>
                        </div>
                        <div class="col-4 text-right">
                            <!-- Button trigger modal -->
                            <a type="button" href="{{route('cliente.show', $cliente->id)}}" class="btn btn-primary">
                                Voltar para Cliente
                            </a>
                        </div>
                    </div>
                </div>


                <form role="form" method="POST" action="{{ route('tutorial.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="pl-lg-4">

                        <input type="hidden" name="cliente_id" value="{{$cliente->id}}">

                        <div class="form-group{{ $errors->has('cliente') ? ' has-danger' : '' }}">
                            <div class="text-left">
                                <label class="form-control-label" for="input-current-nome">{{ __('Cliente') }}</label>
                            </div>
                            <input type="text"
                                class="form-control
                                                            form-control-alternative{{ $errors->has('nome') ? ' is-invalid' : '' }}"
                                placeholder="{{ __('Digite o nome') }}" value="{{$cliente->nome}}" disabled>

                            @if ($errors->has('nome'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('nome') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('cliente') ? ' has-danger' : '' }}">
                            <div class="text-left">
                                <label class="form-control-label" for="input-current-nome">{{ __('Categoria') }}</label>
                            </div>
                            <input type="text"
                                class="form-control
                                                            form-control-alternative{{ $errors->has('nome') ? ' is-invalid' : '' }}"
                                placeholder="{{ __('Digite o nome') }}" value="{{$categoria->nome}}" disabled>

                            @if ($errors->has('nome'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('nome') }}</strong>
                            </span>
                            @endif
                        </div>


                        <div class="form-group">
                            <div class="text-left">
                                <label for="exampleFormControlSelect1">Sub Categoria</label>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <select class="form-control" id="exampleFormControlSelect1" name="sub_categoria_id" disabled>
                                        @foreach ($sub_categoria as $item)
                                        <option value="{{$item->id}}">
                                            {{$item->nome}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>

                        </div>
                        <!-- Stack the columns on mobile by making one full-width and the other half-width -->


                        <div class="form-group{{ $errors->has('titulo') ? ' has-danger' : '' }}">
                            <div class="text-left">
                                <label class="form-control-label" for="input-current-titulo">{{ __('Titulo') }}</label>
                            </div>
                            <input type="text" name="titulo" id="titulo"
                                class="form-control
                                                            form-control-alternative{{ $errors->has('titulo') ? ' is-invalid' : '' }}"
                                placeholder="{{ __('Digite o titulo') }}" value="{{$titulo}}" disabled>

                            @if ($errors->has('titulo'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('titulo') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('passo_numero') ? ' has-danger' : '' }}">
                            <div class="text-left">
                                <label class="form-control-label"
                                    for="input-current-titulo">{{ __('Passo Nº') }}</label>
                            </div>
                            <input type="text" name="passo_numero" id="passo_numero"
                                class="form-control
                                                            form-control-alternative{{ $errors->has('passo_numero') ? ' is-invalid' : '' }}"
                                placeholder="{{ __('Digite o titulo') }}" disabled>

                            @if ($errors->has('passo_numero'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('passo_numero') }}</strong>
                            </span>
                            @endif
                        </div>

                        



                    </div>


                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            <a type="button" href="{{route('sub_categoria.index')}}"
                                class="btn btn-danger col-md-2 text-center text-white">Sair</a>
                            <button type="submit" class="btn btn-success col-md-2 text-white">Salvar</button>
                        </nav>
                    </div>

                </form>

                <div class="modal fade" id="sub_categorias" tabindex="-1" role="dialog" aria-labelledby="modal-default"
                    aria-hidden="true">
                    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="modal-title" id="modal-title-default">Adicione uma nova Sub -
                                    categoria
                                </h6>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>

                            <form role="form" method="POST"
                                action="{{ route('tutorial.primeira_parte.subcategoria') }}">
                                @csrf
                                <div class="modal-body">
                                    <input type="hidden" name="categoria_id" value="{{ $categoria_id}}">
                                    <input type="hidden" name="nome" value="{{ $nome}}">
                                    <input type="hidden" name="cliente_id" value="{{ $cliente_id}}">

                                    <div class="pl-lg-4">
                                        <div class="form-group{{ $errors->has('nome') ? ' has-danger' : '' }}">
                                            <div class="text-left">
                                                <label class="form-control-label"
                                                    for="input-current-nome">{{ __('Nome') }}</label>
                                            </div>

                                            <input type="text" name="nomeSubCategoria" id="nomeSubCategoria"
                                                class="form-control
                                                            form-control-alternative{{ $errors->has('nome') ? ' is-invalid' : '' }}"
                                                placeholder="{{ __('Digite o nome') }}" value="" required>

                                            @if ($errors->has('nomeSubCategoria'))
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
            </div>
        </div>
    </div>


</div>
@endsection

@push('js')

<script>
    CKEDITOR.replace('summary-ckeditor', {


        filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
        filebrowserBrowseUrl: '{{asset('ckeditor')}}/ckfinder/ckfinder.html',
        filebrowserUploadMethod: 'form',



    });
</script>
@endpush
