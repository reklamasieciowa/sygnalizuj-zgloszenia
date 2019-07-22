@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="container">

    @include('shared.info')
    
    <div class="row mb-3">
      <div class="col-lg-12">
        <h2 class="h3-responsive">
          Nowe zgłoszenie:
        </h2>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">

            @include('shared.errors')

            <form action="{{ route('entry.store') }}" method="POST" enctype="multipart/form-data">
              @csrf

              <div class="mt-3">
                <label for="company">Firma</label>
                <input type="text" id="company" name="company" class="form-control" value="{{ old('company') }}">

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
                  <option value="{{ $subject->id }}" @if($subject->id == old('subject_id')) selected @endif>{{ $subject->name }}</option>
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
                <input type="text" id="person" name="person" class="form-control" value="{{ old('person') }}">
                @if ($errors->has('person'))
                <div class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('person') }}</strong>
                </div>
                @endif
                <p class="explainer">
                  Podaj następujące dane kontaktowe: imię i nazwisko, mail, numer telefonu. Aby dowiedzieć jak je wykorzystamy <a href="#">kliknij tutaj</a>.
                </p>
              </div>

              <div class="mt-3">
                <label for="who">Kogo dotyczy zgłoszenie</label>
                <input type="text" id="who" name="who" class="form-control" value="{{ old('who') }}">
                @if ($errors->has('who'))
                <div class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('who') }}</strong>
                </div>
                @endif
                <p class="explainer">
                   Podaj nazwisko, stanowisko, dział, nazwę firmy, opisz jaka jest relacja w strukturze (np. przełożony, współpracownik, podwładny). Kto był świadkiem zdarzenia / zachowań, które opisujesz? Kto jeszcze wie o zaistniałej sytuacji? Kogo jeszcze to zdarzenie / zachowania dotyczyły lub dotyczą (tylko Ciebie, czy również innych pracowników)?
                </p>

              </div>

              <div class="form-group">
                <label for="what">Co się stało?</label>
                <textarea class="form-control" id="what" name="what" rows="4">{{ old('what') }}</textarea>
                @if ($errors->has('what'))
                <div class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('what') }}</strong>
                </div>
                @endif
                <p class="explainer">
                  Jakiego zdarzenia / zachowania byłeś/aś świadkiem? Co widziałeś/aś, słyszałeś/aś? Jakich sytuacji / zdarzeń / zachowań doświadczałeś/aś?
                </p>
              </div>

              <div class="mt-3">
                <label for="where">Gdzie?</label>
                <input type="text" id="where" name="where" class="form-control" value="{{ old('where') }}">
                @if ($errors->has('where'))
                <div class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('where') }}</strong>
                </div>
                @endif
                <p class="explainer">
                  Gdzie doszło do opisywanych przez Ciebie zdarzeń? Wskaż miasto, adres, oddział firmy. Czy opisywane zdarzenie/ zachowanie miało miejsce tylko w miejscu pracy, czy też poza nim? Podaj przykłady.
                </p>
              </div>

              <div class="mt-3">
                <label for="when">Kiedy?</label>
                <input type="text" id="when" name="when" class="form-control" value="{{ old('when') }}">
                @if ($errors->has('when'))
                <div class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('when') }}</strong>
                </div>
                @endif
                <p class="explainer">
                  Kiedy po raz pierwszy Twoim zdaniem doszło do takiej sytuacji / zdarzenia / zachowania? Jak często zdarzają się sytuacje tego typu? Ile razy taka sytuacja / zdarzenie / zachowanie powtórzyło się? Jak długo trwa ta sytuacja?
                </p>
              </div>

              <div class="form-group">
                <label for="how">W jaki sposób to się odbywa?</label>
                <textarea class="form-control" id="how" name="how" rows="4">{{ old('how') }}</textarea>
                @if ($errors->has('how'))
                <div class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('how') }}</strong>
                </div>
                @endif
                <p class="explainer">
                  Proszę podać konkretne przykłady zachowań / wypowiedzi (cytaty)/ czynności w opisywanej sytuacji. Jakie istnieją dowody związane ze zgłaszaną sprawą (zdjęcia, dokumenty, skany, pliki audio, wideo) ?
                </p>
              </div>

              <div class="form-group">
                <label for="attachment">Załącz plik</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupFileAddon01">Załącznik</span>
                  </div>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="attachment" name="attachment"
                    aria-describedby="inputGroupFileAddon01">
                    <label class="custom-file-label" for="attachment">Wybierz plik</label>
                  </div>
                </div>
                <p class="explainer">
                  Pliki muszą mieć mniej niż 50MB. Dozwolone typy plików: doc, docx, jpeg, jpg, png, mp4, x-flv, m3u, mp4, 3gp, mov, avi, wmv, zip.
                </p>
              </div>

              <div class="form-group">
                <label for="why">Dlaczego to się stało?</label>
                <textarea class="form-control" id="why" name="why" rows="4">{{ old('why') }}</textarea>
                @if ($errors->has('why'))
                <div class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('why') }}</strong>
                </div>
                @endif
                <p class="explainer">
                  Dlaczego Twoim zdaniem doszło do takiego zdarzenia / sytuacji / zachowania? Czy próbowałeś/aś wyjaśnić tę sytuację z daną osobą? Czy w jakikolwiek sposób wraziłeś/aś swój sprzeciw? Jaka była reakcja?
                </p>
              </div>

              <div class="form-group">
                <label for="already_done">Co zostało do tej pory zrobione?</label>
                <textarea class="form-control" id="already_done" name="already_done" rows="4">{{ old('already_done') }}</textarea>
                @if ($errors->has('already_done'))
                <div class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('already_done') }}</strong>
                </div>
                @endif
                <p class="explainer">
                  W jaki sposób radziłeś/aś sobie do tej pory z tym problemem? Jakie kroki zostały już podjęte przez Ciebie? Gdzie zostało to już przez Ciebie zgłoszone?
                </p>
              </div>

              <div class="form-group">
                <label for="anonymous">Zgłoszenie anonimowe?</label><br>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" class="custom-control-input" id="anonymous1" name="anonymous" value="0" @if( old('anonymous') === 0) checked @endif>
                  <label class="custom-control-label" for="anonymous1">Nie</label>
                </div>

                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" class="custom-control-input" id="anonymous2" name="anonymous" value="1" @if(old('anonymous') === 1) checked @endif>
                  <label class="custom-control-label" for="anonymous2">Tak</label>
                </div>

                @if ($errors->has('anonymous'))
                <div class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('anonymous') }}</strong>
                </div>
                @endif
              </div>

              <div class="form-group">
                <label for="agree">Zgoda na przetwarzenie danych</label><br>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" class="custom-control-input" id="agree1" name="agree" value="0" @if(old('agree') === 0) checked @endif>
                  <label class="custom-control-label" for="agree1">Nie</label>
                </div>

                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" class="custom-control-input" id="agree2" name="agree" value="1" @if(old('agree') === 1) checked @endif>
                  <label class="custom-control-label" for="agree2">Tak</label>
                </div>
                @if ($errors->has('agree'))
                <div class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('agree') }}</strong>
                </div>
                @endif
                <p class="explainer">
                  Wysyłając zgłoszenie wyraża Pan/Pani zgodę na przetwarzanie Pana/Pani danych osobowych przez WNCL Sp. z o.o. z siedzibą w 02-677 Warszawa ul. Cybernetyki 13 lok. 52, VI p. w celu realizacji przesłanego zgłoszenia, a także oświadcza Pan/Pani, że zapoznał się Pan/Pani z <a href="#">polityką prywatności</a> dostępną na stronie. Jeżeli nie wyrażają Państwo zgody na przetwarzanie danych osobowych - nie możemy przyjąć zgłoszenia.
                </p>
              </div>
              <button class="btn btn-info my-4" type="submit">Wyślij</button>
            </form>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection