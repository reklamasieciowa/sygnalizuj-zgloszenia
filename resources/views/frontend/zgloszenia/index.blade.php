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
          Zgłoszenia: <a href="{{ route('entries.trashed') }}" class="btn btn-sm btn-info"><i class="far fa-trash-alt fa-lg mr-2"></i> Zobacz usunięte</a>
        </h2>
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

              @if($entry->status->id == 1)
                <a href="{{ route('entry.changestatus', [$entry->id]) }}" class="text-danger new">
              @elseif($entry->status->id == 2)
                <a href="{{ route('entry.changestatus', [$entry->id]) }}" class="text-warning running">
              @else
                <a href="{{ route('entry.changestatus', [$entry->id]) }}" class="text-success done">
              @endif
                {{ $entry->status->name }}
              </a>

              </td>
              <td>
               {{ $entry->created_at }}<br><small>{{ Carbon\Carbon::parse($entry->created_at)->diffForHumans(null, false, false, 2) }}</small>
             </td>
             <td>
               <a href="{{ route('entry.show', [$entry->id]) }}" title="Zobacz"><i class="far fa-eye fa-lg text-success"></i></a>
               <a href="{{ route('entry.edit', [$entry->id]) }}" title="Edytuj"><i class="fas fa-edit fa-lg text-info"></i></a>
               <a href="{{ route('entry.delete', [$entry->id]) }}" title="Usuń"><i class="far fa-trash-alt fa-lg text-danger"></i></a>
             </td>
           </tr> 
           @endforeach 
         </tbody>
       </table>
     </div>
     @else
        <p>Brak zgłoszeń.</p>
     @endif
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