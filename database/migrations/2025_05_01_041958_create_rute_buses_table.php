<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('rute_buses', function (Blueprint $table) {
            $table->id();
            $table->string('asal');
            $table->string('tujuan');
            $table->date('tanggal_berangkat');
            $table->string('merk_bus');
            $table->string('tipe_bus');
            $table->integer('harga');
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rute_buses');
    }
};
