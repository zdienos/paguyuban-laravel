<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    // use HasFactory;

    protected $fillable = [
        'nama_lengkap',
        // 'nip',
        // 'kelamin',
        // 'bidang_studi',
        // 'alamat',
        // 'handphone'
    ];

    // public function toStrukturUnit()
    // {
    //     return $this->belongsTo(StrukturUnit::class, 'strukturunit_id');
    // }

}
