@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
        <h4 class="mb-3">Pembayaran Saya</h4>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Obat</th>
                    <th>Jumlah</th>
                    <th>Total Bayar</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transaksi as $t)
                    <tr>
                        <td>{{ $t->obat->nama_obat }}</td>
                        <td>{{ $t->jumlah }}</td>
                        <td>Rp{{ number_format($t->total_bayar,0,',','.') }}</td>
                        <td>
                            <span style="color: black;" class="badge 
                                {{ $t->status_transaksi == 'menunggu_pembayaran' ? 'bg-warning' : 
                                ($t->status_transaksi == 'selesai' ? 'bg-success' : 
                                ($t->status_transaksi == 'ditolak' ? 'bg-danger' : 'bg-secondary')) }}">
                                {{ str_replace('_',' ', $t->status_transaksi) }}
                            </span>

                        </td>
                        <td>{{ $t->tanggal_transaksi }}</td>
                        <td>
                            <button class="btn btn-sm btn-primary btn-detail"
                                data-pembeli="{{ $t->pelanggan->nama }}"
                                data-obat="{{ $t->obat->nama_obat }}"
                                data-jumlah="{{ $t->jumlah }}"
                                data-total="{{ number_format($t->total_bayar,0,',','.') }}"
                                data-status="{{ str_replace('_',' ', $t->status_transaksi) }}">
                                Detail
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">
                            Belum ada pembayaran
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Modal Detail Pembayaran -->
        <div class="modal fade" id="modalDetailPembayaran" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Detail Pembayaran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <table class="table table-borderless">
                            <tr>
                                <th>Nama Pembeli</th>
                                <td id="modalPembeli"></td>
                            </tr>
                            <tr>
                                <th>Nama Obat</th>
                                <td id="modalObat"></td>
                            </tr>
                            <tr>
                                <th>Jumlah</th>
                                <td id="modalJumlah"></td>
                            </tr>
                            <tr>
                                <th>Total Bayar</th>
                                <td><strong id="modalTotal"></strong></td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    <span style="color: black;" class="badge bg-warning" id="modalStatus"></span>
                                </td>
                            </tr>
                        </table>

                        <div class="alert alert-info text-center mt-3">
                            Silakan tunjukkan layar ini ke kasir
                        </div>
                    </div>

                </div>
            </div>
        </div>


    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {

    const modal = new bootstrap.Modal(
        document.getElementById('modalDetailPembayaran')
    );

    document.querySelectorAll('.btn-detail').forEach(btn => {
        btn.addEventListener('click', function () {

            document.getElementById('modalPembeli').innerText = this.dataset.pembeli;
            document.getElementById('modalObat').innerText    = this.dataset.obat;
            document.getElementById('modalJumlah').innerText  = this.dataset.jumlah;
            document.getElementById('modalTotal').innerText   = 'Rp' + this.dataset.total;

            // STATUS
            const modalStatus = document.getElementById('modalStatus');
            const status = this.dataset.status; // contoh: "menunggu pembayaran"

            modalStatus.innerText = status;

            // reset dulu class badge
            modalStatus.className = 'badge';

            // set class sesuai status
            if (status == 'menunggu pembayaran') {
                modalStatus.classList.add('bg-warning');
                modalStatus.style.color = 'black';
            } else if (status == 'selesai') {
                modalStatus.classList.add('bg-success');
                modalStatus.style.color = 'white';
            } else if (status == 'ditolak') {
                modalStatus.classList.add('bg-danger');
                modalStatus.style.color = 'white';
            } else {
                modalStatus.classList.add('bg-secondary');
                modalStatus.style.color = 'white';
            }

            modal.show();
        });
    });

});
</script>
@endsection
