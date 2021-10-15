<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    protected $table = 'paket';
    public $timestamps = false;

    protected $fillable = ['jenis', 'harga'];
}
