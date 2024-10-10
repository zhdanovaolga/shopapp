<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->string("description");
            $table->string("image");
            $table->decimal('price', 10,2);
            $table->boolean("rented")->default(false);
            $table->boolean("purchased")->default(false);
            $table->foreignId("category_id");
            $table->integer("publish_year")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
