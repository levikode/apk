<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Relations\HasMany;

class Pegawai extends Model
{
    use HasFactory;
    protected $fillable=['user_id','nama','nip','jeniskelamin','tempatlahir','usia','masakerja','keluarga_id','golongan_id','agama_id','unitkerja_id','tanggallahir','alamat','foto'];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function golongan():BelongsTo
    {
        return $this->belongsTo(Golongan::class);
    }
    public function keluarga():BelongsTo
    {
        return $this->belongsTo(Keluarga::class);
    }
    public function agama():BelongsTo
    {
        return $this->belongsTo(Agama::class);
    }
    public function unitkerja():BelongsTo
    {
        return $this->belongsTo(Unitkerja::class);
    }
    
}
