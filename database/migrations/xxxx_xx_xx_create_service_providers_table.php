<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
   public function up()
{
    Schema::create('service_providers', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('email')->unique();
        $table->string('phone');
        $table->string('service');
        $table->boolean('status')->default(1); // 1 = Active, 0 = Inactive
        $table->timestamps();
    });
}


    public function down(): void
    {
        Schema::dropIfExists('service_providers');
    }
};
