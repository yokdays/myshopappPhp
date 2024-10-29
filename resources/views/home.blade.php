@extends('layouts.app')
<style>
    .carousel-img {
    height: 700px;
    width: 100%;
    object-fit: cover;
}
</style>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="https://www.sirinfarm.com/wp-content/uploads/2021/07/shutterstock_1021135813-scaled-1.jpg" class="d-block w-100 carousel-img" alt="...">
                    {{-- <img src="{{ asset('storage/webimage/item1.jpg') }}" class="d-block w-100 carousel-img" alt="..."> --}}
                  </div>
                  <div class="carousel-item">
                    <img src="https://www.thailand.aussiebeefandlamb.com/contentassets/9f69e615043243818901991acb23d773/imagen49m7.png" class="d-block w-100 carousel-img" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="https://lisergia.org/wp-content/uploads/2022/04/HappyFresh-How-To-Check-Freshness-Of-Meat-Beef.jpg" class="d-block w-100 carousel-img"  alt="...">
                  </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
