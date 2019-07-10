@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="container">

    @include('shared.info')
    
    <div class="row mb-3">
      <div class="col-lg-12">
        <h2 class="h3-responsive">
          Edytuj zgłoszenie:
        </h2>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            
            @include('shared.errors')

            <form action="{{ route('entry.update', [$entry->id]) }}" method="POST">
              @csrf

              <div class="mt-3">
                <label for="company">Firma</label>
                <input type="text" id="company" name="company" class="form-control" value="{{$entry->company}}">
                @if ($errors->has('company'))
                <div class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('company') }}</strong>
                </div>
                @endif
              </div>

              <div class="mt-3">
                <label for="subject_id">Temat:</label>
                <select name="subject_id" id="subject_id" class="browser-default custom-select">
                  @foreach($subjects as $subject)
                  <option value="{{ $subject->id }}" @if($entry->subject_id == $subject->id) selected @endif>{{ $subject->name }}</option>
                  @endforeach
                </select>
                @if ($errors->has('subject_id'))
                <div class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('subject_id') }}</strong>
                </div>
                @endif
              </div>

              <div class="mt-3">
                <label for="person">Osoba zgłaszająca</label>
                <input type="text" id="person" name="person" class="form-control" value="{{$entry->person}}">

                @if ($errors->has('person'))
                <div class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('person') }}</strong>
                </div>
                @endif
              </div>

                <div class="mt-3">
                <label for="who">Kogo dotyczy zgłoszenie</label>
                <input type="text" id="who" name="who" class="form-control" value="{{$entry->who}}">

                @if ($errors->has('who'))
                <div class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('who') }}</strong>
                </div>
                @endif
              </div>

              <div class="mt-3">
                <label for="what">Co się stało?</label>
                <textarea class="form-control" id="what" name="what" rows="4">{{$entry->what}}</textarea>
                @if ($errors->has('what'))
                <div class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('what') }}</strong>
                </div>
                @endif
              </div>

              <div class="mt-3">
                <label for="where">Gdzie?</label>
                <input type="text" id="where" name="where" class="form-control" value="{{$entry->where}}">

                @if ($errors->has('where'))
                <div class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('where') }}</strong>
                </div>
                @endif
              </div>

              <div class="mt-3">
                <label for="when">Kiedy</label>
                <input type="text" id="when" name="when" class="form-control" value="{{$entry->when}}">

                @if ($errors->has('when'))
                <div class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('when') }}</strong>
                </div>
                @endif
              </div>

              <div class="mt-3">
                <label for="how">W jaki sposób to się odbywa?</label>
                <textarea class="form-control" id="how" name="how" rows="4">{{$entry->how}}</textarea>
                @if ($errors->has('how'))
                <div class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('how') }}</strong>
                </div>
                @endif
              </div>

              <div class="mt-3">
                Załącznik  {{ $entry->attachment_id }}
              </div>

              <div class="mt-3">
                <label for="why">Dlaczego to się stało?</label>
                <textarea class="form-control" id="why" name="why" rows="4">{{$entry->why}}</textarea>
                @if ($errors->has('why'))
                <div class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('why') }}</strong>
                </div>
                @endif
              </div>

              <div class="mt-3">
                <label for="already_done">Co zostało do tej pory zrobione?</label>
                <textarea class="form-control" id="already_done" name="already_done" rows="4">{{$entry->already_done}}</textarea>
                @if ($errors->has('already_done'))
                <div class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('already_done') }}</strong>
                </div>
                @endif
              </div>

              <div class="mt-3">
                <label for="anonymous">Zgłoszenie anonimowe?</label><br>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" class="custom-control-input" id="anonymous1" name="anonymous" value="0" @if($entry->anonymous === 0) checked @endif>
                  <label class="custom-control-label" for="anonymous1">Nie</label>
                </div>

                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" class="custom-control-input" id="anonymous2" name="anonymous" value="1" @if($entry->anonymous === 1) checked @endif>
                  <label class="custom-control-label" for="anonymous2">Tak</label>
                </div>

                @if ($errors->has('anonymous'))
                <div class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('anonymous') }}</strong>
                </div>
                @endif
              </div>

              <div class="mt-3">
                <label for="agree">Zgoda na przetwarzenie danych?</label><br>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" class="custom-control-input" id="agree1" name="agree" value="0" @if($entry->agree === 0) checked @endif>
                  <label class="custom-control-label" for="agree1">Nie</label>
                </div>

                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" class="custom-control-input" id="agree2" name="agree" value="1" @if($entry->agree === 1) checked @endif>
                  <label class="custom-control-label" for="agree2">Tak</label>
                </div>
                @if ($errors->has('agree'))
                <div class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('agree') }}</strong>
                </div>
                @endif
              </div>

              <div class="mt-3">
                Status:
                <select name="status_id" id="status_id" class="browser-default custom-select">
                  <option value="" disabled selected>Status</option>
                  @foreach($statuses as $status)
                  <option value="{{ $status->id }}" @if($entry->status_id == $status->id) selected @endif>{{ $status->name }}</option>
                  @endforeach
                </select>
              </div>

              <button class="btn btn-info my-4" type="submit">Zapisz</button>
            </form>
          </div>
          <div class="col-lg-12 mb-3">
           <hr>
           <a class="btn btn-sm btn-success" href="{{ route('entries') }}" title="Wróć do listy zgłoszeń" class="mr-3"><i class="far fa-arrow-alt-circle-left fa-lg"></i> Wróć do listy zgłoszeń</a>

           <form action="{{ route('entry.delete', [$entry->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-danger" type="submit"><i class="far fa-trash-alt fa-lg"></i> Usuń</button>
              </form>
         </div>
       </div>
     </div>
   </div>
 </div>
</div>
@endsection