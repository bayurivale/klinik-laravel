@extends('layouts.app')
@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="head d-flex justify-content-between align-items-center mb-4">
                <h4 class="card-title">List Obat</h4>
            </div>
            <div class="row">

                @forelse ($obat as $p)
                    <div class="col-6 col-md-4 col-lg-3 mb-4">
                        <div class="card h-100 shadow-sm position-relative">
                            <span class="badge bg-primary position-absolute top-0 start-0 m-2">
                                Penjualan Terbaik
                            </span>
                            <img src="{{ asset('storage/obat/'.$p->foto) }}"
                                alt="Obat"
                                class="card-img-top obat-img">

                            <div class="card-body text-center">
                                <h6 class="card-title mb-1">{{ $p->nama_obat }}</h6>
                                <h6 class="text-mute mb-1">{{ $p->kategori_obat }}</h6>
                                <p class="text-muted mb-2">Rp{{ number_format($p->harga_obat, 0, ',', '.') }}</p>
                                <div class="input-group input-group-sm justify-content-center">
                                    <button class="btn btn-outline-secondary btn-minus" type="button">−</button>
                                    <input type="text"
                                        class="form-control text-center qty-input"
                                        value="1"
                                        readonly
                                        style="max-width:60px;">
                                    <button class="btn btn-outline-secondary btn-plus" type="button">+</button>
                                </div>
                                <button class="btn btn-primary btn-sm mt-3 w-160 btn-beli"
                                    data-id="{{ $p->id }}"
                                    data-nama="{{ $p->nama_obat }}"
                                    data-harga="{{ $p->harga_obat }}"
                                    data-stok="{{ $p->stok_obat }}">
                                    beli
                                </button>

                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info">
                            Data obat tidak tersedia.
                        </div>
                @endforelse

                <!-- Modal Beli Obat -->
                <div class="modal fade" id="modalBeli" tabindex="-1">
                    <div class="modal-dialog">
                        <form action="{{ route('pelanggan.obat.beli') }}" method="POST" class="modal-content">
                            @csrf

                            <div class="modal-header">
                                <h5 class="modal-title">Beli Obat</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">
                                <input type="hidden" name="obat_id" id="obat_id">

                                <div class="mb-2">
                                    <label>Nama Obat</label>
                                    <input type="text" id="nama_obat" class="form-control" readonly>
                                </div>

                                <div class="mb-2">
                                    <label>Harga Satuan</label>
                                    <input type="text" id="harga_obat" class="form-control" readonly>
                                </div>

                                <div class="mb-2">
                                    <label>Jumlah</label>
                                    <input type="number"
                                        name="jumlah"
                                        id="jumlah"
                                        class="form-control"
                                        value="1"
                                        min="1">
                                </div>

                                <div class="mb-2">
                                    <label>Total Bayar</label>
                                    <input type="text" id="total_bayar" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">
                                    Konfirmasi Beli
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('click', function (e) {

    // tombol +
    if (e.target.classList.contains('btn-plus')) {
        let input = e.target.closest('.input-group').querySelector('.qty-input');
        input.value = parseInt(input.value) + 1;
    }

    // tombol -
    if (e.target.classList.contains('btn-minus')) {
        let input = e.target.closest('.input-group').querySelector('.qty-input');
        let value = parseInt(input.value);

        if (value > 1) {
            input.value = value - 1;
        }
    }

});

document.addEventListener('DOMContentLoaded', function () {
    const modal = new bootstrap.Modal(document.getElementById('modalBeli'));

    document.querySelectorAll('.btn-beli').forEach(btn => {
        btn.addEventListener('click', function () {

        const card = this.closest('.card');

        // ambil qty dari card
        const qtyCard = parseInt(card.querySelector('.qty-input').value);

        const id    = this.dataset.id;
        const nama  = this.dataset.nama;
        const harga = parseInt(this.dataset.harga);
        const stok  = parseInt(this.dataset.stok);

        document.getElementById('obat_id').value = id;
        document.getElementById('nama_obat').value = nama;
        document.getElementById('harga_obat').value =
            'Rp' + harga.toLocaleString('id-ID');

        const jumlahInput = document.getElementById('jumlah');
        jumlahInput.value = qtyCard; // ✅ PAKAI QTY DARI CARD
        jumlahInput.max = stok;

        const totalInput = document.getElementById('total_bayar');
        totalInput.value =
            'Rp' + (qtyCard * harga).toLocaleString('id-ID');

        jumlahInput.oninput = function () {
            if (this.value > stok) {
                this.value = stok;
            }

            let total = this.value * harga;
            totalInput.value =
                'Rp' + total.toLocaleString('id-ID');
        };

        modal.show();
    });

    });
});
</script>
@endsection
