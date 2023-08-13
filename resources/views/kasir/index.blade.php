@extends('layouts.app')

@section('title') Dashboard @endsection

@section('content')
<div class="container-fluid px-4">
  <h3 class="mt-4">Kasir</h3>
  <div class="row">
    <div class="col-4">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center mb-2">
            <div style="width: 40%;">No Transaksi</div>
            <div style="width: 60%;"><input type="text" name="nomor_transaksi" id="nomor_transaksi" class="form-control form-control-sm bg-light" value="{{ $nomor_transaksi }}" readonly></div>
          </div>
          <div class="d-flex justify-content-between align-items-center mb-5">
            <div style="width: 40%;">Tanggal</div>
            <div style="width: 60%;"><input type="text" name="tanggal" id="tanggal" class="form-control form-control-sm bg-light" value="{{ date('d-m-Y') }}" readonly></div>
          </div>
          <div class="d-flex justify-content-between align-items-center mb-2">
            <div style="width: 40%;">Barang</div>
            <div style="width: 60%;">
              <select name="barang" id="barang" class="form-select form-select-sm">
                <option value="0">Pilih Barang</option>
                @foreach($barangs as $item)
                  <option value="{{ $item->id }}">{{ $item->nama }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="d-flex justify-content-between align-items-center mb-2">
            <div style="width: 40%;">Harga</div>
            <div style="width: 60%;"><input type="text" name="harga" id="harga" class="form-control form-control-sm bg-light" readonly></div>
          </div>
          <div class="d-flex justify-content-between align-items-center mb-2">
            <div style="width: 40%;">Qty</div>
            <div style="width: 60%;"><input type="text" name="qty" id="qty" class="form-control form-control-sm"></div>
          </div>
          <div class="d-flex justify-content-between align-items-center mb-2">
            <div style="width: 40%;">Jumlah</div>
            <div style="width: 60%;"><input type="text" name="jumlah" id="jumlah" class="form-control form-control-sm bg-light" readonly></div>
          </div>
          <div class="text-end mt-5">
            <button class="btn btn-sm btn-primary btn-tambah" style="width: 130px;">Tambah</button>
          </div>
        </div>
      </div>
    </div>
    <div class="col-8">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between mb-3">
            <div>
              <button id="btnSimpan" class="btn btn-sm btn-primary" style="width: 130px;">Simpan</button>
              <button id="btnSimpanLoading" class="btn btn-primary btn-sm d-none" type="button" disabled style="width: 130px;">
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                <span class="visually-hidden">Loading...</span>
              </button>
              <button id="btnBatal" class="btn btn-sm btn-danger" style="width: 130px;" data-bs-toggle="modal" data-bs-target="#modal_batal">Batal</button>
            </div>
            <div>
              <div class="d-flex justify-content-between align-items-center mb-2">
                <div class="me-4">Total</div>
                <div><input type="text" name="total" id="total" class="form-control form-control-sm text-end" value="0"></div>
              </div>
              <div class="d-flex justify-content-between align-items-center mb-2">
                <div class="me-4">Bayar</div>
                <div><input type="text" name="bayar" id="bayar" class="form-control form-control-sm text-end"></div>
              </div>
              <div class="d-flex justify-content-between align-items-center mb-2">
                <div class="me-4">Kembalian</div>
                <div><input type="text" name="kembalian" id="kembalian" class="form-control form-control-sm text-end"></div>
              </div>
            </div>
          </div>
          <div>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th class="text-center">No</th>
                  <th class="text-center">Barang</th>
                  <th class="text-center">Harga</th>
                  <th class="text-center">Qty</th>
                  <th class="text-center">Jumlah</th>
                  <th class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody class="table-body"></tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- modal batal -->
<div class="modal fade" id="modal_batal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Yakin akan batal?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnBatalModal" class="btn btn-primary">Ya</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script>
  const nomorTransaksi = document.getElementById('nomor_transaksi');
  const barang = document.getElementById('barang');
  const harga = document.getElementById('harga');
  const qty = document.getElementById('qty');
  const jumlah = document.getElementById('jumlah');
  let namaBarang, btnHapus, totalQty, totalQtyArr = [], tabel = [];
  const tableBody = document.querySelector('.table-body');
  const total = document.getElementById('total');
  const btnTambah = document.querySelector('.btn-tambah');
  const btnSimpan = document.getElementById('btnSimpan');
  const btnSimpanLoading = document.getElementById('btnSimpanLoading');
  const btnBatalModal = document.getElementById('btnBatalModal');
  const bayar = document.getElementById('bayar');
  const kembalian = document.getElementById('kembalian')

  function loadTable() {
    let val = ``;
    tabel.forEach(function(item, index) {
      val += `
        <tr>
          <td class="text-center">${index + 1}</td>
          <td>${item.namaBarang}</td>
          <td class="text-end">${item.harga}</td>
          <td class="text-center">${item.qty}</td>
          <td class="text-end">${item.jumlah}</td>
          <td class="text-center">
            <button class="btn btn-sm btn-danger btn-hapus" data-id="${index}">
              <i class="fas fa-trash-alt"></i>
            </button>
          </td>
        </tr>
      `;
    });
    tableBody.insertAdjacentHTML('beforeEnd', val);

    btnHapus = document.querySelectorAll('.btn-hapus');
    hapus()
  }

  // barang onchange
  barang.addEventListener('change', function() {
    fetch(`{{ url('kasir/${Number(this.value)}/dataBarang') }}`)
    .then(function (response) {
      return response.json();
    })
    .then(function(response) {
      harga.value = rupiahJs(response.barang.harga_jual);
      namaBarang = response.barang.nama;
    })
  })

  // qty
  qty.addEventListener('keypress', function(e) {
    if (e.keyCode === 13) {
      const hargaVal = Number(harga.value.replace(/[^,\d]/g, ""));
      const calJumlah = hargaVal * qty.value;
      jumlah.value = rupiahJs(calJumlah);
    }
  })

  // btn tambah
  btnTambah.addEventListener('click', function (e) {
    e.preventDefault();
    tableBody.innerHTML = "";
    
    formData = {
      barangId: barang.value,
      namaBarang: namaBarang,
      harga: harga.value,
      qty: qty.value,
      jumlah: jumlah.value
    }
    tabel.push(formData);
    totalQtyArr.push(qty.value);
    
    const calcTotal = Number(total.value.replace(/[^,\d]/g, "")) + Number(jumlah.value.replace(/[^,\d]/g, ""));
    total.value = rupiahJs(calcTotal);

    barang.value = 0;
    harga.value = "";
    qty.value = "";
    jumlah.value = "";

    loadTable();
    const totalQtyInitial = 0;
    totalQty = totalQtyArr.reduce((accumulator, currentValue) => Number(accumulator) + Number(currentValue), totalQtyInitial);
  })

  // btn hapus
  function hapus() {
    btnHapus.forEach(function (item, index) {
      item.addEventListener('click', function (e) {
        e.preventDefault();
        tableBody.innerHTML = "";
        const dataId = this.getAttribute('data-id');
        const tabelJumlah = tabel[dataId].jumlah.replace(/[^,\d]/g, "");
        const calcTotal = Number(total.value.replace(/[^,\d]/g, "")) - Number(tabelJumlah);
        total.value = rupiahJs(calcTotal);
        tabel.splice(dataId, 1);
        loadTable();
      })
    })
  }

  // bayar
  bayar.addEventListener('keyup', function () {
    bayar.value = rupiahJsKeyup(this.value, "");
  })
  bayar.addEventListener('keypress', function (e) {
    if (e.keyCode === 13) {
      const bayarVal = bayar.value.replace(/[^,\d]/g, "");
      const totalVal = total.value.replace(/[^,\d]/g, "");
      calcKembalian = Number(bayarVal) - Number(totalVal);
      kembalian.value = rupiahJs(calcKembalian);
    }
  })

  // btn simpan
  btnSimpan.addEventListener('click', function(e) {
    e.preventDefault();

    btnSimpan.classList.add('d-none');
    btnSimpanLoading.classList.remove('d-none');

    const formData = {
      nomorTransaksi: nomorTransaksi.value,
      totalHarga: total.value.replace(/[^,\d]/g, ""),
      totalQty: totalQty,
      tabel: JSON.stringify(tabel)
    }
    
    fetch("{{ URL::route('kasir.transaksi') }}", {
      method: "post",
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
        "X-CSRF-Token": document.querySelector('input[name=_token]').value
      },

      //make sure to serialize your JSON body
      body: JSON.stringify(formData)
    })
    .then(function (response) {
      return response.json();
    })
    .then(function(response) {
      setTimeout(() => {
        window.open(`{{ url('kasir/${response.id}/print') }}`, "_blank")
        window.location.reload();
      }, 1000);
    })
    .catch(function (err) {
      btnSimpan.classList.remove('d-none');
      btnSimpanLoading.classList.add('d-none');
      console.log('error', err);
    });
  })

  // btn batal
  btnBatalModal.addEventListener('click', function (e) {
    window.location.reload();
  })
</script>
@endsection