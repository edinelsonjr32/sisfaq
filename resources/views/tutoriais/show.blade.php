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
                        <div class="col-md-8">
                            <h1 class="col-12 mb-0">{{$subCategoria->nome }}</h1>
                        </div>
                        <div class="col-md-4">
                            <a type="button" href="{{route('cliente.show', $cliente_id)}}"
                                class="btn btn-block btn-info mb-3 text-white">Voltar para Gerenciamento de Cliente</a>
                        </div>
                    </div>
                </div>
            </div>
            <br>
        </div>
    </div>
    @foreach ($tutorial as $dado )
    <div class="row">

        <div class="col-xl-12 order-xl-1">
            <div class="card bg-secondary shadow">
                <div class="card-profile-image">
                    <a href="#">
                        <img src="http://localhost:8000/argon/img/theme/paper2.png" class="rounded-circle" width="60px">
                    </a>
                    <br>
                </div>
                <div class="card-body card-primary">
                    <div class="container">
                        <h1 class="card-title text-center">{{$dado->titulo}}</h1>
                        <h2 class="card-title text-center">

                            <h2 class="card-title text-center">Passo: {{$dado->passo_numero}}</h2>

                            <img src="{{ URL::to('/') }}/images/{{ $dado->path_foto}}" alt="" style="max-width: 100%;">
                            <p class="card-text" width="20%" style="text-align: justify">
                                <?php print_r($dado->observacao)?>
                            </p>
                            <div class="col-md-auto">
                                <div class="row">
                                    <div class="col-md-auto">
                                        <?php print_r($dado->link_video)?>
                                    </div>
                                </div>
                            </div>

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
