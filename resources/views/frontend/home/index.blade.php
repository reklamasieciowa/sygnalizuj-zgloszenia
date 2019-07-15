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


        <section class="text-center my-5">
          <h1 class="h2-responsive font-weight-bold mt-7 mb-5">Zaufany program ochrony pracowników tzw. <em>whistleblowing line</em></h1>
          <p class="lead grey-text w-responsive mx-auto mb-5">Z przyjemnością pomożemy Ci budować firmę bazującą na wzajemnym szacunku i zaufaniu</p>
          <div class="row">
            <div class="col-md-4"> <i class="fas fa-info-circle fa-3x blue-syg-text"></i>
              <h5 class="font-weight-bold my-4">O programie</h5>
              <p class="grey-text mb-md-0 mb-5">Dzięki kontaktowi z naszą infolinią lub skorzystaniu ze specjalnego formularza, pracownicy mogą w prosty, bezpieczny sposób (anonimowo lub jawnie) zasygnalizować przypadki nieetycznych zachowań w firmie.</p> <a href="http://sygnalizuj.com/o-programie/" target="_blank" class="btn btn-light-gray btn-sm mt-4 waves-effect waves-light" role="button">Więcej <i class="fas fa-angle-double-right"></i></a></div>
              <div class="col-md-4"> <i class="fas fa-book fa-3x blue-syg-text"></i>
                <h5 class="font-weight-bold my-4">Oferta</h5>
                <p class="grey-text mb-md-0 mb-5">Oferujemy firmom najwyższej jakości whistleblowing line… Ale nie tylko!</p> <a href="http://sygnalizuj.com/oferta/" target="_blank" class="btn btn-light-gray btn-sm mt-4 waves-effect waves-light" role="button">Więcej <i class="fas fa-angle-double-right"></i></a></div>
                <div class="col-md-4"> <i class="fas fa-user-tie fa-3x blue-syg-text"></i>
                  <h5 class="font-weight-bold my-4">Dla kogo</h5>
                  <p class="grey-text mb-0">Powiedz nam, kim jesteś: wtedy najlepiej będziemy mogli Ci pomóc.</p> <a href="http://sygnalizuj.com/jestem-tu-poniewaz/" target="_blank" class="btn btn-light-gray btn-sm mt-4 waves-effect waves-light" role="button">Więcej <i class="fas fa-angle-double-right"></i></a></div>
                </div>
                <div class="row mt-5">
                  <div class="col-md-4"> <i class="fas fa-user-shield fa-3x blue-syg-text"></i>
                    <h5 class="font-weight-bold my-4">Blog Compliance Management</h5>
                    <p class="grey-text mb-md-0 mb-5">W jednej chwili firma, która dotąd cieszyła się szacunkiem i zaufaniem klientów, może ponieść wielomilionowe straty. Dowiedz się jak Compliance może temu zapobiec.</p> <a href="http://sygnalizuj.com/kategoria/blog/compliance-management/" target="_blank" class="btn btn-light-gray btn-sm mt-4 waves-effect waves-light" role="button">Więcej <i class="fas fa-angle-double-right"></i></a></div>
                    <div class="col-md-4"> <i class="far fa-life-ring fa-3x blue-syg-text"></i>
                      <h5 class="font-weight-bold my-4">Blog dla szukających pomocy</h5>
                      <p class="grey-text mb-md-0 mb-5">Doświadczasz lub obserwujesz, mobbingu, dyskryminacji, kradzieży, łamani prawa lub innych działań nie etycznych. Dowiedz się więcej ja pomóc sobie lub innym.</p> <a href="http://sygnalizuj.com/kategoria/blog/dla-pracownikow-szukajacych-pomocy/" target="_blank" class="btn btn-light-gray btn-sm mt-4 waves-effect waves-light" role="button">Więcej <i class="fas fa-angle-double-right"></i></a></div>
                      <div class="col-md-4"> <i class="far fa-comments fa-3x blue-syg-text"></i>
                        <h5 class="font-weight-bold my-4">Kontakt</h5>
                        <p class="grey-text mb-0">Zadzwoń lub napisz wspólnie będzie łatwiej.</p> <a href="http://sygnalizuj.com/kontakt/" target="_blank" class="btn btn-light-gray btn-sm mt-4 waves-effect waves-light" role="button">Więcej <i class="fas fa-angle-double-right"></i></a></div>
                      </div>
                    </section>


                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="card">
                      <div class="card-body">
                        <h2 class="card-title h5-responsive">
                          Wyślij zgłoszenie
                        </h2>
                        <p>Możesz w prosty, bezpieczny sposób (anonimowo lub jawnie) zasygnalizować przypadki nieetycznych zachowań w firmie.</p>
                        <a href="{{ route('entry.create') }}" class="btn btn-success waves-effect waves-light" role="button">Prześlij zgłoszenie <i class="fas fa-paper-plane fa-lg ml-2"></i></a>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="card">
                      <div class="card-body">
                        <h2 class="card-title h5-responsive">
                          Sprawdź status zgłoszenia:
                        </h2>

                        @include('shared.errors')
                        <form action="{{ route('status.check') }}" method="POST">
                          @csrf

                          <div class="mt-3">
                            <input type="text" id="hash" name="hash" class="form-control" value="{{ old('hash') }}" placeholder="numer zgłoszenia">

                            @if ($errors->has('hash'))
                            <div class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('hash') }}</strong>
                            </div>
                            @endif
                          </div>
                          <button class="btn btn-info mt-4" type="submit">Sprawdź</button>
                        </form>

                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
            @endsection