<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesertaTournament extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_anggota';
    protected $table = 'peserta_tournament';
    protected $guarded = [];
}
