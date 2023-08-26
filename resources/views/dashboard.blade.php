@extends('layouts.layout')

@php
    $sidebarDashboard = 'active-page';
@endphp

@section('content')
    <style>
        .table th,
        .table td {
            padding: 3px 10px !important;
        }
    </style>

    <div class="container">
        <div class="row">
            <div class="col">
                <div class="page-description">
                    <h1>Dashboard</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <div class="card widget widget-stats">
                    <div class="card-body">
                        <div class="widget-stats-container d-flex">
                            <div class="widget-stats-icon widget-stats-icon-primary">
                                <i class="material-icons-outlined">paid</i>
                            </div>
                            <div class="widget-stats-content flex-fill">
                                <span class="widget-stats-title">Total Simpanan</span>
                                <span class="widget-stats-amount">{{ number_to_idr($totalSimpanan) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card widget widget-stats">
                    <div class="card-body">
                        <div class="widget-stats-container d-flex">
                            <div class="widget-stats-icon widget-stats-icon-danger">
                                <i class="material-icons-outlined">paid</i>
                            </div>
                            <div class="widget-stats-content flex-fill">
                                <span class="widget-stats-title">Total Pinjaman</span>
                                <span class="widget-stats-amount">{{ number_to_idr($totalPinjaman) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card widget widget-stats">
                    <div class="card-body">
                        <div class="widget-stats-container d-flex">
                            <div class="widget-stats-icon widget-stats-icon-success">
                                <i class="material-icons-outlined">paid</i>
                            </div>
                            <div class="widget-stats-content flex-fill">
                                <span class="widget-stats-title">Total Pendapatan Bunga</span>
                                <span class="widget-stats-amount">{{ number_to_idr($totalPendapatanBunga) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3">
                <div class="card widget widget-stats">
                    <div class="card-body">
                        <div class="widget-stats-container d-flex">
                            <div class="widget-stats-icon">
                                <i class="material-icons-outlined">person</i>
                            </div>
                            <div class="widget-stats-content flex-fill">
                                <span class="widget-stats-title">Jumlah Pegawai</span>
                                <span class="widget-stats-amount">{{ $jumlahPegawai }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3">
                <div class="card widget widget-stats">
                    <div class="card-body">
                        <div class="widget-stats-container d-flex">
                            <div class="widget-stats-icon">
                                <i class="material-icons-outlined">person</i>
                            </div>
                            <div class="widget-stats-content flex-fill">
                                <span class="widget-stats-title">Jumlah Pengawas</span>
                                <span class="widget-stats-amount">{{ $jumlahPengawas }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card widget widget-stats pb-4">
                    <div class="card-header">
                        <div class="widget-stats-container d-flex">
                            <div class="widget-stats-icon widget-stats-icon-warning">
                                <i class="material-icons-outlined">leaderboard</i>
                            </div>
                            <div class="widget-stats-content flex-fill pt-3">
                                <span class="widget-stats-title">Leaderboard Pinjaman Nasabah</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-4" style="height: 300px; overflow-y: scroll;">
                        <table class="table-sm table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Nasabah</th>
                                    <th>Total Pinjaman</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($leaderboardNasabah as $i => $leaderboard)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>
                                            <a target="_blank" class="text-decoration-none"
                                                href="{{ route('halamanDetailNasabah', $leaderboard->nasabah->id_nasabah) }}"
                                                title="Detail Nasabah">
                                                {{ $leaderboard->nasabah->nama }}
                                            </a>
                                        </td>
                                        <td>{{ number_to_idr($leaderboard->pinjaman_sum_besar_permohonan_pinjam) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xl-3">
                <div class="card widget widget-stats">
                    <div class="card-body">
                        <div class="widget-stats-container d-flex">
                            <div class="widget-stats-icon">
                                <i class="material-icons-outlined">person</i>
                            </div>
                            <div class="widget-stats-content flex-fill">
                                <span class="widget-stats-title">Jumlah Direktur</span>
                                <span class="widget-stats-amount">{{ $jumlahDirektur }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3">
                <div class="card widget widget-stats">
                    <div class="card-body">
                        <div class="widget-stats-container d-flex">
                            <div class="widget-stats-icon">
                                <i class="material-icons-outlined">person</i>
                            </div>
                            <div class="widget-stats-content flex-fill">
                                <span class="widget-stats-title">Jumlah Nasabah</span>
                                <span class="widget-stats-amount">{{ $jumlahNasabah }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
