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
            <div class="col card-body table-responsive">
                <table class="table-data table">
                    <thead>
                        <tr>
                            <th class="text-nowrap">Aksi</th>
                            <th class="text-nowrap">#</th>
                            <th class="text-nowrap">No Pinjaman</th>
                            <th class="text-nowrap">Nama Nasabah</th>
                            <th class="text-nowrap">Nominal</th>
                            <th class="text-nowrap">Jangka Waktu</th>
                            <th class="text-nowrap">Status</th>
                            <th class="text-nowrap">Tanggal Pinjaman</th>
                            <th class="text-nowrap">Batas Pembayaran</th>
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

                                    {{-- Tombol verifikasi direktur --}}
                                    @if (!$p->status && role('direktur'))
                                        <a href="{{ route('prosesVerifikasiPinjaman', $p->id_permohonan_pinjam) }}" title="Verifikasi Pinjaman" onclick="return confirm('Verfikasi pinjaman dari nasabah')">
                                            <i class="fa-solid fa-check text-success"></i>
                                        </a>
                                    @endif
                                </td>
                                <td class="text-nowrap">{{ $i + 1 }}</td>
                                <td class="text-nowrap">{{ $p->noPinjaman->no_pinjaman }}</td>
                                <td class="text-nowrap">{{ $p->noPinjaman->nasabah->nama }}</td>
                                <td class="text-nowrap">{{ number_to_idr($p->besar_permohonan_pinjam) }}</td>
                                <td class="text-nowrap">{{ $p->jangka_waktu }} Bulan</td>
                                <td>
                                    @if ($p->status == true)
                                        <span class="badge badge-success d-blok w-100">Verified</span>
                                    @else
                                        <span class="badge badge-danger d-blok w-100">Unverified</span>
                                    @endif
                                </td>
                                <td class="text-nowrap">{{ human_date_format($p->tanggal) }}</td>
                                <td class="text-nowrap">{{ human_date_format($p->tanggal_terakhir_bayar) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9">Data Pinjaman tidak tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
