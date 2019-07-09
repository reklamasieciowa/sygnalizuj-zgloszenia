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

              <div class="md-form mt-3">
                <input type="text" id="company" name="company" class="form-control" value="{{$entry->company}}">
                <label for="company">Firma</label>
                @if ($errors->has('company'))
                <div class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('company') }}</strong>
                </div>
                @endif
              </div>

              <div class="md-form mt-3">
                Temat:
                <select name="subject_id" id="subject_id" class="browser-default custom-select">
                  <option value="" disabled selected>Temat</option>
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

              <div class="md-form mt-3">
                <input type="text" id="person" name="person" class="form-control" value="{{$entry->person}}">
                <label for="person">Osoba</label>
                @if ($errors->has('person'))
                <div class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('person') }}</strong>
                </div>
                @endif
              </div>

                <div class="md-form mt-3">
                <input type="text" id="who" name="who" class="form-control" value="{{$entry->who}}">
                <label for="who">Kto</label>
                @if ($errors->has('who'))
                <div class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('who') }}</strong>
                </div>
                @endif
              </div>

              <div class="form-group">
                <label for="what">Co się stało?</label>
                <textarea class="form-control" id="what" name="what" rows="4">{{$entry->what}}</textarea>
                @if ($errors->has('what'))
                <div class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('what') }}</strong>
                </div>
                @endif
              </div>

              <div class="md-form mt-3">
                <input type="text" id="where" name="where" class="form-control" value="{{$entry->where}}">
                <label for="where">Gdzie?</label>
                @if ($errors->has('where'))
                <div class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('where') }}</strong>
                </div>
                @endif
              </div>

              <div class="md-form mt-3">
                <input type="text" id="when" name="when" class="form-control" value="{{$entry->when}}">
                <label for="when">Kiedy</label>
                @if ($errors->has('when'))
                <div class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('when') }}</strong>
                </div>
                @endif
              </div>

              <div class="form-group">
                <label for="how">Jak do tego doszło?</label>
                <textarea class="form-control" id="how" name="how" rows="4">{{$entry->how}}</textarea>
                @if ($errors->has('how'))
                <div class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('how') }}</strong>
                </div>
                @endif
              </div>

              Załącznik  {{ $entry->attachment_id }}

              <div class="form-group">
                <label for="why">Dlaczego to się stało?</label>
                <textarea class="form-control" id="why" name="why" rows="4">{{$entry->why}}</textarea>
                @if ($errors->has('why'))
                <div class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('why') }}</strong>
                </div>
                @endif
              </div>

              <div class="form-group">
                <label for="already_done">Co zostało do tej pory zrobione?</label>
                <textarea class="form-control" id="already_done" name="already_done" rows="4">{{$entry->already_done}}</textarea>
                @if ($errors->has('already_done'))
                <div class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('already_done') }}</strong>
                </div>
                @endif
              </div>

              <div class="form-group">
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

              <div class="form-group">
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

              <div class="md-form mt-3">
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
           <a href="{{ route('entries') }}" title="Wróć do listy zgłoszeń" class="mr-3"><i class="far fa-arrow-alt-circle-left fa-lg text-success"></i> Wróć do listy zgłoszeń</a>
           <a href="{{ route('entry.delete', [$entry->id]) }}" title="Usuń" class="mr-3"><i class="far fa-trash-alt fa-lg text-danger"></i> Usuń</a>
         </div>
       </div>
     </div>
   </div>
 </div>
</div>
@endsection