<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_berita';
    protected $table = 'berita';
    protected $guarded = [];

    public function pembuat()
    {
        return $this->belongsTo(User::class, 'id_admin');
    }
}
