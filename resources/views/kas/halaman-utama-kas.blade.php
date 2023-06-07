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
                        <div class="page-description-actions px-2">
                            <a href="{{ route('halamanTambahKasSimpanan') }}" class="btn btn-primary">
                                <i class="fa-solid fa-circle-plus"></i> Tabung
                            </a>
                        </div>
                        <div class="page-description-actions">
                            <a href="{{ route('halamanTarikKasSimpanan') }}" class="btn btn-danger">
                                <i class="fa-solid fa-circle-minus"></i> Tarik
                            </a>
                        </div>
                    @endif
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
                            <th>No Tabungan</th>
                            <th>Nama Nasabah</th>
                            <th>Nominal</th>
                            <th>Jenis</th>
                            <th>Tanggal</th>
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
                                <td class="text-nowrap">{{ $i + 1 }}</td>
                                <td class="text-nowrap">{{ $k->tabungan->no_tabungan }}</td>
                                <td class="text-nowrap">{{ $k->tabungan->nasabah->nama }}</td>
                                <td class="text-nowrap">{{ number_to_idr($k->nominal) }}</td>
                                <td class="text-nowrap">
                                    @if ($k->jenis == 'Uang Masuk')
                                        <span class="badge badge-success">{{ $k->jenis }}</span>
                                    @else
                                        <span class="badge badge-danger">{{ $k->jenis }}</span>
                                    @endif
                                </td>
                                <td class="text-nowrap">{{ human_datetime_format($k->tanggal) }} ({{ human_datetime_diff($k->tanggal) }})</td>
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
