@extends('layouts.master')

@section('title', 'Services | Logistica')

@section('content')
<!-- Page Header Start -->
    <div class="container-fluid page-header py-5" style="margin-bottom: 6rem;">
        <div class="container py-5">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Services</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="text-white" href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="{{ route('feature') }}">Pages</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">Services</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container py-5">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="text-secondary text-uppercase">Our Services</h6>
                <h1 class="mb-5">Explore Our Services</h1>
            </div>
            <div class="row g-4">
                @forelse ($publicServices as $service)
                    <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="{{ 0.1 + (($loop->index % 3) * 0.2) }}s">
                        <div class="service-item p-4">
                            <div class="overflow-hidden mb-4">
                                <img class="img-fluid" src="{{ $service->image_url }}" alt="{{ $service->name }}">
                            </div>
                            <h4 class="mb-3">{{ $service->name }}</h4>
                            <p>{{ $service->description }}</p>
                            <a class="btn-slide mt-2" href="{{ route('user.orders.create', $service) }}"><i class="fa fa-arrow-right"></i><span>Book Now</span></a>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <h4>No active services available</h4>
                        <p class="mb-0">Please check back after admin publishes services.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    <!-- Service End -->
@endsection


