<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_transaksi';
    protected $table = 'transaksi';
    protected $guarded = [];

    public function peserta()
    {
        return $this->belongsTo(User::class, 'id_peserta');
    }

    public function penyelenggara()
    {
        return $this->belongsTo(User::class, 'id_penyelenggara');
    }

    public function tournament()
    {
        return $this->belongsTo(Tournament::class, 'id_tournament');
    }
}
