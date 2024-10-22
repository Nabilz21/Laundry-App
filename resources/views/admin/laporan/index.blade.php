@extends('admin.layouts.main')

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.7/css/dataTables.bootstrap5.css">
@endsection

@section('content')
    <h3 class="fw-semibold">Laporan</h3>
    <h6>Menu ini digunakan untuk melihat dan mencetak laporan</h6>
    <div class="card mt-4">
        <div class="card-body">
            <button type="button" class="btn btn-secondary me-2 mb-4" data-bs-toggle="modal" data-bs-target="#tanggalModal"><i
                    class="ti ti-calendar me-1"></i>Pilih Tanggal</button>
            <a href="{{route('laporan.exportPDF')}}" class="btn btn-danger me-2 mb-4">Export PDF</a>
            <div class="btn-group">
                <button type="button" class="btn btn-secondary dropdown-toggle mb-4" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Filter
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('laporan', ['filter' => 'semua']) }}">Semua</a></li>
                    <li><a class="dropdown-item" href="{{ route('laporan', ['filter' => 'hari_ini']) }}">Hari ini</a></li>
                    <li><a class="dropdown-item" href="{{ route('laporan', ['filter' => 'minggu_ini']) }}">Minggu ini</a></li>
                    <li><a class="dropdown-item" href="{{ route('laporan', ['filter' => 'bulan_ini']) }}">Bulan ini</a></li>
                    <li><a class="dropdown-item" href="{{ route('laporan', ['filter' => 'tahun_ini']) }}">Tahun ini</a></li>
                </ul>
            </div>

            <div class="table-responsive">
                <table id="data-table" class="table table-striped table-borderless w-100">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Invoice</th>
                            <th>Pelanggan</th>
                            <th>Alamat</th>
                            <th>No Hp</th>
                            <th>Paket</th>
                            <th>Harga</th>
                            <th>Berat</th>
                            <th>Total Harga</th>
                            <th>Tanggal Pesanan</th>
                            <th>Tanggal Diproses</th>
                            <th>Tanggal Selesai</th>
                            <th>Tanggal Diterima</th>
                            <th>Status</th>
                            <th>Creator</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($laporan as $key => $item)
                            <tr class="align-middle">
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->no_invoice }}</td>
                                <td>{{ $item->pelanggan->nama }}</td>
                                <td>{{ $item->pelangganAsli->alamat }}</td>
                                <td>{{ $item->pelangganAsli->no_hp }}</td>
                                <td>{{ $item->paket->nama_paket }}</td>
                                <td>Rp {{ number_format($item->paket->harga_paket, 0, ',', '.') }}</td>
                                <td>{{ $item->berat }} Kg</td>
                                <td>Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal_pesanan)->format('d F Y h:i:s') }}</td>
                                <td>{{ $item->tanggal_proses ? \Carbon\Carbon::parse($item->tanggal_proses)->format('d F Y h:i:s') : 'Belum diproses' }}</td>
                                <td>{{ $item->tanggal_selesai ? \Carbon\Carbon::parse($item->tanggal_selesai)->format('d F Y h:i:s') : 'Belum selesai' }}</td>
                                <td>{{ $item->tanggal_diterima ? \Carbon\Carbon::parse($item->tanggal_diterima)->format('d F Y h:i:s') : 'Belum diterima' }}</td>
                                <td>
                                    @if ($item->status == 'Pending')
                                        <span class="badge bg-warning text-white p-2">{{ $item->status }}</span>
                                    @elseif ($item->status == 'Diproses')
                                        <span class="badge bg-info text-white p-2">{{ $item->status }}</span>
                                    @elseif ($item->status == 'Selesai')
                                        <span class="badge bg-secondary text-white p-2">{{ $item->status }}</span>
                                    @elseif ($item->status == 'Diterima')
                                        <span class="badge bg-success text-white p-2">{{ $item->status }}</span>
                                    @endif
                                </td>
                                <td>{{ $item->creator->nama }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/2.1.7/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.7/js/dataTables.bootstrap5.js"></script>
    <script>
        // DataTable
        $(document).ready(function() {
            $('#data-table').DataTable();
        });
    </script>
@endsection
