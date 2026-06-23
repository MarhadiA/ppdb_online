<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JalurPendaftaran extends Model
{
    protected $table = 'jalur_pendaftaran';

    protected $fillable = [
        'nama',
        'kuota',
        'deskripsi',
    ];

 public function registrations()
{
    return $this->hasMany(Registration::class, 'jalur_id');
}
}
