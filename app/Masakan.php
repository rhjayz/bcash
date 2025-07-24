<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Masakan extends Model
{
	protected $primaryKey = 'id_masakan';
    protected $fillable = ['masakan','harga','jenis','gambar','status_masakan'];

}
