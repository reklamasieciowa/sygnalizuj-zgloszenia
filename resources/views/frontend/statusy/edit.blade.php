@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="container">

    @include('shared.info')
    
    <div class="row mb-3">
      <div class="col-lg-12">
        <h2 class="h3-responsive">
          Edytuj status:
        </h2>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            
            @include('shared.errors')

        <form action="{{ route('statuses.update', [$status]) }}" method="POST">
              @csrf

              <div class="mt-3">
                <label for="name">Status</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ $status->name }}">

                @if ($errors->has('name'))
                <div class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('name') }}</strong>
                </div>
                @endif
              </div>

              <div class="mt-3">
                <label for="name">Kolor</label>
                <input type="color" id="color" name="color" class="form-control" value="{{ $status->color }}">

                @if ($errors->has('color'))
                <div class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('color') }}</strong>
                </div>
                @endif
              </div>

              <button class="btn btn-info my-4" type="submit">Zapisz</button>
        </form>
          </div>
          <div class="col-lg-12 mb-3">
           <hr>
           <a href="{{ route('statuses') }}" title="Wróć do listy statusów" class="btn btn-sm btn-success"><i class="far fa-arrow-alt-circle-left fa-lg mr-2"></i> Wróć do listy statusów</a>

           @if($status->entries->count() == 0)
              <form action="{{ route('statuses.destroy', [$status]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('Czy napewno usunąć status?')" class="btn btn-sm btn-danger" type="submit">Usuń <i class="far fa-trash-alt fa-lg"></i></button>
              </form>
            @endif
         </div>
       </div>
     </div>
   </div>
 </div>
</div>
@endsection