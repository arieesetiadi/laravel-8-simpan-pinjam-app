@extends('layouts.layout')

@php
    $sidebarNasabah = 'active-page';
@endphp

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="page-description">
                    <h1>Detail Nasabah</h1>
                </div>
            </div>
        </div>
        <div class="row card">
            <div class="col card-body">
                <form>
                    {{-- Input nama --}}
                    <div class="row mb-3">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input name="nama" type="text" class="form-control" id="nama" value="{{ $nasabah->nama }}" disabled>
                        </div>
                    </div>

                    {{-- Input pekerjaan --}}
                    <div class="row mb-3">
                        <label for="pekerjaan" class="col-sm-2 col-form-label">Pekerjaan</label>
                        <div class="col-sm-10">
                            <input name="pekerjaan" type="text" class="form-control" id="pekerjaan" value="{{ $nasabah->pekerjaan }}" disabled>
                        </div>
                    </div>

                    {{-- Input alamat --}}
                    <div class="row mb-3">
                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <textarea name="alamat" type="text" class="form-control" id="alamat" disabled>{{ $nasabah->alamat }}</textarea>
                        </div>
                    </div>

                    {{-- Input Tanggal Lahir --}}
                    <div class="row mb-3">
                        <label for="tanggal_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                        <div class="col-sm-10">
                            <input name="tanggal_lahir" type="date" class="form-control" id="tanggal_lahir" value="{{ $nasabah->tanggal_lahir }}" disabled>
                        </div>
                    </div>

                    {{-- Tombol --}}
                    <div class="mt-5">
                        <a href="{{ route('halamanUtamaNasabah') }}" class="btn btn-light">
                            <i class="fa-solid fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
