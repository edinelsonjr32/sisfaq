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
                @foreach ($subCategoria as $dado)
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Sub Categorias</h3>
                        </div>
                        <div class="col-4 text-right">
                            <!-- Button trigger modal -->
                            <a type="button" href="{{route('cliente.show', $dado->cliente_id)}}" class="btn btn-primary">
                                Voltar para Gerenciamento de cliente
                            </a>
                        </div>
                    </div>
                </div>




                <form role="form" method="POST" action="{{ route('sub_categoria.update', $dado->id) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="cliente_id" value="{{ $dado->cliente_id }}">
                    <div class="pl-lg-4">
                        <div class="form-group{{ $errors->has('nome') ? ' has-danger' : '' }}">
                            <div class="text-left">
                                <label class="form-control-label" for="input-current-nome">{{ __('Nome') }}</label>
                            </div>

                            <input type="text" name="nome" id="nome"
                                class="form-control
                                                            form-control-alternative{{ $errors->has('nome') ? ' is-invalid' : '' }}"
                                placeholder="{{ __('Digite o nome') }}" value="{{$dado->nome}}" required>

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
                                @foreach ($categorias as $item)
                                <option value="{{$item->id}}"
                                    {{old('categoria_id') == $item->id ? 'selected' : ($dado->categoria_id == $item->id ? 'selected' : '')}}>
                                    {{$item->nome}}</option>

                                @endforeach

                            </select>
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

                @endforeach
            </div>
        </div>
    </div>


</div>
@endsection

@push('js')
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush
