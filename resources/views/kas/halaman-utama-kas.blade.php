@extends('layouts.layout')

@php
    $sidebarSimpanan = 'active-page';
    $sidebarKasSimpanan = 'fw-bold';
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
                        <h1>Kas Simpanan</h1>
                    </div>

                    {{-- Tampilkan tombol tambah hanya untuk pegawai --}}
                    @if (role('pegawai'))
                        <div class="page-description-actions">
                            <a href="{{ route('halamanTambahKasSimpanan') }}" class="btn btn-primary">
                                <i class="fa-solid fa-circle-plus"></i> Tambah Kas Simpanan
                            </a>
                        </div>
                    @endif
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
                            <th>No Tabungan</th>
                            <th>Nama Nasabah</th>
                            <th>Nominal</th>
                            <th>Tanggal Simpan</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($kas as $i => $k)
                            <tr>
                                <td class="d-flex gap-3">
                                    {{-- Tombol detail --}}
                                    <a href="{{ route('halamanDetailKasSimpanan', $k->id_tabungan) }}" title="Detail Kas Simpanan">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                </td>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $k->tabungan->no_tabungan }}</td>
                                <td>{{ $k->tabungan->nasabah->nama }}</td>
                                <td>{{ number_to_idr($k->nominal) }}</td>
                                <td>{{ human_datetime_format($k->tanggal) }} ({{ human_datetime_diff($k->tanggal) }})</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">Data Kas Simpanan tidak tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
