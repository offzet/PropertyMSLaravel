// database/migrations/xxxx_xx_xx_xxxxxx_create_tenants_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('property_unit');
            $table->date('lease_start');
            $table->date('lease_end');
            $table->decimal('rent_amount', 10, 2);
            $table->string('status')->default('active');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tenants');
    }
};