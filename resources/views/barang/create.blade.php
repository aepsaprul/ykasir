@extends('layouts.app')

@section('title') Tambah Data Barang @endsection

@section('content')
<div class="container-fluid px-4">
  <h3 class="my-4">Tambah Data Barang</h3>
  <div class="row">
    <div class="col-12">
      <form action="{{ route('barang.store') }}" method="post">
        @csrf
        <div class="row">
          <div class="col-3">
            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control form-control-sm" autofocus>
          </div>
          <div class="col-3">
            <label for="harga_beli">Harga Beli</label>
            <input type="text" name="harga_beli" id="harga_beli" class="form-control form-control-sm">
          </div>
          <div class="col-3">
            <label for="harga_jual">Harga Jual</label>
            <input type="text" name="harga_jual" id="harga_jual" class="form-control form-control-sm">
          </div>
          <div class="col-3">
            <label for="stok">Stok</label>
            <input type="text" name="stok" id="stok" class="form-control form-control-sm">
          </div>
        </div>
        <div class="mt-3">
          <div class="col-12">
            <button class="btn btn-sm btn-primary" style="width: 130px;"><i class="fas fa-save"></i> Simpan</button>
          </div>
        </div>
      </form>
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