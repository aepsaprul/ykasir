<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class KasirController extends Controller
{
  public function index()
  {
    $transaksi = Transaksi::max('id');
    $nomor_transaksi = sprintf("%05s", $transaksi + 1);

    $barang = Barang::get();

    return view('kasir.index', [
      'barangs' => $barang,
      'nomor_transaksi' => $nomor_transaksi
    ]);
  }
  public function dataBarang($id)
  {
    $barang = Barang::find($id);

    return response()->json([
      'barang' => $barang
    ]);
  }
  public function transaksi(Request $request)
  {
    $transaksi = new Transaksi;
    $transaksi->nomor_transaksi = $request->nomorTransaksi;
    $transaksi->total_qty = $request->totalQty;
    $transaksi->total_harga = $request->totalHarga;
    $transaksi->user_id = Auth::user()->id;
    $transaksi->save();

    foreach (json_decode($request->tabel) as $key => $item) {
      $barang = Barang::find($item->barangId);
      $barang->stok = $barang->stok - $item->qty;
      $barang->terjual = $barang->terjual + $item->qty;
      $barang->kas_masuk = str_replace(".","", $item->harga) * $item->qty;
      $barang->profit = $barang->profit + (($barang->harga_jual - $barang->harga_beli) * $item->qty);
      $barang->save();

      $transaksi_detail = new TransaksiDetail;
      $transaksi_detail->transaksi_id = $transaksi->id;
      $transaksi_detail->barang_id = $item->barangId;
      $transaksi_detail->qty = $item->qty;
      $transaksi_detail->harga = str_replace(".","", $item->harga) * $item->qty;
      $transaksi_detail->profit = ($barang->harga_jual - $barang->harga_beli) * $item->qty;
      $transaksi_detail->save();
    }

    return response()->json([
      'id' => $transaksi->id
    ]);
  }
  public function print($id)
  {
    $transaksi = Transaksi::with('dataDetail')->find($id);

    return view('kasir.print', ['transaksi' => $transaksi]);
  }
}
