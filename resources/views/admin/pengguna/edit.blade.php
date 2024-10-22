@extends('admin.layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Form Edit Pengguna</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('pengguna.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    id="nama" name="nama" placeholder="Nama" value="{{ old('nama', $user->nama) }}">
                                @error('nama')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" aria-describedby="emailHelp"
                                    value="{{ old('email', $user->email) }}" placeholder="example@gmail.com">
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password (Diisi jika perlu diubah)</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" placeholder="Password">
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="level" class="form-label">Level</label>
                                <select type="password" class="form-select @error('level') is-invalid @enderror"
                                    id="level" name="level">
                                    <option value="">Pilih Level</option>
                                    @foreach ($level as $item)
                                        <option value="{{ $item }}"
                                            {{ old('level', $user->level) == $item ? 'selected' : '' }}>
                                            {{ $item }}</option>
                                    @endforeach
                                </select>
                                @error('level')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <a href="{{ route('pengguna.index') }}" class="btn btn-outline-primary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
