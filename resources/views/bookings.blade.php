@extends('layouts.master')

@section('title', 'Bookings | Logistica')

@section('content')
<section class="dashboard-shell">
    <div class="container py-4">
        <div class="row g-4 align-items-start">
            <div class="col-lg-5">
                <div class="dashboard-card overflow-hidden">
                    <img class="img-fluid w-100" src="{{ asset('img/carousel-1.jpg') }}" alt="Logistics booking">
                    <div class="p-4">
                        <span class="dashboard-service-icon mb-3"><i class="fa fa-calendar-check"></i></span>
                        <h1 class="h3 mb-3">Create a Booking</h1>
                        <p class="text-muted mb-4">Choose an active logistics service and share the shipment details. Your booking will stay pending until admin reviews it.</p>

                        <div class="d-flex flex-column gap-3">
                            <a href="{{ route('user.dashboard') }}#records" class="btn btn-outline-primary">
                                <i class="fa fa-clipboard-list me-2"></i>My Booking Records
                            </a>
                            <a href="{{ route('service') }}" class="btn btn-outline-secondary">
                                <i class="fa fa-truck me-2"></i>Browse Services
                            </a>
                        </div>
                    </div>
                </div>

                @if ($recentBookings->isNotEmpty())
                    <div class="dashboard-card p-4 mt-4">
                        <h5 class="mb-3">Recent Bookings</h5>
                        @foreach ($recentBookings as $booking)
                            <div class="border-bottom py-3">
                                <div class="d-flex align-items-center justify-content-between gap-3">
                                    <div>
                                        <strong>{{ $booking->logisticsService->name }}</strong>
                                        <small class="d-block text-muted">#{{ $booking->id }} | {{ $booking->created_at->format('M d, Y') }}</small>
                                    </div>
                                    <span class="status-badge status-{{ $booking->status }}">{{ $booking->status }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="col-lg-7">
                <div class="dashboard-card p-4">
                    <div class="dashboard-section-title">
                        <div>
                            <h6 class="text-secondary text-uppercase mb-2">Bookings</h6>
                            <h2 class="mb-1">Shipment Details</h2>
                            <small class="text-muted">Only logged-in customers can submit bookings.</small>
                        </div>
                    </div>

                    @if ($services->isNotEmpty())
                        <form method="POST" action="{{ route('user.orders.store') }}">
                            @csrf

                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label fw-bold" for="logistics_service_id">Service</label>
                                    <select id="logistics_service_id" name="logistics_service_id" class="form-select auth-input" required>
                                        <option value="">Select a service</option>
                                        @foreach ($services as $service)
                                            <option value="{{ $service->id }}" @selected(old('logistics_service_id') == $service->id)>
                                                {{ $service->name }}
                                                @if ($service->base_price)
                                                    - ${{ $service->base_price }}
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
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
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn auth-gradient-btn px-5">
                                        Submit Booking
                                    </button>
                                </div>
                            </div>
                        </form>
                    @else
                        <div class="text-center py-5">
                            <div class="dashboard-service-icon mx-auto mb-3"><i class="fa fa-clock"></i></div>
                            <h5>No active services yet</h5>
                            <p class="mb-0 text-muted">Please check back after admin publishes services.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
