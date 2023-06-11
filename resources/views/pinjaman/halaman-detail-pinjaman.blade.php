@extends('layouts.layout')

@php
    $sidebarPinjaman = 'active-page';
    $sidebarSubPinjaman = 'fw-bold';
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
                <div class="page-description">
                    <h1>Detail Permohonan Pinjam</h1>
                </div>
            </div>
        </div>
        <div class="row card">
            <div class="col card-body">
                <form>
                    {{-- Info no pinjaman --}}
                    <div class="row">
                        <div class="col-sm-6 mb-3">
                            <label class="col-form-label" for="no-pinjaman">No Pinjaman</label>
                            <input class="form-control" id="no-pinjaman" type="text" value="{{ $pinjaman->noPinjaman->no_pinjaman }}" disabled>
                        </div>

                        <div class="col-sm-6 mb-3">
                            <label class="col-form-label" for="status-lunas">Status Pinjaman</label>
                            <input class="form-control" id="status-lunas" type="text" value="{{ $pinjaman->sisa_pinjam <= 0 ? 'Lunas' : 'Belum Lunas' }}" disabled>
                        </div>

                        <div class="col-sm-6 mb-3">
                            <label class="col-form-label" for="nama">Nama Nasabah</label>
                            <input class="form-control" id="nama" type="text" value="{{ $pinjaman->noPinjaman->nasabah->nama }}" disabled>
                        </div>

                        <div class="col-sm-6 mb-3">
                            <label class="col-form-label" for="status-verifikasi">Status Verifikasi</label>
                            <input class="form-control" id="status-verifikasi" type="text" value="{{ $pinjaman->status ? 'Verified' : 'Menunggu verifikasi Direktur' }}" disabled>
                        </div>
                    </div>

                    <hr class="d-block mt-5 mb-4">

                    <nav class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-link btn-sm active text-dark border" id="nav-detail-tab" data-bs-toggle="tab" href="#nav-detail" role="tab" aria-controls="nav-detail" aria-selected="true">Detail</a>
                        <a class="nav-link btn-sm text-dark {{ !$pinjaman->status ? 'd-none' : '' }} border" id="nav-kitir-tab" data-bs-toggle="tab" href="#nav-kitir" role="tab" aria-controls="nav-kitir" aria-selected="false">Kitir
                            Kredit</a>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        {{-- Nav Detail --}}
                        <div class="tab-pane fade show active pt-3" id="nav-detail" role="tabpanel" aria-labelledby="nav-detail-tab">
                            {{-- Info jumlah pinjaman --}}
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="nominal">Jumlah Pinjaman</label>
                                <div class="col-sm-10">
                                    <input class="form-control" id="nominal" type="text" value="{{ number_to_idr($pinjaman->besar_permohonan_pinjam) }}" disabled>
                                </div>
                            </div>

                            {{-- Info jumlah pokok --}}
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="pokok">Jumlah Pokok</label>
                                <div class="col-sm-10">
                                    <input class="form-control" id="pokok" type="text" value="{{ number_to_idr($pinjaman->jumlah_angsuran) }}" disabled>
                                </div>
                            </div>

                            {{-- Info jangka waktu --}}
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="pokok">Jangka Waktu</label>
                                <div class="col-sm-10">
                                    <input class="form-control" id="pokok" type="text" value="{{ $pinjaman->jangka_waktu }} Bulan" disabled>
                                </div>
                            </div>

                            {{-- Info bunga --}}
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="pokok">Bunga</label>
                                <div class="col-sm-10">
                                    <input class="form-control" id="pokok" type="text" value="1.5%" disabled>
                                </div>
                            </div>

                            {{-- Info tanggal --}}
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="tanggal">Tanggal Peminjaman</label>
                                <div class="col-sm-10">
                                    <input class="form-control" id="tanggal" type="text" value="{{ human_datetime_format($pinjaman->tanggal) }} ({{ human_datetime_diff($pinjaman->tanggal) }})" disabled>
                                </div>
                            </div>
                        </div>

                        {{-- Nav Kitir Kredit --}}
                        <div class="tab-pane fade {{ !$pinjaman->status ? 'd-none' : '' }} pt-3" id="nav-kitir" role="tabpanel" aria-labelledby="nav-kitir-tab">
                            {{-- Info sisa pinjaman --}}
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="sisa-pinjam">Sisa Pinjam</label>
                                <div class="col-sm-10">
                                    <input class="form-control" id="sisa-pinjam" type="text" value="{{ $pinjaman->sisa_pinjam ? number_to_idr($pinjaman->sisa_pinjam) : 'Lunas' }}" disabled>
                                </div>
                            </div>

                            {{-- Info batas pembayaran --}}
                            @if ($pinjaman->sisa_pinjam > 0)
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="batas-bayar">Terakhir Bayar</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="batas-bayar" type="text" value="{{ human_date_format($pinjaman->tanggal_terakhir_bayar) }} ({{ human_datetime_diff($pinjaman->tanggal_terakhir_bayar) }})"
                                            disabled>
                                    </div>
                                </div>
                            @endif

                            {{-- Info riwayat tabungan --}}
                            @if ($pinjaman->kitirKredit)
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Riwayat Bayar</label>
                                    <div class="col-sm-10">
                                        <table class="table-sm table">
                                            <thead>
                                                <tr>
                                                    <th class="{{ role('pengawas') ? 'd-none' : '' }}">Aksi</th>
                                                    <th>No.</th>
                                                    <th>Status</th>
                                                    <th>Tanggal Bayar</th>
                                                    <th>Pokok</th>
                                                    <th>Bunga</th>
                                                    <th>Denda</th>
                                                    <th>Jumlah</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($pinjaman->kitirKredit as $kitir)
                                                    <tr>
                                                        <td class="{{ role('pengawas') ? 'd-none' : '' }}">
                                                            {{-- Tampilkan tombol bayar jika statusnya belum bayar --}}
                                                            @if ($kitir->status == false)
                                                                <a href="{{ route('prosesBayarPinjaman', $kitir->id_kitir) }}" title="Lakukan pembayaran"
                                                                    onclick="return confirm('Lakukan pembayaran angsuran ke-{{ $loop->index + 1 }} dari nasabah?')">
                                                                    <i class="fa-solid fa-check text-success"></i>
                                                                </a>
                                                            @endif
                                                        </td>
                                                        <td>{{ $loop->index + 1 }}</td>
                                                        <td>
                                                            @if ($kitir->status == true)
                                                                <span class="badge badge-success d-blok w-100" title="Sudah Terbayar">
                                                                    <i class="fa-solid fa-check"></i>
                                                                </span>
                                                            @else
                                                                <span>-</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ $kitir->tanggal_transaksi ? human_datetime_format($kitir->tanggal_transaksi) : '-' }}</td>
                                                        <td>{{ number_to_idr($kitir->pokok) }}</td>
                                                        <td>{{ number_to_idr($kitir->bunga) }}</td>
                                                        <td>{{ $kitir->denda ? number_to_idr($kitir->denda) : '-' }}</td>
                                                        <td>{{ $kitir->jumlah ? number_to_idr($kitir->jumlah) : '-' }}</td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="8">
                                                            <h6 class="text-center">Data tidak tersedia.</h6>
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Tombol --}}
                    <div class="mt-5">
                        <a class="btn btn-light" href="{{ route('halamanUtamaPinjaman') }}">
                            <i class="fa-solid fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
