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
                            <a type="button" href="{{route('sub_categoria.index')}}" class="btn btn-primary">
                                Voltar para Gerenciamento de Sub Categoria
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
                                        <label class="form-control-label"
                                            for="input-current-nome">{{ __('Cliente') }}</label>
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
                                        <label class="form-control-label"
                                            for="input-current-nome">{{ __('Categoria') }}</label>
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
                            <select class="form-control" id="exampleFormControlSelect1" name="sub_categoria_id">
                                @foreach ($sub_categoria as $item)
                                <option value="{{$item->id}}">
                                    {{$item->nome}}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group{{ $errors->has('titulo') ? ' has-danger' : '' }}">
                            <div class="text-left">
                                <label class="form-control-label" for="input-current-titulo">{{ __('Titulo') }}</label>
                            </div>
                            <input type="text" name="titulo" id="titulo"
                                class="form-control
                                                            form-control-alternative{{ $errors->has('titulo') ? ' is-invalid' : '' }}"
                                placeholder="{{ __('Digite o titulo') }}" value="{{$titulo}}">

                            @if ($errors->has('titulo'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('titulo') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('passo_numero') ? ' has-danger' : '' }}">
                            <div class="text-left">
                                <label class="form-control-label" for="input-current-titulo">{{ __('Passo Nº') }}</label>
                            </div>
                            <input type="text" name="passo_numero" id="passo_numero"
                                class="form-control
                                                            form-control-alternative{{ $errors->has('passo_numero') ? ' is-invalid' : '' }}"
                                placeholder="{{ __('Digite o titulo') }}" >

                            @if ($errors->has('passo_numero'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('passo_numero') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('foto') ? ' has-danger' : '' }}">
                            <div class="text-left">
                                <label class="form-control-label" for="input-current-nome">{{ __('Foto') }}</label>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFileLang" lang="en" name="path_foto">
                                <label class="custom-file-label" for="customFileLang">Selecione o Arquivo (Opcional)</label>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('link_video') ? ' has-danger' : '' }}">
                            <div class="text-left">
                                <label class="form-control-label" for="input-current-titulo">{{ __('Iframe Vídeo Youtube') }}</label>
                            </div>
                            <input type="text" name="link_video" id="link_video"
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
                                 <label class="form-control-label" for="input-current-nome">{{ __('Observação') }}</label>
                             </div>
                            <textarea class="form-control ckeditor" id="exampleFormControlTextarea1" rows="3"
                                name="observacao"></textarea>
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
            </div>
        </div>
    </div>


</div>
@endsection

@push('js')

<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.ckeditor').ckeditor();
    });
</script>
@endpush
