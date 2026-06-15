<?php

namespace Database\Seeders;

use App\Models\LogisticsService;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->seedUsers();
        $this->seedServices();
    }

    private function seedUsers(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'phone' => '+8801700000000',
                'password' => Hash::make('password'),
                'is_admin' => true,
            ],
        );

        User::query()->updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'phone' => '+8801711111111',
                'password' => Hash::make('password'),
                'is_admin' => false,
            ],
        );
    }

    private function seedServices(): void
    {
        $services = [
            [
                'name' => 'Air Freight',
                'icon' => 'fa fa-plane',
                'image_path' => 'img/service-1.jpg',
                'description' => 'Fast air cargo solutions for urgent shipments, priority handling, and reliable international delivery.',
                'sort_order' => 1,
            ],
            [
                'name' => 'Ocean Freight',
                'icon' => 'fa fa-ship',
                'image_path' => 'img/service-2.jpg',
                'description' => 'Cost-effective sea freight for bulk cargo, container shipping, and scheduled global trade lanes.',
                'sort_order' => 2,
            ],
            [
                'name' => 'Road Freight',
                'icon' => 'fa fa-truck',
                'image_path' => 'img/service-3.jpg',
                'description' => 'Flexible road transportation for local and regional deliveries with dependable pickup and tracking.',
                'sort_order' => 3,
            ],
            [
                'name' => 'Train Freight',
                'icon' => 'fa fa-train',
                'image_path' => 'img/service-4.jpg',
                'description' => 'Efficient rail freight for heavy cargo, long-distance routes, and lower-emission supply chains.',
                'sort_order' => 4,
            ],
            [
                'name' => 'Customs Clearance',
                'icon' => 'fa fa-file-invoice',
                'image_path' => 'img/service-5.jpg',
                'description' => 'Professional customs support for documentation, compliance checks, and faster border processing.',
                'sort_order' => 5,
            ],
            [
                'name' => 'Warehouse Solutions',
                'icon' => 'fa fa-warehouse',
                'image_path' => 'img/service-6.jpg',
                'description' => 'Secure storage, inventory support, and distribution services designed for modern logistics operations.',
                'sort_order' => 6,
            ],
        ];

        foreach ($services as $service) {
            LogisticsService::withTrashed()->updateOrCreate(
                ['name' => $service['name']],
                [
                    'icon' => $service['icon'],
                    'image_path' => $service['image_path'],
                    'link_url' => null,
                    'description' => $service['description'],
                    'is_active' => true,
                    'sort_order' => $service['sort_order'],
                    'deleted_at' => null,
                ],
            );
        }
    }
}
