<?php

use App\Models\LogisticsService;
use App\Models\ServiceOrder;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('login and register pages render', function () {
    $this->get('/login')->assertOk();
    $this->get('/register')->assertOk();
});

test('new accounts are created as normal users and land on user dashboard', function () {
    $this->post('/register', [
        'name' => 'Normal User',
        'email' => 'user@example.com',
        'phone' => '+8801712345678',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ])->assertRedirect(route('user.dashboard'));

    $user = User::where('email', 'user@example.com')->first();

    expect($user->is_admin)->toBeFalse()
        ->and($user->phone)->toBe('+8801712345678');
});

test('single login routes users by is admin boolean', function () {
    $user = User::factory()->create([
        'email' => 'member@example.com',
        'password' => 'password123',
        'is_admin' => false,
    ]);

    $admin = User::factory()->create([
        'email' => 'admin@example.com',
        'password' => 'password123',
        'is_admin' => true,
    ]);

    $this->post('/login', [
        'email' => 'member@example.com',
        'password' => 'password123',
    ])->assertRedirect(route('user.dashboard'));

    $this->assertAuthenticatedAs($user);
    $this->post('/logout');

    $this->post('/login', [
        'email' => 'admin@example.com',
        'password' => 'password123',
    ])->assertRedirect(route('admin.dashboard'));

    $this->assertAuthenticatedAs($admin);
});

test('booking page requires login and returns users after login', function () {
    $user = User::factory()->create([
        'email' => 'member@example.com',
        'password' => 'password123',
        'is_admin' => false,
    ]);

    $this->get(route('bookings'))
        ->assertRedirect(route('login'));

    $this->post(route('login.store'), [
        'email' => 'member@example.com',
        'password' => 'password123',
    ])->assertRedirect(route('bookings'));

    $this->assertAuthenticatedAs($user);
});

test('old quote links redirect into authenticated bookings', function () {
    $this->get('/quote')
        ->assertRedirect('/bookings');

    $this->get('/quote.html')
        ->assertRedirect('/bookings');
});

test('service booking link returns users to the selected booking page after login', function () {
    $user = User::factory()->create([
        'email' => 'member@example.com',
        'password' => 'password123',
        'is_admin' => false,
    ]);

    $service = LogisticsService::create([
        'name' => 'Air Freight',
        'icon' => 'fa fa-plane',
        'description' => 'Fast air cargo service.',
        'is_active' => true,
    ]);

    $this->get(route('user.orders.create', $service))
        ->assertRedirect(route('login'));

    $this->post(route('login.store'), [
        'email' => 'member@example.com',
        'password' => 'password123',
    ])->assertRedirect(route('user.orders.create', $service));

    $this->assertAuthenticatedAs($user);
});

test('authenticated users can book a selected service without using the dashboard form', function () {
    $user = User::factory()->create(['is_admin' => false]);
    $service = LogisticsService::create([
        'name' => 'Ocean Freight',
        'icon' => 'fa fa-ship',
        'description' => 'Container freight service.',
        'is_active' => true,
    ]);

    $this->actingAs($user)
        ->get(route('user.orders.create', $service))
        ->assertOk()
        ->assertSee('Book Ocean Freight')
        ->assertSee('Container freight service.');

    $this->actingAs($user)
        ->post(route('user.orders.store'), [
            'logistics_service_id' => $service->id,
            'pickup_address' => 'Dhaka Warehouse',
            'delivery_address' => 'Chittagong Port',
            'preferred_date' => now()->addDay()->toDateString(),
            'package_weight' => 40,
            'customer_note' => 'Handle carefully',
        ])
        ->assertRedirect(route('user.dashboard'))
        ->assertSessionHas('success');

    $this->assertDatabaseHas('service_orders', [
        'user_id' => $user->id,
        'logistics_service_id' => $service->id,
        'status' => ServiceOrder::STATUS_PENDING,
        'pickup_address' => 'Dhaka Warehouse',
        'delivery_address' => 'Chittagong Port',
    ]);
});

test('normal users cannot enter admin dashboard', function () {
    $user = User::factory()->create(['is_admin' => false]);

    $this->actingAs($user)
        ->get(route('admin.dashboard'))
        ->assertRedirect(route('login'));

    $this->assertGuest();
});

test('admin service and booking decisions appear on user dashboard', function () {
    $admin = User::factory()->create(['is_admin' => true]);
    $user = User::factory()->create(['is_admin' => false]);

    $this->actingAs($admin)
        ->post(route('admin.services.store'), [
            'name' => 'Air Freight',
            'icon' => 'fa fa-plane',
            'description' => 'Fast air cargo service.',
            'base_price' => 250,
            'is_active' => 1,
        ])
        ->assertRedirect();

    $service = LogisticsService::where('name', 'Air Freight')->first();

    $this->actingAs($user)
        ->post(route('user.orders.store'), [
            'logistics_service_id' => $service->id,
            'pickup_address' => 'Dhaka Warehouse',
            'delivery_address' => 'Chittagong Port',
            'preferred_date' => now()->addDay()->toDateString(),
            'package_weight' => 40,
            'customer_note' => 'Handle carefully',
        ])
        ->assertRedirect();

    $order = ServiceOrder::first();
    expect($order->status)->toBe(ServiceOrder::STATUS_PENDING);

    $this->actingAs($admin)
        ->patch(route('admin.orders.status', $order), [
            'status' => ServiceOrder::STATUS_ACCEPTED,
            'admin_note' => 'Approved for pickup.',
        ])
        ->assertRedirect();

    $this->actingAs($user)
        ->get(route('user.dashboard'))
        ->assertOk()
        ->assertSee('accepted')
        ->assertSee('Approved for pickup.');
});

test('admin can delete services that have no orders', function () {
    $admin = User::factory()->create(['is_admin' => true]);
    $service = LogisticsService::create([
        'name' => 'Warehouse Handling',
        'icon' => 'fa fa-warehouse',
        'description' => 'Temporary storage and handling.',
        'is_active' => true,
    ]);

    $this->actingAs($admin)
        ->delete(route('admin.services.destroy', $service))
        ->assertRedirect()
        ->assertSessionHas('success');

    $this->assertSoftDeleted($service);
});

test('admin can delete services that already have orders while preserving booking history', function () {
    $admin = User::factory()->create(['is_admin' => true]);
    $user = User::factory()->create(['is_admin' => false]);
    $service = LogisticsService::create([
        'name' => 'Sea Freight',
        'icon' => 'fa fa-ship',
        'description' => 'Container freight service.',
        'is_active' => true,
    ]);

    $order = ServiceOrder::create([
        'user_id' => $user->id,
        'logistics_service_id' => $service->id,
        'status' => ServiceOrder::STATUS_PENDING,
        'pickup_address' => 'Dhaka Warehouse',
        'delivery_address' => 'Chittagong Port',
    ]);

    $this->actingAs($admin)
        ->delete(route('admin.services.destroy', $service))
        ->assertRedirect()
        ->assertSessionHas('success');

    $this->assertSoftDeleted($service);
    $this->assertModelExists($order);

    expect($order->fresh()->logisticsService->name)->toBe('Sea Freight');
});
