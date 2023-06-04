@extends('layouts.layout')

@php
    $sidebarSimpanan = 'active-page';
    $sidebarKasSimpanan = 'fw-bold';
@endphp

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="page-description">
                    <h1>Detail Kas Simpanan</h1>
                </div>
            </div>
        </div>
        <div class="row card">
            <div class="col card-body">
                <form>
                    {{-- Info no tabungan --}}
                    <div class="row mb-3">
                        <label for="no-tabungan" class="col-sm-2 col-form-label">
                            No Tabungan
                            <a href="{{ route('halamanDetailNoTabungan', $kas->tabungan->id_tabungan) }}" target="_blank">
                                Detail
                            </a>
                        </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="no-tabungan"
                                value="{{ $kas->tabungan->no_tabungan }}" disabled>
                        </div>
                    </div>

                    {{-- Info nama nasabah --}}
                    <div class="row mb-3">
                        <label for="nama" class="col-sm-2 col-form-label">
                            Nama Nasabah
                            <a href="{{ route('halamanDetailNasabah', $kas->tabungan->nasabah->id_nasabah) }}"
                                target="_blank">
                                Detail
                            </a>
                        </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama"
                                value="{{ $kas->tabungan->nasabah->nama }}" disabled>
                        </div>
                    </div>

                    <hr class="d-block my-5">

                    {{-- Info nominal --}}
                    <div class="row mb-3">
                        <label for="nominal" class="col-sm-2 col-form-label">Nominal</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nominal"
                                value="{{ number_to_idr($kas->nominal) }}" disabled>
                        </div>
                    </div>

                    {{-- Info tanggal --}}
                    <div class="row mb-3">
                        <label for="tanggal" class="col-sm-2 col-form-label">Tanggal Simpan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="tanggal"
                                value="{{ human_datetime_format($kas->tanggal) }}" disabled>
                        </div>
                    </div>

                    {{-- Tombol --}}
                    <div class="mt-5">
                        <a href="{{ route('halamanUtamaKasSimpanan') }}" class="btn btn-light">
                            <i class="fa-solid fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
