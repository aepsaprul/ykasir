<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
  public function index()
  {
    $barang = Barang::orderBy('id', 'desc')->get();

    return view('barang.index', ['barangs' => $barang]);
  }
  public function create()
  {
    return view('barang.create');
  }
  public function store(Request $request)
  {
    $barang = new Barang;
    $barang->nama = $request->nama;
    $barang->harga_beli = str_replace(".","", $request->harga_beli);
    $barang->harga_jual = str_replace(".","", $request->harga_jual);
    $barang->stok = $request->stok;
    $barang->save();

    return redirect()->route('barang');
  }
  public function edit($id)
  {
    $barang = Barang::find($id);

    return view('barang.edit', ['barang' => $barang]);
  }
  public function update(Request $request, $id)
  {
    $barang = Barang::find($id);
    $barang->nama = $request->nama;
    $barang->harga_beli = str_replace(".","", $request->harga_beli);
    $barang->harga_jual = str_replace(".","", $request->harga_jual);
    $barang->stok = $request->stok;
    $barang->save();

    return redirect()->route('barang');
  }
  public function delete(Request $request)
  {
    $barang = Barang::find($request->delete_id);
    $barang->delete();

    return redirect()->route('barang');
  }
}
