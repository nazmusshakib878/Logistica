@extends('layouts.master')

@section('title', 'My Dashboard | Logistica')

@section('content')
@php
    $totalOrders = max($orders->count(), 1);
    $pendingPercent = round(($orders->where('status', 'pending')->count() / $totalOrders) * 100);
    $acceptedPercent = round(($orders->where('status', 'accepted')->count() / $totalOrders) * 100);
    $rejectedPercent = round(($orders->where('status', 'rejected')->count() / $totalOrders) * 100);
@endphp

<section class="dashboard-shell">
    <div class="container-fluid px-4 px-lg-5">
        <div class="dashboard-layout">
            <aside class="dashboard-sidebar">
                <div class="dashboard-sidebar-head">
                    <p class="dashboard-sidebar-title">User Panel</p>
                    <p class="dashboard-sidebar-subtitle">{{ auth()->user()->name }} | Customer Workspace</p>
                </div>
                <nav class="dashboard-menu">
                    <a class="dashboard-menu-link active" href="#dashboard"><i class="fa fa-chart-pie"></i> Dashboard</a>
                    <a class="dashboard-menu-link" href="#order-service"><i class="fa fa-plus-circle"></i> Book Service</a>
                    <a class="dashboard-menu-link" href="#service-list"><i class="fa fa-list"></i> Service List</a>
                    <a class="dashboard-menu-link" href="#analytics"><i class="fa fa-chart-line"></i> Analytics</a>
                    <a class="dashboard-menu-link" href="#records"><i class="fa fa-clipboard-list"></i> Records</a>
                </nav>
            </aside>

            <main class="dashboard-main">
                <section id="dashboard" class="dashboard-panel">
                    <div class="d-flex flex-column flex-lg-row align-items-lg-end justify-content-between gap-3 mb-4">
                        <div>
                            <h6 class="text-secondary text-uppercase mb-3">User Dashboard</h6>
                            <h1 class="mb-2">Welcome, {{ auth()->user()->name }}</h1>
                            <p class="mb-0">Book services and track admin decisions from one clean workspace.</p>
                        </div>
                        <a href="#order-service" class="btn auth-gradient-btn px-4 d-inline-flex align-items-center justify-content-center">
                            <i class="fa fa-truck me-2"></i> Book Now
                        </a>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-3">
                            <div class="dashboard-metric">
                                <span class="text-muted fw-bold">Total Bookings</span>
                                <h2 class="mb-0 mt-2">{{ $orders->count() }}</h2>
                                <small class="text-muted">Stored records</small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="dashboard-metric">
                                <span class="text-muted fw-bold">Pending</span>
                                <h2 class="mb-0 mt-2">{{ $orders->where('status', 'pending')->count() }}</h2>
                                <small class="text-muted">Awaiting admin</small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="dashboard-metric">
                                <span class="text-muted fw-bold">Accepted</span>
                                <h2 class="mb-0 mt-2">{{ $orders->where('status', 'accepted')->count() }}</h2>
                                <small class="text-muted">Ready to process</small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="dashboard-metric">
                                <span class="text-muted fw-bold">Rejected</span>
                                <h2 class="mb-0 mt-2">{{ $orders->where('status', 'rejected')->count() }}</h2>
                                <small class="text-muted">Needs revision</small>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="order-service" class="dashboard-panel dashboard-card p-4">
                    <div class="dashboard-section-title">
                        <div>
                            <h4 class="mb-1">Book Service</h4>
                            <small class="text-muted">New bookings go to admin records as pending.</small>
                        </div>
                    </div>

                    @if ($services->isNotEmpty())
                        <form method="POST" action="{{ route('user.orders.store') }}">
                            @csrf
                            <div class="row g-3">
                                <div class="col-lg-6">
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
                                    <label class="form-label fw-bold" for="pickup_address">Pickup Address</label>
                                    <input id="pickup_address" name="pickup_address" value="{{ old('pickup_address') }}" class="form-control auth-input" placeholder="Warehouse, city, country" required>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-label fw-bold" for="delivery_address">Delivery Address</label>
                                    <input id="delivery_address" name="delivery_address" value="{{ old('delivery_address') }}" class="form-control auth-input" placeholder="Destination address" required>
                                </div>
                                <div class="col-lg-4">
                                    <label class="form-label fw-bold" for="package_weight">Weight KG</label>
                                    <input id="package_weight" name="package_weight" value="{{ old('package_weight') }}" type="number" min="0.01" step="0.01" class="form-control auth-input" placeholder="45">
                                </div>
                                <div class="col-lg-8">
                                    <label class="form-label fw-bold" for="customer_note">Note</label>
                                    <input id="customer_note" name="customer_note" value="{{ old('customer_note') }}" class="form-control auth-input" placeholder="Cargo details, timing, handling needs">
                                </div>
                                <div class="col-12 text-end">
                                    <button type="submit" class="btn auth-gradient-btn px-5">Submit Booking</button>
                                </div>
                            </div>
                        </form>
                    @else
                        <div class="text-center py-5">
                            <div class="dashboard-service-icon mx-auto mb-3"><i class="fa fa-clock"></i></div>
                            <h5>No active services yet</h5>
                            <p class="mb-0 text-muted">Please check back after admin adds services.</p>
                        </div>
                    @endif
                </section>

                <section id="service-list" class="dashboard-panel dashboard-card p-4">
                    <div class="dashboard-section-title">
                        <div>
                            <h4 class="mb-1">Service List</h4>
                            <small class="text-muted">Only active admin-managed services are available for booking.</small>
                        </div>
                    </div>

                    <div class="row g-4">
                        @forelse ($services as $service)
                            <div class="col-md-6 col-xl-4">
                                <div class="border rounded-0 p-4 h-100">
                                    <div class="overflow-hidden mb-3">
                                        <img class="img-fluid" src="{{ $service->image_url }}" alt="{{ $service->name }}">
                                    </div>
                                    <span class="dashboard-service-icon mb-3"><i class="{{ $service->icon }}"></i></span>
                                    <h5>{{ $service->name }}</h5>
                                    <p class="text-muted">{{ $service->description }}</p>
                                    <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3">
                                        <strong>{{ $service->base_price ? '$'.$service->base_price : 'Custom price' }}</strong>
                                        <a href="{{ route('user.orders.create', $service) }}" class="btn btn-sm auth-gradient-btn px-3">
                                            Book
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center py-5">
                                <h5>No services available</h5>
                                <p class="mb-0 text-muted">Admin active services will appear here.</p>
                            </div>
                        @endforelse
                    </div>
                </section>

                <section id="analytics" class="dashboard-panel dashboard-card p-4">
                    <div class="dashboard-section-title">
                        <div>
                            <h4 class="mb-1">Analytics</h4>
                            <small class="text-muted">Your booking health based on stored records.</small>
                        </div>
                    </div>

                    <div class="row g-4">
                        <div class="col-lg-4">
                            <h6>Pending</h6>
                            <div class="analytics-bar mb-2"><div class="analytics-bar-fill" style="width: {{ $pendingPercent }}%;"></div></div>
                            <small class="text-muted">{{ $pendingPercent }}% of your bookings are waiting.</small>
                        </div>
                        <div class="col-lg-4">
                            <h6>Accepted</h6>
                            <div class="analytics-bar mb-2"><div class="analytics-bar-fill" style="width: {{ $acceptedPercent }}%;"></div></div>
                            <small class="text-muted">{{ $acceptedPercent }}% accepted by admin.</small>
                        </div>
                        <div class="col-lg-4">
                            <h6>Rejected</h6>
                            <div class="analytics-bar mb-2"><div class="analytics-bar-fill" style="width: {{ $rejectedPercent }}%;"></div></div>
                            <small class="text-muted">{{ $rejectedPercent }}% rejected or needs changes.</small>
                        </div>
                    </div>
                </section>

                <section id="records" class="dashboard-panel dashboard-card p-4">
                    <div class="dashboard-section-title">
                        <div>
                            <h4 class="mb-1">Records</h4>
                            <small class="text-muted">Admin status and notes appear here after every booking decision.</small>
                        </div>
                    </div>

                    @forelse ($orders as $order)
                        <div class="border rounded-0 p-3 mb-3">
                            <div class="d-flex flex-column flex-md-row justify-content-between gap-3">
                                <div>
                                    <div class="d-flex align-items-center gap-3 mb-2">
                                        <span class="dashboard-service-icon"><i class="{{ $order->logisticsService->icon }}"></i></span>
                                        <div>
                                            <h5 class="mb-1">{{ $order->logisticsService->name }}</h5>
                                            <small class="text-muted">Booking #{{ $order->id }} | {{ $order->created_at->format('M d, Y') }}</small>
                                        </div>
                                    </div>
                                    <small class="d-block"><strong>From:</strong> {{ $order->pickup_address }}</small>
                                    <small class="d-block"><strong>To:</strong> {{ $order->delivery_address }}</small>
                                    @if ($order->preferred_date || $order->package_weight)
                                        <small class="d-block text-muted">
                                            {{ $order->preferred_date?->format('M d, Y') ?? 'Flexible date' }}
                                            @if ($order->package_weight)
                                                | {{ $order->package_weight }} kg
                                            @endif
                                        </small>
                                    @endif
                                </div>
                                <div class="text-md-end">
                                    <span class="status-badge status-{{ $order->status }}">{{ $order->status }}</span>
                                    @if ($order->reviewed_at)
                                        <small class="d-block text-muted mt-2">Updated {{ $order->reviewed_at->diffForHumans() }}</small>
                                    @endif
                                </div>
                            </div>

                            @if ($order->customer_note)
                                <div class="mt-3 p-3 bg-light">
                                    <strong>Your note:</strong> {{ $order->customer_note }}
                                </div>
                            @endif

                            @if ($order->admin_note)
                                <div class="mt-3 p-3" style="background: #eef7ff;">
                                    <strong>Admin note:</strong> {{ $order->admin_note }}
                                </div>
                            @endif
                        </div>
                    @empty
                        <div class="text-center py-5">
                            <div class="dashboard-service-icon mx-auto mb-3"><i class="fa fa-clipboard-list"></i></div>
                            <h5>No records yet</h5>
                            <p class="mb-0 text-muted">Submit your first booking from the book service panel.</p>
                        </div>
                    @endforelse
                </section>
            </main>
        </div>
    </div>
</section>
@endsection
