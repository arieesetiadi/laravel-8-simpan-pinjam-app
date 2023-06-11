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
                        <label class="col-sm-2 col-form-label" for="no-pinjaman">No Pinjaman</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="no-pinjaman" type="text" value="{{ $noPinjaman->no_pinjaman }}" disabled>
                        </div>
                    </div>

                    {{-- Info nama nasabah --}}
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="nama">Nama Nasabah</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="nama" type="text" value="{{ $noPinjaman->nasabah->nama }}" disabled>
                        </div>
                    </div>

                    <hr class="d-block my-5">

                    {{-- Info total pinjaman --}}
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="total-pinjaman">Total Pinjaman</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="total-pinjaman" type="text" value="{{ number_to_idr($noPinjaman->pinjaman()->sum('besar_permohonan_pinjam')) }}" disabled>
                        </div>
                    </div>

                    {{-- Info riwayat pinjaman --}}
                    @if ($noPinjaman->pinjaman)
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="total-pinjaman">Riwayat Pinjaman</label>
                            <div class="col-sm-10 table-responsive">
                                <table class="table-sm table">
                                    <thead>
                                        <tr>
                                            <th class="text-nowrap">#</th>
                                            <th class="text-nowrap">Nominal</th>
                                            <th class="text-nowrap">Angsuran</th>
                                            <th class="text-nowrap">Jangka Waktu</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($noPinjaman->pinjaman as $pinjaman)
                                            <tr>
                                                <td class="text-nowrap">{{ $loop->index + 1 }}</td>
                                                <td class="text-nowrap">{{ number_to_idr($pinjaman->besar_permohonan_pinjam) }}</td>
                                                <td class="text-nowrap">{{ number_to_idr($pinjaman->jumlah_angsuran) }}/Bulan</td>
                                                <td class="text-nowrap">{{ $pinjaman->jangka_waktu }} Bulan</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5">
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
