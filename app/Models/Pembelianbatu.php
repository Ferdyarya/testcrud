<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelianbatu extends Model
{
    use HasFactory;
    protected $casts = [
        'expired_at' => 'tanggal'
    ];
    protected $fillable = [
        'tanggal','id_batu','id_pegawai','id_customer','berapaton','no_telp','status'
    ];

    public function masterpegawai()
    {
        return $this->hasOne(Masterpegawai::class, 'id', 'id_pegawai');
    }

    public function masterbatu()
    {
        return $this->hasOne(Masterbatu::class, 'id', 'id_batu');
    }

    public function mastercustomer()
    {
        return $this->hasOne(Mastercustomer::class, 'id', 'id_customer');
    }
}
