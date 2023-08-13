@extends('layouts.app')

@section('title') Barang @endsection

@section('content')
<div class="container-fluid px-4">
  <h3 class="my-4">Barang</h3>
  <div class="row mb-4">
    <div class="col-12">
      <a href="{{ route('barang.create') }}" class="btn btn-sm btn-primary" style="width: 130px;"><i class="fas fa-plus"></i> Tambah</a>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th class="text-center">No</th>
            <th class="text-center">Nama</th>
            <th class="text-center">Beli</th>
            <th class="text-center">Jual</th>
            <th class="text-center">Stok</th>
            <th class="text-center">Terjual</th>
            <th class="text-center">Profit</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach($barangs as $key => $item)
            <tr>
              <td class="text-center">{{ $key + 1 }}</td>
              <td>{{ $item->nama }}</td>
              <td class="text-end">{{ rupiah($item->harga_beli) }}</td>
              <td class="text-end">{{ rupiah($item->harga_jual) }}</td>
              <td class="text-end">{{ $item->stok }}</td>
              <td class="text-center">{{ $item->terjual }}</td>
              <td class="text-end">{{ rupiah($item->profit) }}</td>
              <td class="text-center">
                <a href="{{ route('barang.edit', [$item->id]) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                <button type="button" class="btn btn-sm btn-danger btn-delete" data-id="{{ $item->id }}" data-bs-toggle="modal" data-bs-target="#modal_delete"><i class="fas fa-trash-alt"></i></button>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- modal delete -->
<div class="modal fade" id="modal_delete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form action="{{ route('barang.delete') }}" method="post">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Yakin akan dihapus?</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- delete id -->
        <input type="hidden" name="delete_id" id="delete_id">
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Ya</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('script')
<script>
  const btnDelete = document.querySelectorAll('.btn-delete');
  const deleteId = document.querySelector('#delete_id');

  btnDelete.forEach(function(item, index) {
    item.addEventListener('click', function(e) {
      e.preventDefault();
      deleteId.value = item.getAttribute('data-id');
    })
  })
</script>
@endsection