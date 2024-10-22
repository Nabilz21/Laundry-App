@extends('admin.layouts.main')

@section('styles')
    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Form Tambah Pesanan</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('pesanan.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="pelanggan" class="form-label">Pelanggan</label>
                                <select class="form-select form-select-2 @error('pelanggan') is-invalid @enderror"
                                    id="pelanggan" name="pelanggan">
                                    <option value="">Pilih Pelanggan</option>
                                    @foreach ($pelanggan as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('pelanggan') == $item->id ? 'selected' : '' }}>
                                            {{ $item->nama }}</option>
                                    @endforeach
                                </select>
                                @error('pelanggan')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="paket" class="form-label">Paket</label>
                                <select class="form-select form-select-2 @error('paket') is-invalid @enderror"
                                    id="paket" name="paket" onchange="hitungTotalHarga()">
                                    <option value="">Pilih Paket</option>
                                    @foreach ($paket as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('paket') == $item->id ? 'selected' : '' }}
                                            data-harga="{{ $item->harga_paket }}">
                                            {{ $item->nama_paket }} (Rp
                                            {{ number_format($item->harga_paket, 0, ',', '.') }})</option>
                                    @endforeach
                                </select>
                                @error('paket')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="berat" class="form-label">Berat</label>
                                <input type="number" class="form-control @error('berat') is-invalid @enderror"
                                    id="berat" name="berat (Kg)" value="{{ old('berat') }}" placeholder="Berat"
                                    oninput="hitungTotalHarga()">
                                @error('berat')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="total_harga" class="form-label">Total Harga</label>
                                <input type="text" class="form-control @error('total_harga') is-invalid @enderror"
                                    id="total_harga" name="total_harga" value="{{ old('total_harga') }}"
                                    placeholder="Total Harga" readonly>
                                @error('total_harga')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <a href="{{ route('pesanan.index') }}" class="btn btn-outline-primary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        function hitungTotalHarga() {
            const berat = document.getElementById('berat').value;
            const paket = document.getElementById('paket');
            const hargaPaket = paket.options[paket.selectedIndex].getAttribute('data-harga');

            if (berat && hargaPaket) {
                const totalHarga = berat * hargaPaket;

                document.getElementById('total_harga').value = formatRupiah(totalHarga.toString());
            } else {
                document.getElementById('total_harga').value = '';
            }
        }

        function formatRupiah(angka) {
            const parameter = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            });
            return parameter.format(angka.replace(/[^0-9]/g, ''));
        }

        $(document).ready(function() {
            $('.form-select-2').select2();
        });
    </script>
@endsection
