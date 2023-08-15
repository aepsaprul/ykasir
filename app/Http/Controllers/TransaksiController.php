<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;

class TransaksiController extends Controller
{
  public function index()
  {
    $transaksi = Transaksi::orderBy('id', 'desc')->get();

    return view('transaksi.index', ['transaksis' => $transaksi]);
  }
  public function show($id)
  {
    $transaksi = Transaksi::find($id);
    $transaksiDetail = TransaksiDetail::where('transaksi_id', $transaksi->id)->get();

    return view('transaksi.show', ['transaksiDetails' => $transaksiDetail]);
  }
}
