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
        Schema::create('maintenance_settings', function (Blueprint $table) {
            $table->id();
            $table->string('merchant_id');
            $table->unsignedBigInteger('maintenance_setting_mode_id');
            $table->date('turned_on_date')->nullable();
            $table->date('turned_off_date')->nullable();
            $table->string('title')->nullable();
            $table->longText('text')->nullable();
            $table->timestamps();

            // $table->foreign('maintenance_setting_mode_id')
            // ->references('id')
            // ->on('maintenance_setting_modes')
            // ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance_settings');
    }
};
