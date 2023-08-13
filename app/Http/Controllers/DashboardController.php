<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
  public function index()
  {
    $totalTransaksiHariIni = count(Transaksi::where('created_at', 'like', '%'.date('Y-m-d').'%')->get());
    $totalProfitHariIni = TransaksiDetail::where('created_at', 'like', '%'.date('Y-m-d').'%')->sum('profit');
    
    return view('dashboard', [
      'totalTransaksiHariIni' => $totalTransaksiHariIni,
      'totalProfitHariIni' => $totalProfitHariIni
    ]);
  }
  public function diagramProfit()
  {
    $transaksiDetail = TransaksiDetail::select(
      DB::raw('SUM(profit) as dataprofit'), 
      DB::raw("DATE_FORMAT(created_at, '%Y-%m') new_date"), 
      DB::raw('YEAR(created_at) tahun, MONTH(created_at) bulan'))
    ->groupby('tahun','bulan')
    ->get();

    return response()->json([
      'data' => $transaksiDetail
    ]);
  }
}
