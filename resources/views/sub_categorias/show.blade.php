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



@endsection

@push('js')

@endpush
