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
                    <h1>Detail No Tabungan</h1>
                </div>
            </div>
        </div>
        <div class="row card">
            <div class="col card-body">
                <form>
                    {{-- Info no tabungan --}}
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="no-tabungan">No Tabungan</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="no-tabungan" type="text" value="{{ $noTabungan->no_tabungan }}" disabled>
                        </div>
                    </div>

                    {{-- Info nama nasabah --}}
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="nama">Nama Nasabah</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="nama" type="text" value="{{ $noTabungan->nasabah->nama }}" disabled>
                        </div>
                    </div>

                    <hr class="d-block my-5">

                    {{-- Info total kas --}}
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="total-kas">Total Kas</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="total-kas" type="text" value="{{ number_to_idr($noTabungan->kas()->totalMasuk() - $noTabungan->kas()->totalKeluar()) }}" disabled>
                        </div>
                    </div>

                    {{-- Info riwayat tabungan --}}
                    @if ($noTabungan->kas)
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="total-kas">Riwayat Simpanan</label>
                            <div class="col-sm-10">
                                <table class="table-sm table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Jenis</th>
                                            <th>Nominal</th>
                                            <th>Tanggal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($noTabungan->kas as $kas)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td class="text-nowrap">
                                                    @if ($kas->jenis == 'Uang Masuk')
                                                        <span class="badge badge-success">{{ $kas->jenis }}</span>
                                                    @else
                                                        <span class="badge badge-danger">{{ $kas->jenis }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ number_to_idr($kas->nominal) }}</td>
                                                <td>{{ human_datetime_format($kas->tanggal) }}
                                                    ({{ human_datetime_diff($kas->tanggal) }})
                                                </td>
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
                        <a class="btn btn-light" href="{{ route('halamanUtamaNoTabungan') }}">
                            <i class="fa-solid fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
