<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;

class TransaksiController extends Controller
{
  public function index()
  {
    $transaksi = Transaksi::get();

    return view('transaksi.index', ['transaksis' => $transaksi]);
  }
}
