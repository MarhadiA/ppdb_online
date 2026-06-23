<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'user_id',
        'nik',
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'alamat',
        'no_hp',
        'nama_ayah',
        'nama_ibu',
        'pekerjaan_ortu',
        'sekolah_asal',
        'nilai_rata_rata',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function registration()
    {
        return $this->hasOne(Registration::class);
    }
}
