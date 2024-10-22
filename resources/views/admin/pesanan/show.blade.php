@extends('admin.layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Halaman Detail Pesanan</h5>
                <div class="d-flex mb-4">
                    <table class="table table-borderless">
                        <tr>
                            <td class="fw-semibold">No. Invoice</td>
                            <td>:</td>
                            <td>{{ $pesanan->no_invoice }}</td>
                        </tr>
                        <tr>
                            <td class="fw-semibold">Pelanggan</td>
                            <td>:</td>
                            <td>{{ $pesanan->pelanggan->nama }}</td>
                        </tr>
                        <tr>
                            <td class="fw-semibold">Paket</td>
                            <td>:</td>
                            <td>{{ $pesanan->paket->nama_paket }}</td>
                        </tr>
                        <tr>
                            <td class="fw-semibold">Berat (Kg) x Harga Paket</td>
                            <td>:</td>
                            <td>{{ $pesanan->berat }} x Rp {{ number_format($pesanan->paket->harga_paket, 0, ',', '.') }}
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-semibold">Total Harga</td>
                            <td>:</td>
                            <td>Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                        </tr>
                    </table>
                    <table class="table table-borderless">
                        <tr>
                            <td class="fw-semibold">Status Pesanan</td>
                            <td>:</td>
                            <td>{{ $pesanan->status }}</td>
                        </tr>
                        <tr>
                            <td class="fw-semibold">Tanggal Pesanan</td>
                            <td>:</td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal_pesanan)->format('d F Y h:i:s') }}</td>
                        </tr>
                        <tr>
                            <td class="fw-semibold">Tanggal Proses</td>
                            <td>:</td>
                            <td>{{ $pesanan->tanggal_proses ? \Carbon\Carbon::parse($item->tanggal_proses)->format('d F Y h:i:s') : 'Belum diproses' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-semibold">Tanggal Selesai</td>
                            <td>:</td>
                            <td>{{ $pesanan->tanggal_selesai ? \Carbon\Carbon::parse($item->tanggal_selesai)->format('d F Y h:i:s') : 'Belum selesai' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-semibold">Tanggal Diterima</td>
                            <td>:</td>
                            <td>{{ $pesanan->tanggal_diterima ? \Carbon\Carbon::parse($item->tanggal_diterima)->format('d F Y h:i:s') : 'Belum diterima' }}
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="d-flex">
                    <a href="{{ route('pesanan.index') }}" class="btn btn-outline-primary">Kembali</a>
                    <form action="{{ route('pesanan.update', $pesanan->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="Diterima">
                        @if ($pesanan->status == 'Selesai')
                            <button type="submit" class="btn btn-primary ms-2">Pesanan Sudah Diterima</button>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
