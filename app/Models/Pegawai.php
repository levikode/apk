<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Relations\HasMany;

class Pegawai extends Model
{
    use HasFactory;
    protected $fillable=['user_id','nama','nip','jeniskelamin','usia','masakerja','statuskeluarga','golongandarah','agama','unitkerja_id','jabatan_id','ttl','alamat','foto'];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
   
    
    public function unitkerja():BelongsTo
    {
        return $this->belongsTo(Unitkerja::class);
    }
    public function jabatan():BelongsTo
    {
        return $this->belongsTo(Jabatan::class);
    }
    
}
