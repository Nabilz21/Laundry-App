@extends('admin.layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Form Tambah Paket</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('paket.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="nama_paket" class="form-label">Nama Paket</label>
                                <input type="text" class="form-control @error('nama_paket') is-invalid @enderror"
                                    id="nama_paket" name="nama_paket" placeholder="Nama Paket" value="{{ old('nama_paket') }}">
                                @error('nama_paket')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="harga" class="form-label">Harga</label>
                                <input type="text" class="form-control @error('harga') is-invalid @enderror"
                                    id="harga" name="harga" aria-describedby="hargaHelp" value="{{ old('harga') }}"
                                    placeholder="Harga">
                                @error('harga')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <a href="{{ route('paket.index') }}" class="btn btn-outline-primary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    document.getElementById('harga').addEventListener('keyup', function(){
        let harga = this.value;
        this.value = formatRupiah(harga);
    });

    function formatRupiah(angka) {
            const parameter = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            });
            return parameter.format(angka.replace(/[^0-9]/g, ''));
        }
</script>
@endsection
