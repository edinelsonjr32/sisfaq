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
                            <a type="button" href=""
                                class="btn btn-primary">
                                Voltar para Cliente
                            </a>
                        </div>
                    </div>
                </div>


                <form role="form" method="POST" action="{{ route('item_tutorial.update', $itemTutorial->id) }}"
                    enctype="multipart/form-data">
                    @method('PUT')
                    <input type="hidden" name="tutorial_id" value="">
                    @csrf
                    <div class="modal-body">

                        <div class="form-group">
                            <div class="text-left">
                                <label class="form-control-label"
                                    for="input-current-nome">{{ __('Observação') }}</label>
                            </div>
                            <textarea class="form-control" id="summary-ckeditor" name="observacao" rows="3"
                                name="observacao">
                                {{$itemTutorial->observacao}}
                                </textarea>
                        </div>
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

                        <div class="text-left">
                            <label class="form-control-label" for="input-current-nome">Inserir Imagem</label>
                        </div>
                        <div class="form-group">
                            <input type="file" id="path_foto" name="path_foto">

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
@endsection

@push('js')


@endpush
