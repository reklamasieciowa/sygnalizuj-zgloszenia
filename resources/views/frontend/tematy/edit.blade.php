@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="container">

    @include('shared.info')
    
    <div class="row mb-3">
      <div class="col-lg-12">
        <h2 class="h3-responsive">
          Edytuj temat:
        </h2>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            
            @include('shared.errors')

        <form action="{{ route('subjects.update', [$subject]) }}" method="POST">
              @csrf

              <div class="mt-3">
                <label for="name">Temat</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ $subject->name }}">

                @if ($errors->has('name'))
                <div class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('name') }}</strong>
                </div>
                @endif
              </div>

              <button class="btn btn-info my-4" type="submit">Zapisz</button>
        </form>
          </div>
          <div class="col-lg-12 mb-3">
           <hr>
           <a href="{{ route('subjects') }}" title="Wróć do listy tematów" class="btn btn-info"><i class="far fa-arrow-alt-circle-left fa-lg mr-2"></i> Wróć do listy tematów</a>

           @if($subject->entries->count() == 0)
               <a href="{{ route('subjects.destroy', [$subject]) }}" class="btn btn-danger" onclick="return confirm('Czy napewno usunąć temat?')" title="Usuń">Usuń <i class="far fa-trash-alt fa-lg ml-2"></i></a>
            @endif
         </div>
       </div>
     </div>
   </div>
 </div>
</div>
@endsection