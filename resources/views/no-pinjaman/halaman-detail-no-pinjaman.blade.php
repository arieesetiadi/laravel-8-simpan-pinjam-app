@extends('layouts.layout')

@php
    $sidebarPinjaman = 'active-page';
    $sidebarNoPinjaman = 'fw-bold';
@endphp

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="page-description">
                    <h1>Detail No Pinjaman</h1>
                </div>
            </div>
        </div>
        <div class="row card">
            <div class="col card-body">
                <form>
                    {{-- Info no pinjaman --}}
                    <div class="row mb-3">
                        <label for="no-pinjaman" class="col-sm-2 col-form-label">No Pinjaman</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="no-pinjaman"
                                value="{{ $noPinjaman->no_pinjaman }}" disabled>
                        </div>
                    </div>

                    {{-- Info nama nasabah --}}
                    <div class="row mb-3">
                        <label for="nama" class="col-sm-2 col-form-label">Nama Nasabah</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama"
                                value="{{ $noPinjaman->nasabah->nama }}" disabled>
                        </div>
                    </div>

                    <hr class="d-block my-5">

                    {{-- Tombol --}}
                    <div class="mt-5">
                        <a href="{{ route('halamanUtamaNoTabungan') }}" class="btn btn-light">
                            <i class="fa-solid fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
