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
          Statusy: 
        </h2>
      </div>
    </div>

    <div class="row">
      @if(isset($statuses))
      <div class="col-lg-12 table-responsive">

        <table id="statuses" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
          <thead>
            <th class="th-sm">
              Status
            </th>
            <th>
              Kolor
            </th>
            <th>
              Ilość zgłoszeń
            </th>
            <th>
              Akcje
            </th>
          </thead>
          <tbody>

           @foreach($statuses as $status)
           <tr>
             <td>
               {{ $status->name }}
             </td>
             <td>
               <span class="color-preview" style="background-color: {{ $status->color }};"></span> 
             </td>
             <td>
               <span class="badge badge-info">{{ $status->entries->count() }}

                 @if($status->entries->count() > 0)
                 <a class="" href="{{ route('statuses.entries', [$status]) }}" title="Zobacz"><i class="far fa-eye text-white ml-2"></i></a>
                 @endif
               </span>
             </td>
             <td>
              <div class="btn-group" role="group" aria-label="Basic example">
               <a class="btn btn-sm btn-info" href="{{ route('statuses.edit', [$status]) }}" title="Edytuj"><i class="fas fa-edit fa-lg"></i></a>
               @if($status->entries->count() == 0)
               <form action="{{ route('statuses.destroy', [$status]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('Czy napewno usunąć status?')" class="btn btn-sm btn-danger" type="submit"><i class="far fa-trash-alt fa-lg"></i></button>
              </form>
              @endif
            </div>
          </td>
        </tr> 
        @endforeach 
      </tbody>
    </table>
  </div>
  @else
  <p>Brak statusów.</p>
  @endif
</div>

<div class="row mb-3">
  <div class="col-lg-12">
    <h3 class="h4-responsive">
      Dodaj status:
    </h3>
    <form action="{{ route('statuses.store') }}" method="POST">
      @csrf

      <div class="mt-3">
        <label for="name">Status</label>
        <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}">

        @if ($errors->has('name'))
        <div class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('name') }}</strong>
        </div>
        @endif
      </div>

      <div class="mt-3">
        <label for="name">Kolor</label>
        <input type="color" id="color" name="color" class="form-control" value="#ff0000">

        @if ($errors->has('color'))
        <div class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('color') }}</strong>
        </div>
        @endif
      </div>

      <button class="btn btn-info my-4" type="submit">Zapisz</button>
    </form>
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
      "order": [[ 0, "asc" ]]

    });
    $('.dataTables_length').addClass('bs-select');
  });
</script>
@endsection