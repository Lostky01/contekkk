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
        Schema::create('siswa', function (Blueprint $table) {

           $table->id();
           # make columns nisn(10),nama(text),tempat lahir(varchar 30) tanggal lahir(date) alamat(varchar 225) telepon(text)
           $table->string('nisn',10)->unique();
           $table->string('nama',50);
           $table->string('tempat_lahir',30);
           $table->date('tanggal_lahir');
           $table->string('alamat',225);
           $table->string('telepon',15);
           $table->timestamps();
       });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        # continue the schema 
        Schema::dropIfExists('siswa');
    }
};
