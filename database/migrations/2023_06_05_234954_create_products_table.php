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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('model')->nullable();
            $table->text('description');
            $table->integer('price');
            $table->integer('stock');
            $table->dateTime('date_manufacture');
            $table->dateTime('date_expiration')->nullable();
            $table->integer('state');
            

            // Claves foraneas
            $table->unsignedBigInteger('mark_id');
            $table->unsignedBigInteger('category_id');

            $table->timestamps();

            // Union de las claves
            // Foranea de marca
            $table->foreign('mark_id')
                ->references('id')
                ->on('marks')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            // Foranea de categoria
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
