@extends('admin.layouts.main')

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.7/css/dataTables.bootstrap5.css">
@endsection

@section('content')
    <h3 class="fw-semibold">Pelanggan</h3>
    <h6>Menu ini digunakan untuk menambahkan dan mengelola data pelanggan</h6>
    <div class="card mt-4">
        <div class="card-body">
            <a href="{{ route('pelanggan.create') }}" class="btn btn-primary mb-4"><i class="ti ti-plus mr-2"></i>Tambah
                Pelanggan</a>
            <div class="table-responsive">
                <table id="data-table" class="table table-striped table-borderless w-100">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Nomor Handphone</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pelanggan as $key => $item)
                            <tr class="align-middle">
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->user->nama }}</td>
                                <td>{{ $item->alamat }}</td>
                                <td>{{ $item->no_hp }}</td>
                                <td class="d-flex">
                                    <a href="{{ route('pelanggan.edit', $item->id) }}"
                                        class="text-success fs-6 text-decoration-none me-3"><i class="ti ti-edit"></i></a>
                                    <form action="{{ route('pelanggan.destroy', $item->id) }}" method="POST"
                                        id="deleteForm{{ $item->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <a class="text-danger fs-6 text-decoration-none cursor-pointer"
                                            onclick="confirmDelete('{{ $item->id }}')"><i class="ti ti-trash"></i></a>
                                    </form>
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
