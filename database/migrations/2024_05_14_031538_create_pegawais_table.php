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
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('jabatan_id')->unsigned();
            $table->bigInteger('golongan_id')->unsigned();
            $table->bigInteger('agama_id')->unsigned();
            $table->bigInteger('jeniskelamin_id')->unsigned();
            $table->string('nama');
            $table->integer('nip');
            $table->integer('nik');
            $table->date('tmt');
            $table->integer('usia');
            $table->integer('masakerja');
            $table->string('alamat');
            $table->string('ttl');
            
            $table->timestamps();           
        });                
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawais');
    }
};
