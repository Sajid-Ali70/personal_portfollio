<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclePlatesTableNew extends Migration  // Changed class name
{
    public function up()
    {
        // Check if table already exists before creating
        if (!Schema::hasTable('vehicle_plates')) {
            Schema::create('vehicle_plates', function (Blueprint $table) {
                $table->id();
                $table->string('plate_number')->unique();
                $table->string('country_code')->nullable();
                $table->string('vehicle_type')->nullable();
                $table->string('color')->nullable();
                $table->string('make')->nullable();
                $table->string('model')->nullable();
                $table->integer('year')->nullable();
                $table->string('owner_name')->nullable();
                $table->string('owner_phone')->nullable();
                $table->string('owner_email')->nullable();
                $table->text('address')->nullable();
                $table->enum('status', ['active', 'stolen', 'expired', 'suspended'])->default('active');
                $table->text('notes')->nullable();
                $table->timestamp('scanned_at')->nullable();
                $table->string('scanned_by')->nullable();
                $table->string('image_path')->nullable();
                $table->timestamps();
                
                $table->index('plate_number');
                $table->index('status');
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('vehicle_plates');
    }
}