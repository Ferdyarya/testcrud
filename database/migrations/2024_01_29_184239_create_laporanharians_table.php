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
        Schema::create('laporanharians', function (Blueprint $table) {
            $table->id();
            $table->string('tanggal');
            $table->string('id_batu');
            $table->string('retase');
            $table->string('tonase');
            $table->string('harga');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporanharians');
    }
};
