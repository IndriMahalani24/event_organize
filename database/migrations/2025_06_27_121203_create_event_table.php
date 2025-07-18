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
        Schema::create('event', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->dateTime('event_date');
        $table->string('location');
        $table->integer('max_participants'); // <-- sudah langsung masuk
        $table->string('poster');
        $table->integer('registration_fee');
        $table->string('speaker');
        $table->string('status')->default('active');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event');
    }
};
