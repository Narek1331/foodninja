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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->string('merchant_id');
            $table->unsignedBigInteger('display_location_id');
            $table->string('title');
            $table->longText('text');
            $table->boolean('status')->default(false);
            $table->text('img_path')->nullable();
            $table->string('promo_code');
            $table->timestamps();

            // $table->foreign('display_location_id')
            // ->references('id')
            // ->on('display_locations')
            // ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
