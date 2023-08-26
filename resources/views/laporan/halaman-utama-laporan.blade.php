@extends('layouts.layout')

@php
    $sidebarLaporan = 'active-page';
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
                        <h1>Laporan</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card widget widget-stats">
                    <div class="card-body">
                        <div class="widget-stats-container d-flex mb-4">
                            <div class="widget-stats-icon widget-stats-icon-success">
                                <i class="material-icons-outlined">paid</i>
                            </div>
                            <div class="widget-stats-content flex-fill">
                                <span class="widget-stats-title">Total Pendapatan Bunga</span>
                                <span class="widget-stats-amount">{{ number_to_idr($totalPendapatanBunga) }}</span>
                            </div>
                        </div>

                        <table class="table-data table">
                            <thead>
                                <tr>
                                    <th class="text-nowrap">#</th>
                                    <th class="text-nowrap">No Pinjaman</th>
                                    <th class="text-nowrap">Nominal</th>
                                    <th class="text-nowrap">Pendapatan Bunga</th>
                                    <th class="text-nowrap">Total</th>
                                    <th class="text-nowrap">Tanggal Transaksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($paidKitirKredit as $i => $kitir)
                                    <tr>
                                        <td class="text-nowrap">{{ $i + 1 }}</td>
                                        <td class="text-nowrap">{{ $kitir->permohonanPinjam->noPinjaman->no_pinjaman }}</td>
                                        <td class="text-nowrap">{{ number_to_idr($kitir->pokok) }}</td>
                                        <td class="text-nowrap text-success">{{ number_to_idr($kitir->bunga) }}</td>
                                        <td class="text-nowrap">{{ number_to_idr($kitir->jumlah) }}</td>
                                        <td class="text-nowrap">{{ human_date_format($kitir->tanggal_transaksi) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9">Data tidak tersedia.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card widget widget-stats">
                    <div class="card-body">
                        <div class="widget-stats-container d-flex mb-4">
                            <div class="widget-stats-icon widget-stats-icon-warning">
                                <i class="material-icons-outlined">paid</i>
                            </div>
                            <div class="widget-stats-content flex-fill">
                                <span class="widget-stats-title">Total Kredit Macet</span>
                                <span class="widget-stats-amount">{{ number_to_idr($totalKreditMacet) }}</span>
                            </div>
                        </div>

                        <table class="table-data table">
                            <thead>
                                <tr>
                                    <th class="text-nowrap">#</th>
                                    <th class="text-nowrap">No Pinjaman</th>
                                    <th class="text-nowrap">Nama Nasabah</th>
                                    <th class="text-nowrap">Jumlah</th>
                                    <th class="text-nowrap">Batas Pembayaran</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($lateKitirKredit as $i => $kitir)
                                    <tr>
                                        <td class="text-nowrap">{{ $i + 1 }}</td>
                                        <td class="text-nowrap">{{ $kitir->permohonanPinjam->noPinjaman->no_pinjaman }}</td>
                                        <td class="text-nowrap">{{ $kitir->permohonanPinjam->noPinjaman->nasabah->nama }}</td>
                                        <td class="text-nowrap">{{ number_to_idr($kitir->pokok + $kitir->bunga) }}</td>
                                        <td class="text-nowrap">
                                            {{ human_date_format($kitir->permohonanPinjam->tanggal_terakhir_bayar) }}
                                            ({{ human_datetime_diff($kitir->permohonanPinjam->tanggal_terakhir_bayar) }})
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9">Data tidak tersedia.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
