@extends('layouts.layout')

@php
    $sidebarPinjaman = 'active-page';
    $sidebarSubPinjaman = 'fw-bold';
@endphp

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="page-description">
                    <h1>Tambah Pinjaman</h1>
                </div>
            </div>
        </div>
        <div class="row card">
            <div class="col card-body">
                <form action="{{ route('prosesTambahPinjaman') }}" method="POST">
                    @csrf
                    {{-- Input no pinjaman --}}
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="id_pinjaman">Nomor Pinjaman</label>
                        <div class="col-sm-10">
                            <select class="form-select select-2" id="id_pinjaman" name="id_pinjaman" aria-label="Pilih Nomor Pinjaman" required>
                                <option value="" selected hidden disabled>Pilih Nomor Pinjaman</option>
                                @foreach ($noPinjaman as $n)
                                    <option value="{{ $n->id_pinjaman }}">
                                        {{ $n->no_pinjaman }} a.n. {{ $n->nasabah->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Input nominal --}}
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="besar_permohonan_pinjam">Nominal</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="besar_permohonan_pinjam" name="besar_permohonan_pinjam" type="number" value="{{ old('besar_permohonan_pinjam') }}" min="0" required placeholder="Masukan nominal pinjaman">
                        </div>
                    </div>

                    {{-- Input jangka waktu --}}
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="besar_permohonan_pinjam">Jangka Waktu</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <input class="form-control" name="jangka_waktu" type="number" placeholder="Masukan jangka waktu pinjaman" required oninput="validateJangkaWaktu(event)">
                                <select class="form-select" name="jangka_waktu_format" required>
                                    <option selected hidden>Pilih Format Waktu</option>
                                    <option value="Bulan">Bulan</option>
                                    <option value="Tahun">Tahun</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- Tombol --}}
                    <div class="mt-5">
                        <a class="btn btn-light" href="{{ route('halamanUtamaPinjaman') }}">
                            <i class="fa-solid fa-arrow-left"></i> Kembali
                        </a>
                        <button class="btn btn-primary mx-2" type="submit">
                            <i class="fa-solid fa-circle-check"></i> Tambah
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('after-scripts')
    <script>
        function validateJangkaWaktu(event) {
            const value = event.target.value;
            const jangkaFormat = $('select[name=jangka_waktu_format]').val();

            switch (jangkaFormat) {
                case 'Bulan':
                    if (value > 60) {
                        alert('Jangka waktu tidak boleh melebihi 60 bulan (5 tahun).');
                        $('input[name=jangka_waktu]').val(60);
                    }
                    break;
                case 'Tahun':
                    if (value > 5) {
                        alert('Jangka waktu tidak boleh melebihi 5 tahun.');
                        $('input[name=jangka_waktu]').val(5);
                    }
                    break;
            }
        }
    </script>
@endpush
