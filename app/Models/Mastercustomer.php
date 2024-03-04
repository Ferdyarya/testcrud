<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mastercustomer extends Model
{
    use HasFactory;
    protected $fillable = [
        'namacust','alamat','no_telp','email'
    ];
}
