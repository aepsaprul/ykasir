@extends('layouts.app')

@section('title') Detail Transaksi @endsection

@section('content')
<div class="container-fluid px-4">
  <div class="d-flex justify-content-between">
    <div>
      <h3 class="my-4">Detail Transaksi</h3>
    </div>
    <div class="mt-4">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('transaksi') }}" class="text-decoration-none">Transaksi</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detail</li>
      </ol>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th class="text-center">No</th>
            <th class="text-center">Barang</th>
            <th class="text-center">Qty</th>
            <th class="text-center">Harga</th>
          </tr>
        </thead>
        <tbody>
          @foreach($transaksiDetails as $key => $item)
            <tr>
              <td class="text-center">{{ $key + 1 }}</td>
              <td>{{ $item->nama_barang }}</td>
              <td class="text-center">{{ $item->qty }}</td>
              <td class="text-end">{{ rupiah($item->harga) }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection

@section('script')
<script>
  const harga_beli = document.getElementById("harga_beli");
  harga_beli.addEventListener("keyup", function(e) {
    harga_beli.value = rupiahJsKeyup(this.value, "");
  });
  const harga_jual = document.getElementById("harga_jual");
  harga_jual.addEventListener("keyup", function(e) {
    harga_jual.value = rupiahJsKeyup(this.value, "");
  });
</script>
@endsection