<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table ='siswa';
    protected $fillable = ['nama', 'nisn', 'tempat_lahir', 'tanggal_lahir', 'alamat', 'telepon'];
    protected $guarded = ['id'];
}

