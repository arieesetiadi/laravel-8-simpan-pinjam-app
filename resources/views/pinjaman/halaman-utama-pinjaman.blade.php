@extends('layouts.layout')

@php
    $sidebarPinjaman = 'active-page';
    $sidebarSubPinjaman = 'fw-bold';
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
                        <h1>Permohonan Pinjaman</h1>
                    </div>

                    {{-- Tampilkan tombol tambah hanya untuk pegawai --}}
                    @if (role('pegawai'))
                        <div class="page-description-actions px-2">
                            <a class="btn btn-primary" href="{{ route('halamanTambahPinjaman') }}">
                                <i class="fa-solid fa-circle-plus"></i> Tambah Pinjaman
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row card">
            <div class="col card-body">
                <table class="table-data table">
                    <thead>
                        <tr>
                            <th>Aksi</th>
                            <th>#</th>
                            <th>No Pinjaman</th>
                            <th>Nama Nasabah</th>
                            <th>Nominal</th>
                            <th>Jangka Waktu</th>
                            <th>Tanggal Pinjaman</th>
                            <th>Batas Pembayaran</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($pinjaman as $i => $p)
                            <tr>
                                <td class="d-flex gap-3">
                                    {{-- Tombol detail --}}
                                    <a href="{{ route('halamanDetailPinjaman', $p->id_permohonan_pinjam) }}" title="Detail Pinjaman">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                </td>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $p->noPinjaman()->no_pinjaman }}</td>
                                <td>{{ $p->noPinjaman()->nasabah()->nama }}</td>
                                <td>{{ number_to_idr($p->besar_permohonan_pinjam) }}</td>
                                <td>{{ $p->jangka_waktu }}</td>
                                <td>{{ human_datetime_format($p->tanggal) }}</td>
                                <td>{{ human_datetime_format($p->tanggal_terakhir_bayar) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">Data Pinjaman tidak tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
