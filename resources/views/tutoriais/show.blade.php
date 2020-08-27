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
                            <h3 class="mb-0">Tutorial</h3>
                        </div>
                        <div class="col-4 text-right">
                            <!-- Button trigger modal -->
                            <a type="button" href="{{route('tutorial.index')}}" class="btn btn-primary">
                                Voltar para Gerenciamento de Tutoriais
                            </a>
                        </div>
                    </div>
                    <br>
                    <div class="row justify-content-md-center">
                        <div class="col col-lg-2">

                        </div>
                        <div class="col-md-8">
                            <div class="card">

                                <div class="card-profile-image">
                                    <a href="#">
                                        <img src="http://localhost:8000/argon/img/theme/paper2.png"
                                            class="rounded-circle">
                                    </a>
                                </div>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <div class="card-body">
                                    @foreach ($tutorial  as $dado )
                                        <h1 class="card-title text-center">{{$dado->titulo}}</h1>
                                        <h2 class="card-title text-center">
                                            {{$dado->nomeCategoria}} / {{$dado->nomeSubCategoria}}</h2>
                                        <h2 class="card-title text-center">Cliente: {{$dado->nomeCliente}}</h2>
                                        <h2 class="card-title text-center">Passo: {{$dado->passo_numero}}</h2>

                                        <img src="{{ URL::to('/') }}/images/{{ $dado->path_foto}}" alt=""
                                            style="max-width: 100%;">
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


                                    @endforeach

                                </div>
                            </div>
                        </div>
                        <div class="col col-lg-2">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>




</div>


@endsection

@push('js')

@endpush
