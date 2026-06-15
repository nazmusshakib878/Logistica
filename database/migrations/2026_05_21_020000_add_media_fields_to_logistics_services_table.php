<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('logistics_services', function (Blueprint $table): void {
            $table->string('image_path')->nullable()->after('icon');
            $table->string('link_url')->nullable()->after('image_path');
            $table->unsignedSmallInteger('sort_order')->default(0)->after('is_active');
        });

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
            DB::table('logistics_services')->updateOrInsert(
                ['name' => $service['name']],
                [
                    'icon' => $service['icon'],
                    'image_path' => $service['image_path'],
                    'link_url' => null,
                    'description' => $service['description'],
                    'is_active' => true,
                    'sort_order' => $service['sort_order'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            );
        }
    }

    public function down(): void
    {
        Schema::table('logistics_services', function (Blueprint $table): void {
            $table->dropColumn(['image_path', 'link_url', 'sort_order']);
        });
    }
};
