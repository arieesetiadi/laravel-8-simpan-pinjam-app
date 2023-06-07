@extends('layouts.layout')

@php
    $sidebarNasabah = 'active-page';
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
                        <h1>Nasabah</h1>
                    </div>
                    <div class="page-description-actions">
                        <a href="{{ route('halamanTambahNasabah') }}" class="btn btn-primary">
                            <i class="fa-solid fa-circle-plus"></i> Tambah Nasabah
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
                            <th>Tanggal Lahir</th>
                            <th>Pekerjaan</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($nasabah as $i => $n)
                            <tr>
                                <td class="d-flex gap-3">
                                    {{-- Tombol ubah --}}
                                    <a href="{{ route('halamanUbahNasabah', $n->id_nasabah) }}" title="Ubah Nasabah">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>

                                    {{-- Tombol detail --}}
                                    <a href="{{ route('halamanDetailNasabah', $n->id_nasabah) }}" title="Detail Nasabah">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>

                                    {{-- Tombol hapus --}}
                                    @if ($n == user())
                                        <a href="#" title="Hapus Nasabah" onclick="return alert('Data Nasabah yang sedang anda gunakan tidak dapat dihapus dari sistem')">
                                            <i class="fa-solid fa-trash text-danger"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('prosesHapusNasabah', $n->id_nasabah) }}" title="Hapus Nasabah" onclick="return confirm('Data Nasabah akan dihapus dari sistem')">
                                            <i class="fa-solid fa-trash text-danger"></i>
                                        </a>
                                    @endif
                                </td>
                                <td class="text-nowrap">{{ $i + 1 }}</td>
                                <td class="text-nowrap">{{ $n->nama }}</td>
                                <td class="text-nowrap">{{ $n->tanggal_lahir }}</td>
                                <td class="text-nowrap">{{ $n->pekerjaan }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">Data Nasabah tidak tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
