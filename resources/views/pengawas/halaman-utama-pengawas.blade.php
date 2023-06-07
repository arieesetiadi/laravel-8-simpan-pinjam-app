@extends('layouts.layout')

@php
    $sidebarPengawas = 'active-page';
@endphp

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
                        <h1>Pengawas</h1>
                    </div>
                    <div class="page-description-actions">
                        <a href="{{ route('halamanTambahPengawas') }}" class="btn btn-primary">
                            <i class="fa-solid fa-circle-plus"></i> Tambah Pengawas
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row card">
            <div class="col card-body table-responsive">
                <table class="table table-data">
                    <thead>
                        <tr>
                            <th>Aksi</th>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Telepon</th>
                            <th>Jenis Kelamin</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($pengawas as $i => $p)
                            <tr>
                                <td class="d-flex gap-3">
                                    {{-- Tombol ubah --}}
                                    <a href="{{ route('halamanUbahPengawas', $p->id_pengawas) }}" title="Ubah Pengawas">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>

                                    {{-- Tombol detail --}}
                                    <a href="{{ route('halamanDetailPengawas', $p->id_pengawas) }}" title="Detail Pengawas">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>

                                    {{-- Tombol hapus --}}
                                    @if ($p == user())
                                        <a href="#" title="Hapus Pengawas" onclick="return alert('Data pengawas yang sedang anda gunakan tidak dapat dihapus dari sistem')">
                                            <i class="fa-solid fa-trash text-danger"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('prosesHapusPengawas', $p->id_pengawas) }}" title="Hapus Pengawas" onclick="return confirm('Data pengawas akan dihapus dari sistem')">
                                            <i class="fa-solid fa-trash text-danger"></i>
                                        </a>
                                    @endif
                                </td>
                                <td class="text-nowrap">{{ $i + 1 }}</td>
                                <td class="text-nowrap">{{ $p->nama }}</td>
                                <td class="text-nowrap">{{ $p->username }}</td>
                                <td class="text-nowrap">{{ $p->no_tlp }}</td>
                                <td class="text-nowrap">{{ $p->jenis_kelamin }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">Data pengawas tidak tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
