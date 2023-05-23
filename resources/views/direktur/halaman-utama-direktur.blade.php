@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                {{-- Tampilkan jika ada pesan sukses --}}
                @if (session('success'))
                    <div class="alert alert-success" role="alert">{{ session('success') }}</div>
                @endif
            </div>
            <div class="col-12">
                <div class="page-description d-flex">
                    <div class="page-description-content flex-grow-1">
                        <h1>Direktur</h1>
                    </div>
                    <div class="page-description-actions">
                        <a href="{{ route('halamanTambahDirektur') }}" class="btn btn-primary">
                            <i class="fa-solid fa-circle-plus"></i> Tambah Direktur
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row card">
            <div class="col card-body">
                <table class="table table-data">
                    <thead>
                        <tr>
                            <th>Aksi</th>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Telepon</th>
                            <th>Email</th>
                            <th>Jenis Kelamin</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($direktur as $i => $d)
                            <tr>
                                <td class="d-flex gap-3">
                                    {{-- Tombol ubah --}}
                                    <a href="{{ route('halamanUbahDirektur', $d->id_direktur) }}" title="Ubah Direktur">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>

                                    {{-- Tombol detail --}}
                                    <a href="{{ route('halamanDetailDirektur', $d->id_direktur) }}" title="Detail Direktur">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>

                                    {{-- Tombol hapus --}}
                                    @if ($d == user())
                                        <a href="#" title="Hapus Direktur" onclick="return alert('Data Direktur yang sedang anda gunakan tidak dapat dihapus dari sistem')">
                                            <i class="fa-solid fa-trash text-danger"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('prosesHapusDirektur', $d->id_direktur) }}" title="Hapus Direktur" onclick="return confirm('Data Direktur akan dihapus dari sistem')">
                                            <i class="fa-solid fa-trash text-danger"></i>
                                        </a>
                                    @endif
                                </td>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $d->nama }}</td>
                                <td>{{ $d->username }}</td>
                                <td>{{ $d->no_tlp }}</td>
                                <td>{{ $d->email }}</td>
                                <td>{{ $d->jenis_kelamin }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">Data Direktur tidak tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
