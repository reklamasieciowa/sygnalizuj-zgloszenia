@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="container">
    <div class="row mb-3">
      <div class="col-lg-12">
        <h2 class="h3-responsive">
          Zgłoszenie:
        </h2>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <p><strong>Firma:</strong> {{ $entry->company }}</p>
            <p><strong>Temat:</strong> {{ $entry->subject->name }}</p>
            <p><strong>Osoba:</strong> {{ $entry->person }}</p>
            <p><strong>Co się stało:</strong> {{ $entry->what }}</p>
            <p><strong>Gdzie:</strong> {{ $entry->where }}</p>
            <p><strong>Kiedy:</strong> {{ $entry->when }} ({{ Carbon\Carbon::parse($entry->when)->diffForHumans(null, false, false, 2) }})</p>
            <p><strong>Jak:</strong> {{ $entry->how }}</p>
            <p><strong>Załącznik:</strong> {{ $entry->attachment_id }}</p>
            <p><strong>Dlaczego:</strong> {{ $entry->why }}</p>
            <p><strong>Co zostało zrobione:</strong> {{ $entry->already_done }}</p>
            <p><strong>Zgłoszone:</strong> {{ $entry->created_at }} ({{ Carbon\Carbon::parse($entry->created_at)->diffForHumans(null, false, false, 2) }})</p>
            <p><strong>Zaktualizowane:</strong> {{ $entry->updated_at }} ({{ Carbon\Carbon::parse($entry->created_at)->diffForHumans(null, false, false, 2) }})</p>
            <p><strong>Anonimowe:</strong> {{ $entry->anonymous === 0 ? "Nie" : "Tak" }}</p>
            <p><strong>Zgoda na przetwarzenie danych:</strong> {{ $entry->agree === 0 ? "Nie" : "Tak" }}</p>
            <p><strong>Nr ref.:</strong> {{ $entry->hash }}</p>
          </div>
          <div class="col-lg-12">
            <hr>
            <strong>Status:</strong> 
                @include('shared.statuses')
              </div>

              <div class="col-lg-12 mb-3">
               <hr>
               <a class="btn btn-sm btn-success" href="{{ route('entries') }}" title="Wróć do listy zgłoszeń" class="mr-3"><i class="far fa-arrow-alt-circle-left fa-lg"></i> Wróć do listy zgłoszeń</a>
               <a class="btn btn-sm btn-info" href="{{ route('entry.edit', [$entry->id]) }}" title="Edytuj" class="mr-3"><i class="fas fa-edit fa-lg"></i> Edytuj</a>

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
