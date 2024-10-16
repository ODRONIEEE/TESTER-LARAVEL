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
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->integer('cat_id')->nullable();
            $table->integer('type_id')->nullable();
            $table->integer('sugar_id')->nullable();
            $table->integer('espresso_id')->nullable();
            $table->string('product_code'); //Unique code for product identifier <!-- Custom -->
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 8,2);
            $table->integer('stock');
            $table->string('image')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
