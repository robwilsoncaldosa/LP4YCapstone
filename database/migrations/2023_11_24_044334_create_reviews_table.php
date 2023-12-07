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
        Schema::create('reviews', function (Blueprint $table) {
            Schema::create('reviews', function (Blueprint $table) {
                $table->id();
                // $table->unsignedBigInteger('reservation_id');
                $table->text('name');
                // $table->unsignedBigInteger('user_id');
                $table->integer('rating');
                $table->text('comment');
                $table->timestamps();
                // $table->foreign('reservation_id')->references('id')->on('reservations')->onDelete('cascade');
                // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};