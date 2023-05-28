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
                    <h1>Tambah No Tabungan</h1>
                </div>
            </div>
        </div>
        <div class="row card">
            <div class="col card-body">
                <form action="{{ route('prosesTambahNoTabungan') }}" method="POST">
                    @csrf

                    {{-- Input no tabungan - generate otomatis oleh sistem --}}
                    <div class="row mb-3">
                        <label for="no_tabungan" class="col-sm-2 col-form-label">No Tabungan</label>
                        <div class="col-sm-10">
                            <input name="no_tabungan" type="text" class="form-control" id="no_tabungan" required
                                value="{{ old('no_tabungan', $noTabungan) }}" readonly>
                        </div>
                    </div>

                    {{-- Input nasabah --}}
                    <div class="row mb-3">
                        <label for="id_nasabah" class="col-sm-2 col-form-label">Nasabah</label>
                        <div class="col-sm-10">
                            <select id="id_nasabah" name="id_nasabah" class="form-select select-2"
                                aria-label="Pilih Nasabah">
                                <option selected hidden disabled>Pilih Nasabah</option>
                                @foreach ($nasabah as $n)
                                    <option value="{{ $n->id_nasabah }}">
                                        {{ $n->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Tombol --}}
                    <div class="mt-5">
                        <a href="{{ route('halamanUtamaNoTabungan') }}" class="btn btn-light">
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
