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
                            <a type="button" href="{{route('sub_categoria.show', $subCategoriaId)}}"
                                class="btn btn-primary">
                                Voltar para Cliente
                            </a>
                        </div>
                    </div>
                </div>


                <form role="form" method="POST" action="{{ route('tutorial.update', $tutorial->id) }}"
                    enctype="multipart/form-data">
                    @csrf

                    @method('PUT')
                    <div class="pl-lg-4">

                        <div class="form-group">
                            <div class="text-left">
                                <label for="exampleFormControlSelect1">Sub Categoria</label>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-11">
                                    <select class="form-control" id="exampleFormControlSelect1" name="sub_categoria_id">
                                        @foreach ($sub_categoria as $item)

                                             <option value="{{$item->id}}"
                                                 {{ (old('tipo_solicitante_id') == $item->id ? 'selected'  : ($tutorial->sub_categoria_id  == $item->id ? 'selected' : '')) }}>
                                                 {{$item->nome}}</option>

                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-2 col-md-1">
                                    <a type="button" href="{{route('sub_categoria.index')}}"
                                        class="btn btn-danger col-md-12 text-center text-white" data-toggle="modal"
                                        data-target="#sub_categorias">Adicionar</a>
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
                                placeholder="{{ __('Digite o titulo') }}" value="{{$tutorial->titulo}}">

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
                                placeholder="{{ __('Digite o titulo') }}" value="{{$tutorial->passo_numero}}">

                            @if ($errors->has('passo_numero'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('passo_numero') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('link_video') ? ' has-danger' : '' }}">
                            <div class="text-left">
                                <label class="form-control-label"
                                    for="input-current-titulo">{{ __('Iframe Vídeo Youtube') }}</label>
                            </div>
                            <input type="text" name="link_video" id="link_video" value="{{$tutorial->link_video}}"
                                class="form-control
                                                            form-control-alternative{{ $errors->has('link_video') ? ' is-invalid' : '' }}"
                                placeholder="{{ __('Cole o link do iframe do video no youtube (Opcional)') }}">

                            @if ($errors->has('link_video'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('titulo') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <div class="text-left">
                                <label class="form-control-label"
                                    for="input-current-nome">{{ __('Observação') }}</label>
                            </div>
                            <textarea class="form-control" id="summary-ckeditor" name="observacao" rows="3"
                                name="observacao">
                                <?php
                                    print($tutorial->observacao)
                                ?>
                                </textarea>
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


                                    <div class="pl-lg-4">
                                        <div class="form-group{{ $errors->has('nome') ? ' has-danger' : '' }}">
                                            <div class="text-left">
                                                <label class="form-control-label"
                                                    for="input-current-nome">{{ __('Nome') }}</label>
                                            </div>

                                            <input type="text" name="nomeSubCategoria" id="nomeSubCategoria"
                                                class="form-control
                                                            form-control-alternative{{ $errors->has('nome') ? ' is-invalid' : '' }}" placeholder="{{ __('Digite o nome') }}"
                                                value="" required>

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

<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('summary-ckeditor', {
        filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form',
    });
</script>
@endpush
