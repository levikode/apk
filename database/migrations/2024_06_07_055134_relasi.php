<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {

        
        Schema::table('pegawais',function(Blueprint $table){
            $table->foreign('user_id')->references('id')->on('Users')
            ->onUpdate('cascade')->onDelete('cascade');            
        });

        Schema::table('pegawais',function(Blueprint $table){
            $table->foreign('jabatan_id')->references('id')->on('jabatans')
            ->onUpdate('cascade')->onDelete('cascade');            
        });

        Schema::table('pegawais',function(Blueprint $table){
            $table->foreign('golongan_id')->references('id')->on('golongans')
            ->onUpdate('cascade')->onDelete('cascade');            
        });

        Schema::table('pegawais',function(Blueprint $table){
            $table->foreign('agama_id')->references('id')->on('agamas')
            ->onUpdate('cascade')->onDelete('cascade');            
        });

        Schema::table('pegawais',function(Blueprint $table){
            $table->foreign('jeniskelamin_id')->references('id')->on('jeniskelamins')
            ->onUpdate('cascade')->onDelete('cascade');            
        });
       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pegawais', function(Blueprint $table) {
            $table->dropForeign('pegawai_jabatan_id_foreign');
        });
        Schema::table('pegawais', function(Blueprint $table) {
            $table->dropIndex('pegawai_jabatan_id_foreign');
        });

        
        Schema::table('pegawais', function(Blueprint $table) {
            $table->dropForeign('pegawai_user_id_foreign');
        });
        Schema::table('pegawais', function(Blueprint $table) {
            $table->dropIndex('pegawai_user_id_foreign');
        });


        Schema::table('pegawais', function(Blueprint $table) {
            $table->dropForeign('pegawai_golongan_id_foreign');
        });
        Schema::table('pegawais', function(Blueprint $table) {
            $table->dropIndex('pegawai_golongan_id_foreign');
        });
        

        Schema::table('pegawais', function(Blueprint $table) {
            $table->dropForeign('pegawai_agama_id_foreign');
        });
        Schema::table('pegawais', function(Blueprint $table) {
            $table->dropIndex('pegawai_agama_id_foreign');
        });

        

        Schema::table('pegawais', function(Blueprint $table) {
            $table->dropForeign('pegawai_jeniskelamin_id_foreign');
        });
        Schema::table('pegawais', function(Blueprint $table) {
            $table->dropIndex('pegawai_jeniskelamin_id_foreign');
        });


        Schema::dropIfExists('pegawais');
        
    }
};

