@extends('layouts.site')
<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main"
            aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        @foreach ($cliente as $dado )
        <a class="navbar-brand pt-2" href="{{ route('site.index', $dado->link_acesso) }}">
            SisFAQ
        </a>
        <a class="navbar-brand pt-3" href="#">

            {{$dado->nomeCliente}}

        </a>
        <h5 class="text-center">{{$dado->dominio}}</h5>
        @endforeach

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
                <li class="nav-item">
                    <a class="nav-link active" href="#navbar-examples" data-toggle="collapse" role="button"
                        aria-expanded="true" aria-controls="navbar-examples">
                        <i class="ni ni-circle-08" style="color: #f4645f;"></i>
                        <span class="nav-link-text" style="color: #f4645f;">{{ __('Versão') }}</span>
                    </a>
                    <div class="collapse show" id="navbar-examples">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    {{ $versaoCliente}}
                                </a>
                            </li>
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
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                @foreach ($cliente as $dado )
                                <form role="form" method="POST" action="{{ route('site.busca', $dado->link_acesso) }}">
                                    @endforeach
                                    @csrf
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Buscar por
                                            termo</label>
                                        <input class="form-control" type="text" placeholder="Insira um termo"
                                            id="example-text-input" name="termo">
                                    </div>

                                    <button type="submit" class="btn btn-default btn-lg btn-block">
                                        Buscar</button>

                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                <br>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h1 class="mb-0">Resultado Busca do termo: "{{$termo}}"</h1>
                            </div>

                        </div>
                    </div>

                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                @foreach ($dadosBuscados as $dado)
                                <div class="col-sm">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <h3 class="card-title text-uppercase text-muted mb-0">
                                                        {{$dado->titulo}}</h3>
                                                    <span type="button" class="badge badge-default">
                                                        <span>{{$dado->nomeSubCategoria}}</span>
                                                    </span>
                                                </div>
                                                <div class="col-6">
                                                    <a href="{{route('site.sub_categoria', [$codigo, $dado->sub_categoria_id])}}"
                                                        class="btn btn-primary col-6">Acessar</a>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
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
