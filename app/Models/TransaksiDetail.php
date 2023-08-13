<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiDetail extends Model
{
  use HasFactory;

  public function dataBarang() {
    return $this->belongsTo(Barang::class, 'barang_id', 'id');
  }
}
