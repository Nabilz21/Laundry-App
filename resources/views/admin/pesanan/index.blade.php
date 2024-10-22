@extends('admin.layouts.main')

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.7/css/dataTables.bootstrap5.css">
@endsection

@section('content')
    <h3 class="fw-semibold">Pesanan</h3>
    <h6>Menu ini digunakan untuk mencatat dan mengelola data pesanan</h6>
    <div class="card mt-4">
        <div class="card-body">
            <a href="{{ route('pesanan.create') }}" class="btn btn-primary mb-4"><i class="ti ti-plus mr-2"></i>Tambah
                Pesanan</a>
            <div class="table-responsive">
                <table id="data-table" class="table table-striped table-borderless w-100">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Invoice</th>
                            <th>Pelanggan</th>
                            <th>Paket</th>
                            <th>Harga</th>
                            <th>Berat</th>
                            <th>Total Harga</th>
                            <th>Tanggal Pesanan</th>
                            <th>Status</th>
                            <th>Creator</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pesanan as $key => $item)
                            <tr class="align-middle">
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->no_invoice }}</td>
                                <td>{{ $item->pelanggan->nama }}</td>
                                <td>{{ $item->paket->nama_paket }}</td>
                                <td>Rp {{ number_format($item->paket->harga_paket, 0, ',', '.') }}</td>
                                <td>{{ $item->berat }} Kg</td>
                                <td>Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal_pesanan)->format('d F Y h:i:s') }}</td>
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
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('pesanan.show', $item->id) }}"
                                            class="text-success fs-6 text-decoration-none me-3"><i
                                                class="ti ti-eye"></i></a>
                                        @if (auth()->user()->level == 'Admin')
                                            <a href="{{ route('pesanan.nota', $item->id) }}"
                                                class="text-success fs-6 text-decoration-none me-3"><i
                                                    class="ti ti-file"></i></a>
                                            <a href="{{ route('pesanan.edit', $item->id) }}"
                                                class="text-success fs-6 text-decoration-none me-3"><i
                                                    class="ti ti-edit"></i></a>
                                            <form action="{{ route('pesanan.destroy', $item->id) }}" method="POST"
                                                id="deleteForm{{ $item->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <a class="text-danger fs-6 text-decoration-none cursor-pointer"
                                                    onclick="confirmDelete('{{ $item->id }}')"><i
                                                        class="ti ti-trash"></i></a>
                                            </form>
                                        @endif
                                    </div>
                                </td>
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
        function confirmDelete(e) {
            swal({
                    title: "Apakah anda yakin?",
                    text: "Data yang di hapus tidak dapat dikembalikan!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $('#deleteForm' + e).submit();
                    } else {
                        swal("Data batal di hapus", {
                            icon: "error",
                        });
                    }
                });
        }
        $(document).ready(function() {
            $('#data-table').DataTable();
        });
    </script>
    <script>
        @if (session('status'))
            swal('{{ session('title') }}', '{{ session('message') }}', '{{ session('status') }}');
        @endif
    </script>
@endsection
