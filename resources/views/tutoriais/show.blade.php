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
                        @foreach ($tutorial as $dado)
                        <div class="col-md-7">
                            <h1 class="col-12 mb-0">Título: <span
                                    class="badge badge-pill badge-default">{{$dado->titulo }}</span></h1>
                            <h3 class="col-12 mb-0">Sub Categoria: <span
                                    class="badge badge-pill badge-primary">{{$dado->nomeSubCategoria }}</span>
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
                                class="btn btn-block btn-danger mb-3 text-white">Voltar para Gerenciamento de Cliente</a>
                        </div>
                        <div class="col-md-2">
                            <a type="button" class="btn btn-block btn-success mb-3 text-white" data-toggle="modal"
                                data-target="#sub_categorias">Inserir Novo Item</a>
                        </div>


                    </div>
                </div>
            </div>
            <br>
        </div>

    </div>

    <div class="modal fade" id="sub_categorias" tabindex="-1" role="dialog" aria-labelledby="modal-default"
        aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="modal-title-default">Adicione novo item de tutorial
                    </h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <form role="form" method="POST" action="{{ route('item_tutorial.store') }}"
                    enctype="multipart/form-data">
                    <input type="hidden" name="tutorial_id" value="{{$dado->id}}">
                    @csrf
                    <div class="modal-body">

                        <div class="form-group{{ $errors->has('link_video') ? ' has-danger' : '' }}">
                            <div class="text-left">
                                <label class="form-control-label"
                                    for="input-current-titulo">{{ __('Iframe Vídeo Youtube') }}</label>
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
                                <label class="form-control-label"
                                    for="input-current-nome">{{ __('Observação') }}</label>
                            </div>
                            <textarea class="form-control" id="summary-ckeditor" name="observacao" rows="3"
                                name="observacao"></textarea>
                        </div>
                        <div class="text-left">
                            <label class="form-control-label" for="input-current-nome">Inserir Imagem</label>
                        </div>
                        <div class="form-group">
                            <input type="file" id="path_foto"  name="path_foto">

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
    @foreach ($itemTutorial as $dado )
    <div class="row">
        <div class="col-xl-12 order-xl-1">
            <div class="card bg-secondary shadow">

                <div class="card-body card-primary">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-md-10">

                            </div>
                            <div class="col-md-1">
                                <a type="button"
                                    class="btn btn-block btn-primary mb-3 text-white"
                                    href="{{route('item_tutorial.edit', $dado->id)}}"><i
                                        class="ni ni-settings"></i></a>
                            </div>
                            <div class="col-md-1">
                                <a type="button" class="btn btn-block btn-danger mb-3 text-white"
                                    href="{{route('tutorial.excluir', $dado->id)}}"><i class="ni ni-fat-remove"></i></a>
                            </div>


                        </div>

                        <br>
                        <h2 class="card-title text-center">
                            <p class="card-text col-12 col-sm-12 col-md-12" style="text-align: justify">
                                <?php print_r($dado->observacao)?>
                            </p>
                            <br>
                            <br>
                            <img src="{{ URL::to('/') }}/images/{{ $dado->path_foto}}" alt="" style="max-width: 100%;">
                            <br>
                            <br>
                            <div class="col-md-auto">
                                <div class="row">
                                    <div class="col-12">
                                        <?php print_r($dado->link_video)?>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <br>

                    </div>
                </div>
            </div>
            <br>
            <br>
        </div>


    </div>

    @endforeach

</div>


@endsection

@push('js')

@endpush
