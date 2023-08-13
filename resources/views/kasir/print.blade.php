<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cetak</title>
</head>
<body>
  <div>
    <div style="text-align: center;">Toko Asmip</div>
    <div style="text-align: center;">Jl Penuh Perjuangan No 2</div>
    <div style="margin-top: 10px;">{{ $transaksi->nomor_transaksi }}</div>
    <div style="margin-bottom: 10px;">{{ $transaksi->created_at }}</div>
  </div>
  <hr>
  <div>
    <table style="width: 100%;">
      @foreach($transaksi->dataDetail as $item)
        <tr>
          <td>{{ $item->dataBarang->nama }}</td>
          <td style="text-align: center;">{{ $item->qty }}</td>
          <td style="text-align: right;">{{ rupiah($item->harga) }}</td>
        </tr>
      @endforeach
    </table>
  </div>
  <hr>
  <div style="display: flex; justify-content: space-between;">
    <div>Total</div>
    <div>{{ rupiah($transaksi->total_harga) }}</div>
  </div>
  <hr>
  <div>
    <p style="text-align: center; font-size: 12px;">Terima Kasih Sudah Belanja</p>
  </div>

  <script>
    window.print();
  </script>
</body>
</html>