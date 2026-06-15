<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Models\LogisticsService;
use App\Models\ServiceOrder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserDashboardController extends Controller
{
    public function dashboard(Request $request): View|RedirectResponse
    {
        if ($request->user()->is_admin) {
            return redirect()->route('admin.dashboard');
        }

        return view('user.dashboard', [
            'services' => LogisticsService::where('is_active', true)
                ->orderBy('sort_order')
                ->orderBy('name')
                ->get(),
            'orders' => $request->user()
                ->serviceOrders()
                ->with('logisticsService')
                ->latest()
                ->get(),
        ]);
    }

    public function createOrder(Request $request, LogisticsService $logisticsService): View|RedirectResponse
    {
        if ($request->user()->is_admin) {
            return redirect()->route('admin.dashboard');
        }

        if (! $logisticsService->is_active) {
            return redirect()
                ->route('service')
                ->with('warning', 'That service is not available for new bookings right now.');
        }

        return view('user.order-create', [
            'service' => $logisticsService,
        ]);
    }

    public function bookings(Request $request): View|RedirectResponse
    {
        if ($request->user()->is_admin) {
            return redirect()->route('admin.dashboard');
        }

        return view('bookings', [
            'services' => LogisticsService::where('is_active', true)
                ->orderBy('sort_order')
                ->orderBy('name')
                ->get(),
            'recentBookings' => $request->user()
                ->serviceOrders()
                ->with('logisticsService')
                ->latest()
                ->limit(5)
                ->get(),
        ]);
    }

    public function storeOrder(StoreBookingRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $service = LogisticsService::findOrFail($validated['logistics_service_id']);

        ServiceOrder::create([
            'user_id' => $request->user()->id,
            'logistics_service_id' => $service->id,
            'status' => ServiceOrder::STATUS_PENDING,
            'pickup_address' => $validated['pickup_address'],
            'delivery_address' => $validated['delivery_address'],
            'preferred_date' => $validated['preferred_date'] ?? null,
            'package_weight' => $validated['package_weight'] ?? null,
            'customer_note' => $validated['customer_note'] ?? null,
        ]);

        return redirect()
            ->route('user.dashboard')
            ->with('success', 'Booking submitted. Admin review is now pending.');
    }
}
