@extends('layouts.layout')

@php
    $sidebarSimpanan = 'active-page';
    $sidebarNoTabungan = 'fw-bold';
@endphp

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="page-description">
                    <h1>No Tabungan</h1>
                </div>
            </div>
        </div>
        <div class="row card">
            <div class="col card-body">
                <form>
                    {{-- Info no tabungan --}}
                    <div class="row mb-3">
                        <label for="no-tabungan" class="col-sm-2 col-form-label">No Tabungan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="no-tabungan" value="{{ $noTabungan->no_tabungan }}" disabled>
                        </div>
                    </div>

                    {{-- Info nama nasabah --}}
                    <div class="row mb-3">
                        <label for="nama" class="col-sm-2 col-form-label">Nama Nasabah</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" value="{{ $noTabungan->nasabah->nama }}" disabled>
                        </div>
                    </div>

                    <hr class="d-block my-5">

                    {{-- Info total kas --}}
                    <div class="row mb-3">
                        <label for="total-kas" class="col-sm-2 col-form-label">Total Kas</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="total-kas" value="{{ number_to_idr($noTabungan->kas()->sum('nominal')) }}" disabled>
                        </div>
                    </div>

                    {{-- Info riwayat tabungan --}}
                    @if ($noTabungan->kas)
                        <div class="row mb-3">
                            <label for="total-kas" class="col-sm-2 col-form-label">Riwayat Simpanan</label>
                            <div class="col-sm-10">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nominal</th>
                                            <th>Tanggal Simpan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($noTabungan->kas as $kas)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $kas->nominal }}</td>
                                                <td>{{ human_datetime_format($kas->tanggal) }} ({{ human_datetime_diff($kas->tanggal) }})</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3">
                                                    <h6 class="text-center">Data tidak tersedia.</h6>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif

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
