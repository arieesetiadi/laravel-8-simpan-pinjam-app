@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="page-description">
                    <h1>Dashboard</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-3">
                <div class="card widget widget-stats">
                    <div class="card-body">
                        <div class="widget-stats-container d-flex">
                            <div class="widget-stats-icon widget-stats-icon-primary">
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
                            <div class="widget-stats-icon widget-stats-icon-warning">
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
            <div class="col-xl-3">
                <div class="card widget widget-stats">
                    <div class="card-body">
                        <div class="widget-stats-container d-flex">
                            <div class="widget-stats-icon widget-stats-icon-success">
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
                            <div class="widget-stats-icon widget-stats-icon-danger">
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
