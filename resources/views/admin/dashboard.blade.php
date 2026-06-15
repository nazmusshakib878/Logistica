@extends('layouts.master')

@section('title', 'Admin Dashboard | Logistica')

@section('content')
@php
    $totalOrders = max($orders->count(), 1);
    $activePercent = $stats['services'] > 0 ? round(($stats['active_services'] / $stats['services']) * 100) : 0;
    $pendingPercent = round(($stats['pending'] / $totalOrders) * 100);
    $acceptedPercent = round(($stats['accepted'] / $totalOrders) * 100);
    $rejectedPercent = round(($stats['rejected'] / $totalOrders) * 100);
@endphp

<section class="dashboard-shell">
    <div class="container-fluid px-4 px-lg-5">
        <div class="dashboard-layout">
            <aside class="dashboard-sidebar">
                <div class="dashboard-sidebar-head">
                    <p class="dashboard-sidebar-title">Admin Panel</p>
                    <p class="dashboard-sidebar-subtitle">{{ auth()->user()->name }} | Operations</p>
                </div>
                <nav class="dashboard-menu">
                    <a class="dashboard-menu-link active" href="#dashboard"><i class="fa fa-chart-pie"></i> Dashboard</a>
                    <a class="dashboard-menu-link" href="#add-service"><i class="fa fa-plus-circle"></i> Add Service</a>
                    <a class="dashboard-menu-link" href="#service-list"><i class="fa fa-list"></i> Service List</a>
                    <a class="dashboard-menu-link" href="#users"><i class="fa fa-users"></i> Users</a>
                    <a class="dashboard-menu-link" href="#analytics"><i class="fa fa-chart-line"></i> Analytics</a>
                    <a class="dashboard-menu-link" href="#activity"><i class="fa fa-bolt"></i> Activity</a>
                    <a class="dashboard-menu-link" href="#bookings"><i class="fa fa-clipboard-list"></i> Bookings</a>
                </nav>
            </aside>

            <main class="dashboard-main">
                <datalist id="service-image-options">
                    @foreach ($serviceImages as $image)
                        <option value="{{ $image }}">{{ $image }}</option>
                    @endforeach
                </datalist>

                <section id="dashboard" class="dashboard-panel">
                    <div class="d-flex flex-column flex-lg-row align-items-lg-end justify-content-between gap-3 mb-4">
                        <div>
                            <h6 class="text-secondary text-uppercase mb-3">Admin Dashboard</h6>
                            <h1 class="mb-2">Operations Control Center</h1>
                            <p class="mb-0">One login detects admin from <strong>users.is_admin</strong>. Service and booking actions stay in database.</p>
                        </div>
                        <span class="btn auth-gradient-btn px-4 d-inline-flex align-items-center justify-content-center">
                            <i class="fa fa-user-shield me-2"></i> Admin Active
                        </span>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-6 col-xl-3">
                            <div class="dashboard-metric">
                                <span class="text-muted fw-bold">Users</span>
                                <h2 class="mb-0 mt-2">{{ $stats['users'] }}</h2>
                                <small class="text-muted">Normal customer accounts</small>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3">
                            <div class="dashboard-metric">
                                <span class="text-muted fw-bold">Services</span>
                                <h2 class="mb-0 mt-2">{{ $stats['services'] }}</h2>
                                <small class="text-muted">{{ $stats['active_services'] }} active</small>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3">
                            <div class="dashboard-metric">
                                <span class="text-muted fw-bold">Bookings</span>
                                <h2 class="mb-0 mt-2">{{ $stats['orders'] }}</h2>
                                <small class="text-muted">{{ $stats['pending'] }} waiting</small>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3">
                            <div class="dashboard-metric">
                                <span class="text-muted fw-bold">Accepted / Rejected</span>
                                <h2 class="mb-0 mt-2">{{ $stats['accepted'] }} / {{ $stats['rejected'] }}</h2>
                                <small class="text-muted">User dashboards reflect this</small>
                            </div>
                        </div>
                    </div>

                    <div class="row g-4 mt-1">
                        <div class="col-xl-8">
                            <div class="dashboard-card p-4 h-100">
                                <div class="dashboard-section-title">
                                    <div>
                                        <h4 class="mb-1">Recent Activity</h4>
                                        <small class="text-muted">Latest service requests from real booking records.</small>
                                    </div>
                                    <a class="btn btn-outline-primary rounded-0 btn-sm" href="#bookings">View Bookings</a>
                                </div>

                                @forelse ($orders->take(3) as $order)
                                    <div class="border-bottom py-3">
                                        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-2">
                                            <div>
                                                <strong>{{ $order->user->name }}</strong>
                                                <span class="text-muted">requested</span>
                                                <strong>{{ $order->logisticsService->name }}</strong>
                                                <small class="d-block text-muted">{{ $order->created_at->diffForHumans() }} | {{ $order->user->email }}</small>
                                            </div>
                                            <span class="status-badge status-{{ $order->status }}">{{ $order->status }}</span>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center py-4">
                                        <div class="dashboard-service-icon mx-auto mb-3"><i class="fa fa-bolt"></i></div>
                                        <h5>No activity yet</h5>
                                        <p class="mb-0 text-muted">New bookings will appear here.</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <div class="col-xl-4">
                            <div class="dashboard-card p-4 h-100">
                                <div class="dashboard-section-title">
                                    <div>
                                        <h4 class="mb-1">Latest Users</h4>
                                        <small class="text-muted">Newest registered accounts.</small>
                                    </div>
                                </div>

                                @forelse ($users->take(4) as $user)
                                    <div class="d-flex align-items-center justify-content-between gap-3 border-bottom py-3">
                                        <div>
                                            <strong>{{ $user->name }}</strong>
                                            <small class="d-block text-muted">{{ $user->phone ?? 'No phone saved' }}</small>
                                        </div>
                                        <small class="text-muted">{{ $user->created_at->format('M d') }}</small>
                                    </div>
                                @empty
                                    <p class="mb-0 text-muted">No users found.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </section>

                <section id="add-service" class="dashboard-panel dashboard-card p-4">
                    <div class="dashboard-section-title">
                        <div>
                            <h4 class="mb-1">Add Service</h4>
                            <small class="text-muted">Active services become orderable from the user panel.</small>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('admin.services.store') }}">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold" for="name">Service Name</label>
                                <input id="name" name="name" class="form-control auth-input" placeholder="Air Freight" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold" for="icon">Icon Class</label>
                                <input id="icon" name="icon" class="form-control auth-input" placeholder="fa fa-plane">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold" for="base_price">Base Price</label>
                                <input id="base_price" name="base_price" type="number" min="0" step="0.01" class="form-control auth-input" placeholder="250.00">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold" for="image_path">Image Path or URL</label>
                                <input id="image_path" name="image_path" class="form-control auth-input" list="service-image-options" placeholder="img/service-1.jpg or https://example.com/service.jpg">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold" for="link_url">Service Link URL</label>
                                <input id="link_url" name="link_url" class="form-control auth-input" placeholder="/dashboard or https://example.com">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label fw-bold" for="sort_order">Order</label>
                                <input id="sort_order" name="sort_order" type="number" min="0" max="999" class="form-control auth-input" placeholder="10">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold" for="description">Description</label>
                                <textarea id="description" name="description" rows="4" class="form-control" placeholder="Short operational service description" required></textarea>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check form-switch">
                                    <input id="is_active" name="is_active" value="1" type="checkbox" class="form-check-input" checked>
                                    <label class="form-check-label" for="is_active">Active for users</label>
                                </div>
                            </div>
                            <div class="col-md-6 text-md-end">
                                <button type="submit" class="btn auth-gradient-btn px-5">Add Service</button>
                            </div>
                        </div>
                    </form>
                </section>

                <section id="service-list" class="dashboard-panel dashboard-card p-4">
                    <div class="dashboard-section-title">
                        <div>
                            <h4 class="mb-1">Service List</h4>
                            <small class="text-muted">Edit service availability, price, and display icon.</small>
                        </div>
                        <span class="status-badge status-accepted">{{ $stats['active_services'] }} active</span>
                    </div>

                    @forelse ($services as $service)
                        <div class="border rounded-0 p-3 mb-3">
                            <form method="POST" action="{{ route('admin.services.update', $service) }}">
                                @csrf
                                @method('PATCH')
                                <div class="row g-3 align-items-end">
                                    <div class="col-md-3">
                                        <label class="form-label fw-bold">Name</label>
                                        <input name="name" value="{{ $service->name }}" class="form-control" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label fw-bold">Icon</label>
                                        <input name="icon" value="{{ $service->icon }}" class="form-control">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label fw-bold">Base Price</label>
                                        <input name="base_price" type="number" min="0" step="0.01" value="{{ $service->base_price }}" class="form-control">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label fw-bold">Order</label>
                                        <input name="sort_order" type="number" min="0" max="999" value="{{ $service->sort_order }}" class="form-control">
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-check form-switch">
                                            <input id="service-{{ $service->id }}" name="is_active" value="1" type="checkbox" class="form-check-input" @checked($service->is_active)>
                                            <label class="form-check-label" for="service-{{ $service->id }}">Active</label>
                                        </div>
                                        <small class="text-muted">{{ $service->orders_count }} orders</small>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Image Path or URL</label>
                                        <input name="image_path" value="{{ $service->image_path }}" list="service-image-options" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Service Link URL</label>
                                        <input name="link_url" value="{{ $service->link_url }}" class="form-control">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-bold">Description</label>
                                        <textarea name="description" rows="2" class="form-control" required>{{ $service->description }}</textarea>
                                    </div>
                                    <div class="col-12 text-end">
                                        <button type="submit" class="btn btn-primary rounded-0 px-4">Save Service</button>
                                    </div>
                                </div>
                            </form>

                            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-2 mt-3 pt-3 border-top">
                                <small class="text-muted">
                                    @if ($service->orders_count > 0)
                                        Existing bookings stay in records after this service is removed.
                                    @else
                                        No orders are attached, so this service can be deleted.
                                    @endif
                                </small>
                                <form method="POST" action="{{ route('admin.services.destroy', $service) }}" data-confirm-delete data-service-name="{{ $service->name }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger rounded-0 px-4">Delete Service</button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-5">
                            <div class="dashboard-service-icon mx-auto mb-3"><i class="fa fa-box-open"></i></div>
                            <h5>No services yet</h5>
                            <p class="mb-0 text-muted">Add the first service from the add service panel.</p>
                        </div>
                    @endforelse
                </section>

                <section id="users" class="dashboard-panel dashboard-card p-4">
                    <div class="dashboard-section-title">
                        <div>
                            <h4 class="mb-1">Users</h4>
                            <small class="text-muted">Roles are shown from database. Admin role stays controlled by is_admin.</small>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table dashboard-table align-middle">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Role</th>
                                    <th>Bookings</th>
                                    <th>Joined</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <td><strong>{{ $user->name }}</strong></td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone ?? '-' }}</td>
                                        <td>
                                            <span class="status-badge {{ $user->is_admin ? 'status-accepted' : 'status-pending' }}">
                                                {{ $user->is_admin ? 'admin' : 'user' }}
                                            </span>
                                        </td>
                                        <td>{{ $user->service_orders_count }}</td>
                                        <td>{{ $user->created_at->format('M d, Y') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4">No users found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                <section id="analytics" class="dashboard-panel dashboard-card p-4">
                    <div class="dashboard-section-title">
                        <div>
                            <h4 class="mb-1">Analytics</h4>
                            <small class="text-muted">Operational health from current database records.</small>
                        </div>
                    </div>

                    <div class="row g-4">
                        <div class="col-lg-6">
                            <h6>Service Availability</h6>
                            <div class="analytics-bar mb-2"><div class="analytics-bar-fill" style="width: {{ $activePercent }}%;"></div></div>
                            <small class="text-muted">{{ $activePercent }}% services active, {{ $stats['inactive_services'] }} inactive.</small>
                        </div>
                        <div class="col-lg-6">
                            <h6>Order Acceptance</h6>
                            <div class="analytics-bar mb-2"><div class="analytics-bar-fill" style="width: {{ $acceptedPercent }}%;"></div></div>
                            <small class="text-muted">{{ $acceptedPercent }}% accepted out of {{ $orders->count() }} orders.</small>
                        </div>
                        <div class="col-lg-4">
                            <div class="dashboard-metric">
                                <span class="text-muted fw-bold">Pending Ratio</span>
                                <h2 class="mb-0 mt-2">{{ $pendingPercent }}%</h2>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="dashboard-metric">
                                <span class="text-muted fw-bold">Accepted Ratio</span>
                                <h2 class="mb-0 mt-2">{{ $acceptedPercent }}%</h2>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="dashboard-metric">
                                <span class="text-muted fw-bold">Rejected Ratio</span>
                                <h2 class="mb-0 mt-2">{{ $rejectedPercent }}%</h2>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="activity" class="dashboard-panel dashboard-card p-4">
                    <div class="dashboard-section-title">
                        <div>
                            <h4 class="mb-1">Activity</h4>
                            <small class="text-muted">A compact feed inspired by the reference dashboard, using Logistica data.</small>
                        </div>
                    </div>

                    <div class="row g-4">
                        <div class="col-lg-6">
                            <h6>Latest Bookings</h6>
                            @forelse ($orders->take(5) as $order)
                                <div class="d-flex align-items-center justify-content-between gap-3 border-bottom py-3">
                                    <div>
                                        <strong>{{ $order->logisticsService->name }}</strong>
                                        <small class="d-block text-muted">{{ $order->user->name }} | {{ $order->created_at->diffForHumans() }}</small>
                                    </div>
                                    <span class="status-badge status-{{ $order->status }}">{{ $order->status }}</span>
                                </div>
                            @empty
                                <p class="mb-0 text-muted">No order activity yet.</p>
                            @endforelse
                        </div>
                        <div class="col-lg-6">
                            <h6>Latest Users</h6>
                            @forelse ($users->take(5) as $user)
                                <div class="d-flex align-items-center justify-content-between gap-3 border-bottom py-3">
                                    <div>
                                        <strong>{{ $user->name }}</strong>
                                        <small class="d-block text-muted">{{ $user->email }} | {{ $user->phone ?? 'No phone saved' }}</small>
                                    </div>
                                    <span class="status-badge {{ $user->is_admin ? 'status-accepted' : 'status-pending' }}">
                                        {{ $user->is_admin ? 'admin' : 'user' }}
                                    </span>
                                </div>
                            @empty
                                <p class="mb-0 text-muted">No user activity yet.</p>
                            @endforelse
                        </div>
                    </div>
                </section>

                <section id="bookings" class="dashboard-panel dashboard-card p-4">
                    <div class="dashboard-section-title">
                        <div>
                            <h4 class="mb-1">Bookings</h4>
                            <small class="text-muted">Every booking is stored here. Updating status updates the user panel too.</small>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table dashboard-table align-middle">
                            <thead>
                                <tr>
                                    <th>Customer</th>
                                    <th>Service</th>
                                    <th>Route</th>
                                    <th>Status</th>
                                    <th>Decision</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $order)
                                    <tr>
                                        <td>
                                            <strong>{{ $order->user->name }}</strong><br>
                                            <small class="text-muted">{{ $order->user->email }}</small>
                                            <small class="d-block text-muted">{{ $order->user->phone ?? 'No phone saved' }}</small>
                                        </td>
                                        <td>
                                            <strong>{{ $order->logisticsService->name }}</strong><br>
                                            <small class="text-muted">
                                                {{ $order->preferred_date?->format('M d, Y') ?? 'Flexible date' }}
                                                @if ($order->package_weight)
                                                    | {{ $order->package_weight }} kg
                                                @endif
                                            </small>
                                        </td>
                                        <td>
                                            <small class="d-block"><strong>From:</strong> {{ $order->pickup_address }}</small>
                                            <small class="d-block"><strong>To:</strong> {{ $order->delivery_address }}</small>
                                        </td>
                                        <td>
                                            <span class="status-badge status-{{ $order->status }}">{{ $order->status }}</span>
                                        </td>
                                        <td style="min-width: 280px;">
                                            <form method="POST" action="{{ route('admin.orders.status', $order) }}">
                                                @csrf
                                                @method('PATCH')
                                                <select name="status" class="form-select mb-2">
                                                    @foreach (\App\Models\ServiceOrder::STATUSES as $status)
                                                        <option value="{{ $status }}" @selected($order->status === $status)>{{ ucfirst($status) }}</option>
                                                    @endforeach
                                                </select>
                                                <textarea name="admin_note" rows="2" class="form-control mb-2" placeholder="Admin note for user">{{ $order->admin_note }}</textarea>
                                                <button type="submit" class="btn btn-primary rounded-0 w-100">Update Booking</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5">
                                            <h5>No records yet</h5>
                                            <p class="mb-0 text-muted">User bookings will appear here.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>
            </main>
        </div>
    </div>
</section>
@endsection
