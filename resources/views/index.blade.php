@extends('layouts.master')

@section('title', 'Home | Logistica')

@section('content')
<!-- Carousel Start -->
    <div class="container-fluid p-0 pb-5">
        <div class="owl-carousel header-carousel position-relative mb-5">
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="{{ asset('img/carousel-1.jpg') }}" alt="">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(6, 3, 21, .5);">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-10 col-lg-8">
                                <h5 class="text-white text-uppercase mb-3 animated slideInDown">Transport & Logistics Solution</h5>
                                <h1 class="display-3 text-white animated slideInDown mb-4">#1 Place For Your <span class="text-primary">Logistics</span> Solution</h1>
                                <p class="fs-5 fw-medium text-white mb-4 pb-2">Vero elitr justo clita lorem. Ipsum dolor at sed stet sit diam no. Kasd rebum ipsum et diam justo clita et kasd rebum sea elitr.</p>
                                <a href="{{ route('about') }}" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Read More</a>
                                <a href="{{ route('bookings') }}" class="btn btn-secondary py-md-3 px-md-5 animated slideInRight">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="{{ asset('img/carousel-2.jpg') }}" alt="">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(6, 3, 21, .5);">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-10 col-lg-8">
                                <h5 class="text-white text-uppercase mb-3 animated slideInDown">Transport & Logistics Solution</h5>
                                <h1 class="display-3 text-white animated slideInDown mb-4">#1 Place For Your <span class="text-primary">Transport</span> Solution</h1>
                                <p class="fs-5 fw-medium text-white mb-4 pb-2">Vero elitr justo clita lorem. Ipsum dolor at sed stet sit diam no. Kasd rebum ipsum et diam justo clita et kasd rebum sea elitr.</p>
                                <a href="{{ route('about') }}" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Read More</a>
                                <a href="{{ route('bookings') }}" class="btn btn-secondary py-md-3 px-md-5 animated slideInRight">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- About Start -->
    <div class="container-fluid overflow-hidden py-5 px-lg-0">
        <div class="container about py-5 px-lg-0">
            <div class="row g-5 mx-lg-0">
                <div class="col-lg-6 ps-lg-0 wow fadeInLeft" data-wow-delay="0.1s" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute img-fluid w-100 h-100" src="{{ asset('img/about.jpg') }}" style="object-fit: cover;" alt="">
                    </div>
                </div>
                <div class="col-lg-6 about-text wow fadeInUp" data-wow-delay="0.3s">
                    <h6 class="text-secondary text-uppercase mb-3">About Us</h6>
                    <h1 class="mb-5">Quick Transport and Logistics Solutions</h1>
                    <p class="mb-5">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo magna dolore erat amet</p>
                    <div class="row g-4 mb-5">
                        <div class="col-sm-6 wow fadeIn" data-wow-delay="0.5s">
                            <i class="fa fa-globe fa-3x text-primary mb-3"></i>
                            <h5>Global Coverage</h5>
                            <p class="m-0">Stet stet justo dolor sed duo. Ut clita sea sit ipsum diam lorem diam justo.</p>
                        </div>
                        <div class="col-sm-6 wow fadeIn" data-wow-delay="0.7s">
                            <i class="fa fa-shipping-fast fa-3x text-primary mb-3"></i>
                            <h5>On Time Delivery</h5>
                            <p class="m-0">Stet stet justo dolor sed duo. Ut clita sea sit ipsum diam lorem diam justo.</p>
                        </div>
                    </div>
                    <a href="{{ route('service') }}" class="btn btn-primary py-3 px-5">Explore More</a>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


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


    <!-- Feature Start -->
    <div class="container-fluid overflow-hidden py-5 px-lg-0">
        <div class="container feature py-5 px-lg-0">
            <div class="row g-5 mx-lg-0">
                <div class="col-lg-6 feature-text wow fadeInUp" data-wow-delay="0.1s">
                    <h6 class="text-secondary text-uppercase mb-3">Our Features</h6>
                    <h1 class="mb-5">We Are Trusted Logistics Company Since 1990</h1>
                    <div class="d-flex mb-5 wow fadeInUp" data-wow-delay="0.3s">
                        <i class="fa fa-globe text-primary fa-3x flex-shrink-0"></i>
                        <div class="ms-4">
                            <h5>Worldwide Service</h5>
                            <p class="mb-0">Diam dolor ipsum sit amet eos erat ipsum lorem sed stet lorem sit clita duo justo magna erat amet</p>
                        </div>
                    </div>
                    <div class="d-flex mb-5 wow fadeIn" data-wow-delay="0.5s">
                        <i class="fa fa-shipping-fast text-primary fa-3x flex-shrink-0"></i>
                        <div class="ms-4">
                            <h5>On Time Delivery</h5>
                            <p class="mb-0">Diam dolor ipsum sit amet eos erat ipsum lorem sed stet lorem sit clita duo justo magna erat amet</p>
                        </div>
                    </div>
                    <div class="d-flex mb-0 wow fadeInUp" data-wow-delay="0.7s">
                        <i class="fa fa-headphones text-primary fa-3x flex-shrink-0"></i>
                        <div class="ms-4">
                            <h5>24/7 Telephone Support</h5>
                            <p class="mb-0">Diam dolor ipsum sit amet eos erat ipsum lorem sed stet lorem sit clita duo justo magna erat amet</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 pe-lg-0 wow fadeInRight" data-wow-delay="0.1s" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute img-fluid w-100 h-100" src="{{ asset('img/feature.jpg') }}" style="object-fit: cover;" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Feature End -->


    <!-- Booking Start -->
    <div class="container-xxl py-5">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-lg-5 wow fadeInUp" data-wow-delay="0.1s">
                    <h6 class="text-secondary text-uppercase mb-3">Bookings</h6>
                    <h1 class="mb-5">Book a Logistics Service</h1>
                    <p class="mb-5">Create a booking with pickup, delivery, date, and cargo details. Customers must be logged in so every booking can be tracked from the user dashboard and reviewed by admin.</p>
                    <div class="d-flex align-items-center">
                        <i class="fa fa-headphones fa-2x flex-shrink-0 bg-primary p-3 text-white"></i>
                        <div class="ps-4">
                            <h6>Need booking support?</h6>
                            <h3 class="text-primary m-0">+012 345 6789</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="bg-light p-5 wow fadeIn" data-wow-delay="0.5s">
                        @auth
                            @if (auth()->user()->is_admin)
                                <div class="text-center py-4">
                                    <span class="dashboard-service-icon mx-auto mb-3"><i class="fa fa-user-shield"></i></span>
                                    <h4>Review Bookings From Admin</h4>
                                    <p class="text-muted">Admins manage booking status, notes, and services from the admin dashboard.</p>
                                    <a href="{{ route('admin.dashboard') }}#bookings" class="btn auth-gradient-btn px-5">Open Admin Bookings</a>
                                </div>
                            @else
                                <form method="POST" action="{{ route('user.orders.store') }}">
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <select name="logistics_service_id" class="form-select border-0" style="height: 55px;" required>
                                                <option value="">Select a service</option>
                                                @foreach ($publicServices as $service)
                                                    <option value="{{ $service->id }}" @selected(old('logistics_service_id') == $service->id)>
                                                        {{ $service->name }}
                                                        @if ($service->base_price)
                                                            - ${{ $service->base_price }}
                                                        @endif
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <input name="pickup_address" value="{{ old('pickup_address') }}" class="form-control border-0" placeholder="Pickup Address" style="height: 55px;" required>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <input name="delivery_address" value="{{ old('delivery_address') }}" class="form-control border-0" placeholder="Delivery Address" style="height: 55px;" required>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <input name="preferred_date" value="{{ old('preferred_date') }}" type="date" class="form-control border-0" style="height: 55px;">
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <input name="package_weight" value="{{ old('package_weight') }}" type="number" min="0.01" step="0.01" class="form-control border-0" placeholder="Weight KG" style="height: 55px;">
                                        </div>
                                        <div class="col-12">
                                            <textarea name="customer_note" class="form-control border-0" placeholder="Cargo details or special handling notes">{{ old('customer_note') }}</textarea>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100 py-3" type="submit">Submit Booking</button>
                                        </div>
                                    </div>
                                </form>
                            @endif
                        @else
                            <div class="text-center py-4">
                                <span class="dashboard-service-icon mx-auto mb-3"><i class="fa fa-lock"></i></span>
                                <h4>Login Required for Booking</h4>
                                <p class="text-muted">Sign in first so your booking, status updates, and admin notes stay connected to your account.</p>
                                <div class="d-flex flex-column flex-sm-row justify-content-center gap-3">
                                    <a href="{{ route('bookings') }}" class="btn auth-gradient-btn px-5">Login to Book</a>
                                    <a href="{{ route('register') }}" class="btn btn-outline-primary px-5">Create Account</a>
                                </div>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Booking End -->
@endsection


