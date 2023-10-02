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
        Schema::create('beritas', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->char('id_berita', 15); 
            $table->char('id_kategori', 15);
            $table->string('judul');
            $table->string('isi_berita');
            $table->date('tanggal');
            $table->string('gambar')->nullable; //nullable boleh dikosongkan, atau isinya nanti saja
            $table->timestamps();
    
            //membuat relasi
            $table->foreign('id_kategori')->references('id_kategori')->on('kategoris')->onDelete('cascade')->onUpdate('cascade');  
        });
    
         Schema::table('beritas', function ($table) {
            $table->dropPrimary('id');
            $table->primary('id_berita');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beritas');
    }
};
