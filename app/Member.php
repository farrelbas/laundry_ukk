<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'member';
    public $timestamps = false;

    protected $fillable = ['nama', 'alamat', 'jenis_kelamin', 'tlp'];
}
