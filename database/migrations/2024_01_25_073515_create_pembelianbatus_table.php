<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pembelianbatus', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('id_batu');
            $table->string('id_pegawai');
            $table->string('id_customer');
            $table->string('berapaton');
            $table->string('no_telp');
            $table->string('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
            // $table->string('pemiliktoko');
            // $table->string('domisili');
            // $table->string('alamat');
            // $table->string('fotoktp');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembelianbatus');
    }
};
