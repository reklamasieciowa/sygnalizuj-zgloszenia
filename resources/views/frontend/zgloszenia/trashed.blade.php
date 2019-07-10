@extends('layouts.app')

@section('header')
<link href="{{ asset('css/addons/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">
  <div class="container">

    @include('shared.info')

    <div class="row mb-3">
      <div class="col-lg-12">
        <h2 class="h3-responsive">
          Zgłoszenia usunięte:
        </h2>

        <form action="{{ route('entries.trashed.empty') }}" method="POST">
          @method('DELETE')
          @csrf
          <button type="submit" onclick="return confirm('Czy napewno usunąć wszystko z kosza?')" class="btn btn-sm btn-danger"><i class="far fa-trash-alt fa-lg mr-2"></i> Opróżnij kosz</a>
          </form>

        </div>
      </div>
      <div class="row">
        @if(isset($entries))
        <div class="col-lg-12 table-responsive">

          <table id="entries" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
            <thead>
              <th class="th-sm">
                Firma
              </th>
              <th class="th-sm">
                Temat
              </th>
              <th class="th-sm">
                Status
              </th>
              <th class="th-sm">
                Data
              </th>
              <th>
                Akcje
              </th>
            </thead>
            <tbody>

             @foreach($entries as $entry)
             <tr>
               <td>
                 {{ $entry->company }}
               </td>
               <td>
                 {{ $entry->subject->name }}
               </td>
               <td>

              @include('shared.statuses')

              </td>
              <td>
               {{ $entry->created_at }}<br><small>{{ Carbon\Carbon::parse($entry->created_at)->diffForHumans(null, false, false, 2) }}</small>
             </td>
             <td>
              <div class="btn-group" role="group" aria-label="Basic example">
               <form action="{{ route('entry.restore', [$entry->id]) }}" method="POST">
                @csrf          
                <button class="btn btn-sm btn-success" type="submit"><i class="fas fa-trash-restore fa-lg"></i> Przywróć</button>
              </form>
              <form action="{{ route('entry.delete', [$entry->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-danger" type="submit"><i class="far fa-trash-alt fa-lg"></i> Usuń</button>
              </form>
            </div>
            </td>
          </tr> 
          @endforeach 
        </tbody>
      </table>
    </div>
    @else
    <div class="col-lg-12">
      <p>Brak zgłoszeń.</p>
    </div>
    @endif
    <div class="col-lg-12">
     <a href="{{ route('entries') }}" title="Wróć do listy zgłoszeń" class="btn btn-info"><i class="far fa-arrow-alt-circle-left fa-lg mr-3 "></i> Wróć do listy zgłoszeń</a>
   </div>
 </div>
</div>
</div>
@endsection

@section('footer-scripts')
<script type="text/javascript" src="{{asset('js/addons/datatables.min.js')}}"></script>

<script>
  $(document).ready(function () {
    $('#entries').DataTable({
      "language": {
        "processing":     "Przetwarzanie...",
        "search":         "Szukaj:",
        "lengthMenu":     "Pokaż _MENU_ pozycji",
        "info":           "Pozycje od _START_ do _END_ z _TOTAL_ łącznie",
        "infoEmpty":      "Pozycji 0 z 0 dostępnych",
        "infoFiltered":   "(filtrowanie spośród _MAX_ dostępnych pozycji)",
        "infoPostFix":    "",
        "loadingRecords": "Wczytywanie...",
        "zeroRecords":    "Nie znaleziono pasujących pozycji",
        "emptyTable":     "Brak danych",
        "paginate": {
          "first":      "Pierwsza",
          "previous":   "Poprzednia",
          "next":       "Następna",
          "last":       "Ostatnia"
        },
        "aria": {
          "sortAscending": ": aktywuj, by posortować kolumnę rosnąco",
          "sortDescending": ": aktywuj, by posortować kolumnę malejąco"
        }
      },
      "pageLength": 10,
      "order": [[ 3, "desc" ]]

    });
    $('.dataTables_length').addClass('bs-select');
  });
</script>
@endsection