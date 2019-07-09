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
        @if($entry->status->id == 1)
        <a href="{{ route('entry.changestatus', [$entry->id]) }}" class="text-danger new">
          @elseif($entry->status->id == 2)
          <a href="{{ route('entry.changestatus', [$entry->id]) }}" class="text-warning running">
            @else
            <a href="{{ route('entry.changestatus', [$entry->id]) }}" class="text-success done">
              @endif
              {{ $entry->status->name }}
            </a>
          </div>

          <div class="col-lg-12 mb-3">
             <hr>
            <a href="{{ route('entries') }}" title="Wróć do listy zgłoszeń" class="mr-3"><i class="far fa-arrow-alt-circle-left fa-lg text-success"></i> Wróć do listy zgłoszeń</a>
            <a href="{{ route('entry.edit', [$entry->id]) }}" title="Edytuj" class="mr-3"><i class="fas fa-edit fa-lg text-info"></i> Edytuj</a>
               <a href="{{ route('entry.delete', [$entry->id]) }}" title="Usuń" class="mr-3"><i class="far fa-trash-alt fa-lg text-danger"></i> Usuń</a>
          </div>
        </div>
</div>
</div>
      </div>
    </div>
    @endsection
