<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('logistics_services', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('icon')->default('fa fa-truck');
            $table->text('description');
            $table->decimal('base_price', 10, 2)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('logistics_services');
    }
};
