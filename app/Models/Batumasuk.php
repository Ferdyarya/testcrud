<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batumasuk extends Model
{
    use HasFactory;
    protected $casts = [
        'expired_at' => 'tanggal'
    ];
    protected $fillable = [
        'id_supplier', 'jenisbatu', 'qty', 'tanggal'
    ];

    public function mastersupplier()
    {
        return $this->hasOne(Mastersupplier::class, 'id', 'id_supplier');
    }
}
