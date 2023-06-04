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
                    <h1>Tambah Kas Simpanan</h1>
                </div>
            </div>
        </div>
        <div class="row card">
            <div class="col card-body">
                <form action="{{ route('prosesTambahKasSimpanan') }}" method="POST">
                    @csrf
                    {{-- Input no tabungan --}}
                    <div class="row mb-3">
                        <label for="id_tabungan" class="col-sm-2 col-form-label">Nomor Tabungan</label>
                        <div class="col-sm-10">
                            <select id="id_tabungan" name="id_tabungan" class="form-select select-2" aria-label="Pilih Nomor Tabungan" required>
                                <option selected hidden disabled value="">Pilih Nomor Tabungan</option>
                                @foreach ($noTabungan as $n)
                                    <option value="{{ $n->id_tabungan }}">
                                        {{ $n->no_tabungan }} a.n. {{ $n->nasabah->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Input nominal --}}
                    <div class="row mb-3">
                        <label for="nominal" class="col-sm-2 col-form-label">Nominal</label>
                        <div class="col-sm-10">
                            <input name="nominal" type="number" min="0" class="form-control" id="nominal" required value="{{ old('nominal') }}" placeholder="Masukan nominal simpanan">
                        </div>
                    </div>

                    {{-- Tombol --}}
                    <div class="mt-5">
                        <a href="{{ route('halamanUtamaKasSimpanan') }}" class="btn btn-light">
                            <i class="fa-solid fa-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary mx-2">
                            <i class="fa-solid fa-circle-check"></i> Tambah
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
