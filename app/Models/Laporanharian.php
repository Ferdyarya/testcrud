<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporanharian extends Model
{
    use HasFactory;
    protected $casts = [
        'expired_at' => 'tanggal'
    ];
    protected $fillable = [
        'tanggal', 'retase', 'tonase','harga','id_batu'
    ];

    public function masterbatu()
    {
        return $this->hasOne(Masterbatu::class, 'id', 'id_batu');
    }
}
