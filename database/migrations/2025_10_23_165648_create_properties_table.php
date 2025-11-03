<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); 
            $table->string('name');
            $table->string('type'); 
            $table->string('location');
            $table->decimal('price', 12, 2); 
            $table->string('status')->default('available');
            $table->text('description')->nullable();
            $table->integer('bedrooms')->nullable();
            $table->integer('bathrooms')->nullable();
            $table->decimal('area_sqm', 8, 2)->nullable(); 
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('properties');
    }
};