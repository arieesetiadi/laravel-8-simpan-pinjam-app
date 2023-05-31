@extends('layouts.layout')

@php
    $sidebarSimpanan = 'active-page';
    $sidebarNoTabungan = 'fw-bold';
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
                        <h1>No Tabungan</h1>
                    </div>

                    {{-- Tampilkan tombol tambah hanya untuk pegawai --}}
                    @if (role('pegawai'))
                        <div class="page-description-actions">
                            <a href="{{ route('halamanTambahNoTabungan') }}" class="btn btn-primary">
                                <i class="fa-solid fa-circle-plus"></i> Tambah No Tabungan
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
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($noTabungan as $i => $n)
                            <tr>
                                <td class="d-flex gap-3">
                                    {{-- Tombol detail --}}
                                    <a href="{{ route('halamanDetailNoTabungan', $n->id_tabungan) }}" title="Detail No Tabungan">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>

                                    @if (role('pegawai'))
                                        {{-- Tombol hapus --}}
                                        <a href="{{ route('prosesHapusNoTabungan', $n->id_tabungan) }}" title="Hapus No Tabungan" onclick="return confirm('Data No Tabungan akan dihapus dari sistem')">
                                            <i class="fa-solid fa-trash text-danger"></i>
                                        </a>
                                    @endif
                                </td>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $n->no_tabungan }}</td>
                                <td>{{ $n->nasabah->nama }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">Data No Tabungan tidak tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
