@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="container">
      
      @include('shared.info')

        <div class="col-lg-4">
            <!-- Card -->
            <div class="card">

              <!-- Card image -->
              <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Others/images/43.jpg" alt="Card image cap">

              <!-- Card content -->
              <div class="card-body">

                <!-- Title -->
                <h4 class="card-title"><a>Front test card</a></h4>
                <!-- Text -->
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <!-- Button -->
                <a href="#" class="btn btn-primary">Button</a>

            </div>

        </div>
        <!-- Card -->
    </div>
</div>
</div>
@endsection
