<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    // Daftarkan kolom yang boleh diisi
    protected $fillable = [
        'user_id',
        'nama_kegiatan',
        'jenis_surat',
        'tanggal_pengajuan',
        'keterangan',
        'file_path',
        'status',
        'revision_note',
    ];
}