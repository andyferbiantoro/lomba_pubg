<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_tournament';
    protected $table = 'tournament';
    protected $guarded = [];

    public function penyelenggara()
    {
        return $this->belongsTo(User::class, 'id_penyelenggara');
    }
}
