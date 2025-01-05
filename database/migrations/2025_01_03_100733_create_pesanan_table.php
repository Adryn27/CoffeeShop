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
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('pelanggan')->nullable();
            $table->bigInteger('total')->nullable();
            $table->enum('proses', ['selesai', 'pending'])->default('pending');   
            $table->enum('status', ['dibayar', 'belum'])->default('belum');   
            $table->enum('layanan', ['dinein', 'takeaway'])->nullable();   
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan');
    }
};
