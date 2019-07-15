@extends('layouts.app')

@section('header')
<link href="{{ asset('css/addons/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">
  <div class="container">

    @include('shared.info')

    <div class="row mb-3 text-center">

      <div class="col-lg-4">
        <div class="card">
          <div class="view overlay text-center ico-img">
            <a href="{{ route('entries') }}">
             <i class="fas fa-envelope-open-text"></i>
            </a>
          </div>
          <div class="card-body">
            <h2 class="card-title h5-responsive">
              Zgłoszenia
            </h2>
            <p>
              <a class="btn btn-success" href="{{ route('entries') }}" title="Zobacz" class="mr-3"><i class="far fa-eye fa-lg"></i></i> Zobacz</a>
            </p>
          </div>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="card">
          <div class="view overlay text-center ico-img">
            <a href="{{ route('statuses') }}">
             <i class="fas fa-flag"></i>
            </a>
          </div>
          <div class="card-body">
            <h2 class="card-title h5-responsive">
              Statusy
            </h2>
            <p>
              <a class="btn btn-success" href="{{ route('statuses') }}" title="Zobacz" class="mr-3"><i class="far fa-eye fa-lg"></i> Zobacz</a>
            </p>
          </div>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="card">
          <div class="view overlay text-center ico-img">
            <a href="{{ route('subjects') }}">
             <i class="far fa-comment-dots"></i>
            </a>
          </div>
          <div class="card-body">
            <h2 class="card-title h5-responsive">
              Tematy
            </h2>
            <p>
              <a class="btn btn-success" href="{{ route('subjects') }}" title="Zobacz" class="mr-3"><i class="far fa-eye fa-lg"></i> Zobacz</a>
            </p>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection

