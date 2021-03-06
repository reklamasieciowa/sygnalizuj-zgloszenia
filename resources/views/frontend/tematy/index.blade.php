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
          Tematy: 
        </h2>
      </div>
    </div>

    <div class="row">
      @if(isset($subjects))
      <div class="col-lg-12 table-responsive">

        <table id="subjects" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
          <thead>
            <th class="th-sm">
              Temat
            </th>
            <th>
              Ilość zgłoszeń
            </th>
            <th>
              Akcje
            </th>
          </thead>
          <tbody>

           @foreach($subjects as $subject)
           <tr>
             <td>
               {{ $subject->name }}
             </td>
             <td>
               <span class="badge badge-info">{{ $subject->entries->count() }}

               @if($subject->entries->count() > 0)
               <a class="" href="{{ route('subjects.entries', [$subject]) }}" title="Zobacz"><i class="far fa-eye text-white ml-2"></i></a>
               @endif
               </span>
             </td>
             <td>
              <div class="btn-group" role="group" aria-label="Basic example">
               <a class="btn btn-sm btn-info" href="{{ route('subjects.edit', [$subject]) }}" title="Edytuj"><i class="fas fa-edit fa-lg"></i></a>
               @if($subject->entries->count() == 0)
               <form action="{{ route('subjects.destroy', [$subject]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('Czy napewno usunąć temat?')" class="btn btn-sm btn-danger" type="submit"><i class="far fa-trash-alt fa-lg"></i></button>
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
    <p>Brak tematów.</p>
    @endif
  </div>

  <div class="row mb-3">
    <div class="col-lg-12">
      <h3 class="h4-responsive">
        Dodaj temat:
      </h3>
      <form action="{{ route('subjects.store') }}" method="POST">
        @csrf

        <div class="mt-3">
          <label for="name">Temat</label>
          <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}">

          @if ($errors->has('name'))
          <div class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('name') }}</strong>
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