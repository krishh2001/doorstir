<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->unsignedBigInteger('category_id'); // MUST match categories.id
    $table->decimal('price', 10, 2);
    $table->timestamps();

    $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
});


    }

    public function down()
    {
        Schema::dropIfExists('services');
    }
}
