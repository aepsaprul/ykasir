@extends('layouts.app')

@section('title') Dashboard @endsection

@section('content')
<div class="container-fluid px-4">
  <h3 class="my-4">Dashboard</h3>
  <div class="row">
    <div class="col-xl-3 col-md-6">
      <div class="card bg-primary text-white mb-4">
        <div class="card-body">Transaksi Hari Ini</div>
        <div class="card-footer d-flex align-items-center justify-content-between">
          {{ $totalTransaksiHariIni }}
        </div>
    </div>
    </div>
    <div class="col-xl-3 col-md-6">
      <div class="card bg-primary text-white mb-4">
        <div class="card-body">Profit Hari Ini</div>
        <div class="card-footer d-flex align-items-center justify-content-between">
          {{ rupiah($totalProfitHariIni) }}
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xl-12">
      <div class="card mb-4">
        <div class="card-header">
          <i class="fas fa-chart-bar me-1"></i>
          Profit Per Bulan
        </div>
        <div class="card-body"><canvas id="myBarChart" width="100%" height="20"></canvas></div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>

<script>
let setsData = [0,0,0,0,0,0,0,0,0,0,0,0,0];

const calcMax = function(setData) {
  const temps = setData;
  let max = temps[0];

  for (let index = 0; index < temps.length; index++) {
    const curTemp = temps[index];
    
    if (curTemp > max) max = curTemp;
  }

  return max;
}

fetch(`{{ url('dashboard/diagramProfit') }}`)
.then(function (response) {
  return response.json();
})
.then(function(response) {
  response.data.map(function (data, index) {
    const bulan = data.bulan - 1;
    setsData[bulan] = data.dataprofit;

    console.log(setsData);
  })

  updateDiagram();
})

function updateDiagram() {
  // Bar Chart Example
  var ctx = document.getElementById("myBarChart");
  var myLineChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
      datasets: [{
        label: "Revenue",
        backgroundColor: "rgba(2,117,216,1)",
        borderColor: "rgba(2,117,216,1)",
        data: setsData,
      }],
    },
    options: {
      scales: {
        xAxes: [{
          time: {
            unit: 'month'
          },
          gridLines: {
            display: false
          },
          ticks: {
            maxTicksLimit: 12
          }
        }],
        yAxes: [{
          ticks: {
            min: 0,
            max: calcMax(setsData),
            maxTicksLimit: 10
          },
          gridLines: {
            display: true
          }
        }],
      },
      legend: {
        display: false
      }
    }
  });
}
</script>
@endsection