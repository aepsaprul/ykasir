@extends('layouts.app')

@section('title') Transaksi @endsection

@section('content')
<div class="container-fluid px-4">
  <h3 class="my-4">Transaksi</h3>
  <div class="row">
    <div class="col-12">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th class="text-center">No</th>
            <th class="text-center">Tanggal</th>
            <th class="text-center">Nomor Transaksi</th>
            <th class="text-center">Total Qty</th>
            <th class="text-center">Total Harga</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach($transaksis as $key => $item)
            <tr>
              <td class="text-center">{{ $key + 1 }}</td>
              <td><a href="{{ route('transaksi.show', [$item->id]) }}" class="text-decoration-none">{{ $item->created_at->format('d/m/Y') }}</a></td>
              <td>{{ $item->nomor_transaksi }}</td>
              <td class="text-center">{{ $item->total_qty }}</td>
              <td class="text-end">{{ rupiah($item->total_harga) }}</td>
              <td class="text-center">
                <a href="{{ route('kasir.print', [$item->id]) }}" target="_blank" class="btn btn-primary btn-sm"><i class="fas fa-print"></i></a>
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