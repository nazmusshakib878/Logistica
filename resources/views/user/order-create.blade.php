@extends('layouts.master')

@section('title', 'Book '.$service->name.' | Logistica')

@section('content')
<section class="dashboard-shell">
    <div class="container py-4">
        <div class="row g-4 align-items-start">
            <div class="col-lg-5">
                <div class="dashboard-card overflow-hidden">
                    <img class="img-fluid w-100" src="{{ $service->image_url }}" alt="{{ $service->name }}">
                    <div class="p-4">
                        <span class="dashboard-service-icon mb-3"><i class="{{ $service->icon }}"></i></span>
                        <h1 class="h3 mb-3">{{ $service->name }}</h1>
                        <p class="text-muted mb-4">{{ $service->description }}</p>

                        <div class="d-flex flex-column flex-sm-row gap-3 align-items-sm-center justify-content-between p-3 bg-light">
                            <span class="fw-bold text-muted">Starting Price</span>
                            <strong class="fs-5">{{ $service->base_price ? '$'.$service->base_price : 'Custom price' }}</strong>
                        </div>

                        <a href="{{ route('service') }}" class="btn btn-outline-primary mt-4">
                            <i class="fa fa-arrow-left me-2"></i>Back to Services
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="dashboard-card p-4">
                    <div class="dashboard-section-title">
                        <div>
                            <h6 class="text-secondary text-uppercase mb-2">Booking Service</h6>
                            <h2 class="mb-1">Book {{ $service->name }}</h2>
                            <small class="text-muted">Share pickup, delivery, and cargo details. Admin will review it as pending.</small>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('user.orders.store') }}">
                        @csrf
                        <input type="hidden" name="logistics_service_id" value="{{ $service->id }}">

                        <div class="row g-3">
                            <div class="col-lg-6">
                                <label class="form-label fw-bold" for="preferred_date">Preferred Date</label>
                                <input id="preferred_date" name="preferred_date" value="{{ old('preferred_date') }}" type="date" class="form-control auth-input">
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label fw-bold" for="package_weight">Weight KG</label>
                                <input id="package_weight" name="package_weight" value="{{ old('package_weight') }}" type="number" min="0.01" step="0.01" class="form-control auth-input" placeholder="45">
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label fw-bold" for="pickup_address">Pickup Address</label>
                                <input id="pickup_address" name="pickup_address" value="{{ old('pickup_address') }}" class="form-control auth-input" placeholder="Warehouse, city, country" required>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label fw-bold" for="delivery_address">Delivery Address</label>
                                <input id="delivery_address" name="delivery_address" value="{{ old('delivery_address') }}" class="form-control auth-input" placeholder="Destination address" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold" for="customer_note">Note</label>
                                <textarea id="customer_note" name="customer_note" rows="4" class="form-control" placeholder="Cargo details, timing, handling needs">{{ old('customer_note') }}</textarea>
                            </div>
                            <div class="col-12 d-flex flex-column flex-sm-row justify-content-sm-end gap-3">
                                <a href="{{ route('user.dashboard') }}" class="btn btn-outline-secondary px-4">
                                    My Dashboard
                                </a>
                                <button type="submit" class="btn auth-gradient-btn px-5">
                                    Submit Booking
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
