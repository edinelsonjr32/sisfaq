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
                 <form role="form" method="POST" action="{{ route('tutorial.update', $tutorial->id) }}" enctype="multipart/form-data">
                     @csrf
@method('PUT')

                     <div class="pl-lg-4">


                         <div class="form-group">
                             <div class="text-left">
                                 <label for="exampleFormControlSelect1">Sub Categoria</label>
                             </div>
                             <div class="row">
                                 <div class="col-12 col-md-12">
                                     <select class="form-control" id="exampleFormControlSelect1"
                                         name="sub_categoria_id">
                                         @foreach ($subCategorias as $item)
                                         <option value="{{$item->id}}"
                                             {{old('sub_categoria_id') == $item->id ? 'selected' : ($tutorial->sub_categoria_id == $item->id ? 'selected' : '')}}>
                                             {{$item->nome}} - {{$item->nomeCategoria}}</option>
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
                                 placeholder="{{ __('Digite o titulo') }}" value="{{$tutorial->titulo}}">

                             @if ($errors->has('titulo'))
                             <span class="invalid-feedback" role="alert">
                                 <strong>{{ $errors->first('titulo') }}</strong>
                             </span>
                             @endif
                         </div>
                     </div>


                     <div class="card-footer py-4">
                         <nav class="d-flex justify-content-end" aria-label="...">
                             <a type="button" href="{{route('sub_categoria.show', $tutorial->sub_categoria_id)}}"
                                 class="btn btn-danger col-md-2 text-center text-white">Sair</a>
                             <button type="submit" class="btn btn-success col-md-2 text-white">Avançar</button>
                         </nav>
                     </div>

                 </form>




            </div>
        </div>
    </div>


</div>
@endsection

@push('js')


@endpush
