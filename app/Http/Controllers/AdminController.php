<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateBookingStatusRequest;
use App\Models\LogisticsService;
use App\Models\ServiceOrder;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function dashboard(): View
    {
        $orders = ServiceOrder::with(['user', 'logisticsService'])
            ->latest()
            ->get();

        return view('admin.dashboard', [
            'services' => LogisticsService::withCount('orders')->orderBy('sort_order')->orderBy('name')->get(),
            'orders' => $orders,
            'users' => User::withCount('serviceOrders')->latest()->get(),
            'serviceImages' => $this->serviceImages(),
            'stats' => [
                'users' => User::where('is_admin', false)->count(),
                'services' => LogisticsService::count(),
                'active_services' => LogisticsService::where('is_active', true)->count(),
                'inactive_services' => LogisticsService::where('is_active', false)->count(),
                'orders' => $orders->count(),
                'pending' => $orders->where('status', ServiceOrder::STATUS_PENDING)->count(),
                'accepted' => $orders->where('status', ServiceOrder::STATUS_ACCEPTED)->count(),
                'rejected' => $orders->where('status', ServiceOrder::STATUS_REJECTED)->count(),
            ],
        ]);
    }

    public function storeService(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'icon' => ['nullable', 'string', 'max:80'],
            'image_path' => ['nullable', 'string', 'max:255'],
            'link_url' => ['nullable', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:1000'],
            'base_price' => ['nullable', 'numeric', 'min:0', 'max:999999.99'],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:999'],
        ]);

        LogisticsService::create([
            'name' => $validated['name'],
            'icon' => ($validated['icon'] ?? null) ?: 'fa fa-truck',
            'image_path' => $validated['image_path'] ?? null,
            'link_url' => $validated['link_url'] ?? null,
            'description' => $validated['description'],
            'base_price' => $validated['base_price'] ?? null,
            'is_active' => $request->boolean('is_active', true),
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        return back()->with('success', 'Service added. Users can book it now.');
    }

    public function updateService(Request $request, LogisticsService $logisticsService): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'icon' => ['nullable', 'string', 'max:80'],
            'image_path' => ['nullable', 'string', 'max:255'],
            'link_url' => ['nullable', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:1000'],
            'base_price' => ['nullable', 'numeric', 'min:0', 'max:999999.99'],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:999'],
        ]);

        $logisticsService->update([
            'name' => $validated['name'],
            'icon' => ($validated['icon'] ?? null) ?: 'fa fa-truck',
            'image_path' => $validated['image_path'] ?? null,
            'link_url' => $validated['link_url'] ?? null,
            'description' => $validated['description'],
            'base_price' => $validated['base_price'] ?? null,
            'is_active' => $request->boolean('is_active'),
            'sort_order' => $validated['sort_order'] ?? 0,
        ]);

        return back()->with('success', 'Service updated successfully.');
    }

    public function destroyService(LogisticsService $logisticsService): RedirectResponse
    {
        $logisticsService->delete();

        return back()->with('success', 'Service deleted successfully. Existing booking records are preserved.');
    }

    public function updateOrderStatus(UpdateBookingStatusRequest $request, ServiceOrder $serviceOrder): RedirectResponse
    {
        $validated = $request->validated();

        $serviceOrder->update([
            'status' => $validated['status'],
            'admin_note' => $validated['admin_note'] ?? null,
            'reviewed_by' => $request->user()->id,
            'reviewed_at' => now(),
        ]);

        return back()->with('success', 'Booking status updated. The user dashboard now shows the change.');
    }

    private function serviceImages(): array
    {
        if (! File::isDirectory(public_path('img'))) {
            return [];
        }

        return collect(File::files(public_path('img')))
            ->filter(fn ($file) => str_starts_with($file->getFilename(), 'service-'))
            ->map(fn ($file) => 'img/'.$file->getFilename())
            ->values()
            ->all();
    }
}
