<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $fillable = [
        'student_id',
        'jalur_id',
        'nomor_pendaftaran',
        'status',
        'ranking_nilai',
         'is_final',
        'catatan_admin',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function jalur()
    {
        return $this->belongsTo(JalurPendaftaran::class, 'jalur_id');
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    // helper status
    public function isVerified()
    {
        return $this->status === 'terverifikasi';
    }
}
