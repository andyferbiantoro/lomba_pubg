<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemenang extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_pemenang';
    protected $table = 'pemenang';
    protected $guarded = [];

    public function pembuat()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
