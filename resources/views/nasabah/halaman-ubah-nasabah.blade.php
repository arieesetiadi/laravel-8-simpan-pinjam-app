@extends('layouts.layout')

@php
    $sidebarNasabah = 'active-page';
@endphp

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="page-description">
                    <h1>Ubah Nasabah</h1>
                </div>
            </div>
        </div>
        <div class="row card">
            <div class="col card-body">
                <form action="{{ route('prosesUbahNasabah', $nasabah->id_nasabah) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Input nama --}}
                    <div class="row mb-3">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input id="nama" name="nama" type="text" class="form-control"
                                value="{{ $nasabah->nama }}" required>
                        </div>
                    </div>

                    {{-- Input pekerjaan --}}
                    <div class="row mb-3">
                        <label for="pekerjaan" class="col-sm-2 col-form-label">Pekerjaan</label>
                        <div class="col-sm-10">
                            <input id="pekerjaan" name="pekerjaan" type="text" class="form-control"
                                value="{{ $nasabah->pekerjaan }}" required>
                        </div>
                    </div>

                    {{-- Input alamat --}}
                    <div class="row mb-3">
                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <textarea id="alamat" name="alamat" type="text" class="form-control" required>{{ $nasabah->alamat }}</textarea>
                        </div>
                    </div>

                    {{-- Input nomor ktp --}}
                    <div class="row mb-3">
                        <label for="no_ktp" class="col-sm-2 col-form-label">Nomor KTP</label>
                        <div class="col-sm-10">
                            <input id="no_ktp" name="no_ktp" type="number" class="form-control"
                                value="{{ $nasabah->no_ktp }}" required>
                        </div>
                    </div>

                    {{-- Input Tanggal Lahir --}}
                    <div class="row mb-3">
                        <label for="tanggal_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                        <div class="col-sm-10">
                            <input id="tanggal_lahir" name="tanggal_lahir" type="date" class="form-control"
                                value="{{ $nasabah->tanggal_lahir }}" required>
                        </div>
                    </div>

                    {{-- Tombol --}}
                    <div class="mt-5">
                        <a href="{{ route('halamanUtamaNasabah') }}" class="btn btn-light">
                            <i class="fa-solid fa-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary mx-2">
                            <i class="fa-solid fa-circle-check"></i> Ubah
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
