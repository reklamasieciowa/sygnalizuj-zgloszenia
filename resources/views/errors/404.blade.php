@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="container">

    @include('shared.info')

    <div class="row">
      <div class="col-lg-12">
        <section class="text-center my-5">
          <h1 class="h2-responsive font-weight-bold mt-7 mb-5">Zaufany program ochrony pracowników tzw. <em>whistleblowing line</em></h1>
          <p class="lead grey-text w-responsive mx-auto mb-5">Z przyjemnością pomożemy Ci budować firmę bazującą na wzajemnym szacunku i zaufaniu</p>
        </section>
      </div>
    </div>

    <div class="row mb-3">
      <div class="col-lg-12 text-center my-5">
          <h2 class="h2-responsive">
            Niestety, szukana strona nie istnieje.
          </h2>
          <a href="{{ route('home') }}" class="btn btn-success">Wróć na stronę główną</a>
      </div>
    </div>

  </div>
</div>
@endsection