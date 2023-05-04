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
                        <h1>Tim Verifikasi</h1>
                    </div>
                    <div class="page-description-actions">
                        <a href="{{ route('halamanTambahTim') }}" class="btn btn-primary">
                            <i class="fa-solid fa-circle-plus"></i> Tambah Tim Verifikasi
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
                        @forelse ($tim as $i => $t)
                            <tr>
                                <td class="d-flex gap-3">
                                    {{-- Tombol ubah --}}
                                    <a href="{{ route('halamanUbahTim', $t->id_tim) }}" title="Ubah Tim Verifikasi">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>

                                    {{-- Tombol detail --}}
                                    <a href="{{ route('halamanDetailTim', $t->id_tim) }}" title="Detail Tim Verifikasi">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>

                                    {{-- Tombol hapus --}}
                                    @if ($t == user())
                                        <a href="#" title="Hapus Tim Verifikasi" onclick="return alert('Data tim verifikasi yang sedang anda gunakan tidak dapat dihapus dari sistem')">
                                            <i class="fa-solid fa-trash text-danger"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('prosesHapusTim', $t->id_tim) }}" title="Hapus Tim Verifikasi" onclick="return confirm('Data Tim akan dihapus dari sistem')">
                                            <i class="fa-solid fa-trash text-danger"></i>
                                        </a>
                                    @endif
                                </td>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $t->nama }}</td>
                                <td>{{ $t->username }}</td>
                                <td>{{ $t->no_tlp }}</td>
                                <td>{{ $t->email }}</td>
                                <td>{{ $t->jenis_kelamin }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">Data tim verifikasi tidak tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
