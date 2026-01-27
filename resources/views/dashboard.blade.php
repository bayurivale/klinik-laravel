@extends('layouts.app')
@section('content')
<div class="page-header">
    <h3 class="page-title">
    <span class="page-title-icon bg-gradient-primary text-white me-2">
        <i class="mdi mdi-home"></i>
    </span> Dashboard
    </h3>
    <nav aria-label="breadcrumb">
    <ul class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">
        <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
        </li>
    </ul>
    </nav>
</div>
<div class="row">
    <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-danger card-img-holder text-white">
            <div class="card-body">
                <h4 class="font-weight-normal mb-3">
                    Total Obat <i class="mdi mdi-pill mdi-24px float-end"></i>
                </h4>
                <h2 class="mb-5">{{ $totalObat }}</h2>
                <h6 class="card-text">Obat tersedia</h6>
            </div>
        </div>
    </div>

    <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-info card-img-holder text-white">
            <div class="card-body">
                <h4 class="font-weight-normal mb-3">
                    Menunggu Pembayaran <i class="mdi mdi-wallet mdi-24px float-end"></i>
                </h4>
                <h2 class="mb-5">{{ $menungguPembayaran }}</h2>
                <h6 class="card-text">Perlu pembayaran</h6>
            </div>
        </div>
    </div>
</div>

<div class="card mb-5">
  <div class="card-body">
    <div class="row">

      <!-- ====== TABEL TRANSAKSI ====== -->
      <div class="col-md-8">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h4 class="card-title mb-0">Transaksi Terbaru</h4>
          <span class="text-muted">Menampilkan 5 data terbaru</span>
        </div>

        <div class="table-responsive">
          <table class="table table-hover table-borderless">
            <thead class="bg-light">
              <tr>
                <th>Pelanggan</th>
                <th>Obat</th>
                <th>Jumlah</th>
                <th>Total Bayar</th>
                <th>Status</th>
                <th>Tanggal</th>
              </tr>
            </thead>
            <tbody>
              @foreach($recentTransaksi as $t)
                <tr>
                  <td>{{ $t->pelanggan->nama }}</td>
                  <td>{{ $t->obat->nama_obat }}</td>
                  <td>{{ $t->jumlah }}</td>
                  <td>Rp {{ number_format($t->total_bayar,0,',','.') }}</td>

                  <td>
                    @php
                      $status = $t->status_transaksi;
                      $badge = 'badge-gradient-secondary';
                      if ($status == 'selesai') $badge = 'badge-gradient-success';
                      elseif ($status == 'menunggu_pembayaran') $badge = 'badge-gradient-danger';
                      elseif ($status == 'menunggu_verifikasi') $badge = 'badge-gradient-warning';
                      elseif ($status == 'ditolak') $badge = 'badge-gradient-danger';
                    @endphp

                    <label class="badge {{ $badge }}">
                      {{ strtoupper(str_replace('_', ' ', $status)) }}
                    </label>
                  </td>

                  <td>{{ \Carbon\Carbon::parse($t->tanggal_transaksi)->format('d M Y') }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

      <!-- ====== CHART ====== -->
      <div class="col-md-4">
        <div class="card shadow-sm">
          <div class="card-body">
            <h4 class="card-title mb-3">Status Transaksi</h4>
            <div class="chart-container" style="height: 260px;">
              <canvas id="statusChart"></canvas>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const statusData = @json($statusCounts);
  const bulanData = @json($transaksiPerBulan);

  const ctx1 = document.getElementById('statusChart').getContext('2d');
  new Chart(ctx1, {
    type: 'doughnut',
    data: {
      labels: Object.keys(statusData),
      datasets: [{
        data: Object.values(statusData),
      }]
    }
  });
</script>
@endsection