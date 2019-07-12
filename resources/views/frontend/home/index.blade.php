@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="container">

    @include('shared.info')
    
    <div class="row mb-3">
      <div class="col-lg-12">

      </div>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
              <h2 class="card-title h3-responsive">
                Sprawdź status zgłoszenia:
              </h2>

            @if(isset($entry))
              <div class="alert alert-info">
                <p><i class="fas fa-info-circle text-info mr-2"></i> Twoje zgłoszenie ma status: {{ $entry->status->name }}</p>
              </div>
            @elseif(isset($none))
                <div class="alert alert-danger">
                    <p><i class="fas fa-exclamation-triangle text-danger mr-2"></i> Nie znaleziono zgłoszeń.</p>
                </div>
            @endif

              @include('shared.errors')
              <form action="{{ route('status.check') }}" method="POST">
                @csrf

                <div class="mt-3">
                  <label for="hash">Wprowadź numer zgłoszenia:</label>
                  <input type="text" id="hash" name="hash" class="form-control" value="{{ old('hash') }}">

                  @if ($errors->has('hash'))
                  <div class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('hash') }}</strong>
                  </div>
                  @endif
                </div>
                <button class="btn btn-info my-4" type="submit">Sprawdź</button>
              </form>
            
          </div>
       </div>
     </div>
   </div>
 </div>
</div>
@endsection