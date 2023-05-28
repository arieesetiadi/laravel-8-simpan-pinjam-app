@extends('layouts.layout')

@php
    $sidebarPegawai = 'active-page';
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
                        <h1>Pegawai</h1>
                    </div>
                    <div class="page-description-actions">
                        <a href="{{ route('halamanTambahPegawai') }}" class="btn btn-primary">
                            <i class="fa-solid fa-circle-plus"></i> Tambah Pegawai
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
                        @forelse ($pegawai as $i => $p)
                            <tr>
                                <td class="d-flex gap-3">
                                    {{-- Tombol ubah --}}
                                    <a href="{{ route('halamanUbahPegawai', $p->id_pegawai) }}" title="Ubah Pegawai">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>

                                    {{-- Tombol detail --}}
                                    <a href="{{ route('halamanDetailPegawai', $p->id_pegawai) }}" title="Detail Pegawai">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>

                                    {{-- Tombol hapus --}}
                                    @if ($p == user())
                                        <a href="#" title="Hapus Pegawai"
                                            onclick="return alert('Data pegawai yang sedang anda gunakan tidak dapat dihapus dari sistem')">
                                            <i class="fa-solid fa-trash text-danger"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('prosesHapusPegawai', $p->id_pegawai) }}" title="Hapus Pegawai"
                                            onclick="return confirm('Data pegawai akan dihapus dari sistem')">
                                            <i class="fa-solid fa-trash text-danger"></i>
                                        </a>
                                    @endif
                                </td>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $p->nama }}</td>
                                <td>{{ $p->username }}</td>
                                <td>{{ $p->no_tlp }}</td>
                                <td>{{ $p->email }}</td>
                                <td>{{ $p->jenis_kelamin }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">Data pegawai tidak tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
