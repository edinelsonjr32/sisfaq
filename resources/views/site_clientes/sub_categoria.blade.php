@extends('layouts.site')
<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main"
            aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('home') }}">

                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse"
                            data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false"
                            aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Form -->

            <!-- Navigation -->
            <ul class="navbar-nav">

                <li class="nav-item">
                    <a class="nav-link active" href="#navbar-examples" data-toggle="collapse" role="button"
                        aria-expanded="true" aria-controls="navbar-examples">
                        <i class="ni ni-circle-08" style="color: #f4645f;"></i>
                        <span class="nav-link-text" style="color: #f4645f;">{{ __('Categorias') }}</span>
                    </a>
                    <div class="collapse show" id="navbar-examples">
                        <ul class="nav nav-sm flex-column">
                            @foreach ($categorias as $item)
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('site.categoria', [$codigo, $item->id])}}">
                                    {{ $item->nome}}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                </li>
            </ul>

            </ul>
        </div>
    </div>
</nav>

<div class="main-content">

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
                                <h3 class="mb-0">{{$nomeCategoria}} / {{$nomeSubCategoria}}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <!-- Button trigger modal -->
                                <a type="button" href="{{route('site.categoria', [$codigo, $id])}}" class="btn btn-primary">
                                    Voltar para Gerenciamento de Usuário
                                </a>
                            </div>

                        </div>
                    </div>

                    <div class="card-body">
                        <div class="container">
                           <div class="row justify-content-md-center">
                               @foreach ($sub_categorias as $dado )

                               <div class="col-8">
                                   <div class="card">

                                       <div class="card-profile-image">
                                           <a href="#">
                                               <img src="http://localhost:8000/argon/img/theme/paper2.png"
                                                   class="rounded-circle" width="60px">
                                           </a>
                                       </div>
                                       <br>
                                       <br>
                                       <div class="card-body">

                                           <h1 class="card-title text-center">{{$dado->titulo}}</h1>
                                           <h2 class="card-title text-center">

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
                                       </div>
                                   </div>
                                    <br>
                                    <br>
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
</div>

@push('js')
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush
