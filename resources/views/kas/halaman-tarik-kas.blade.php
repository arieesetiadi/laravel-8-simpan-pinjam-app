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
                    <h1>Tarik Kas Simpanan</h1>
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
                            <select id="id_tabungan" name="id_tabungan" class="form-select select-2" aria-label="Pilih Nomor Tabungan" required onchange="showInfoSaldo(event)">
                                <option selected hidden disabled value="">Pilih Nomor Tabungan</option>
                                @foreach ($noTabungan as $n)
                                    <option value="{{ $n->id_tabungan }}" data-saldo="{{ $n->saldo }}">
                                        {{ $n->no_tabungan }} a.n. {{ $n->nasabah->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Info saldo --}}
                    <div id="info-saldo" class="row mb-3 d-none">
                        <label for="saldo" class="col-sm-2 col-form-label">Saldo Kas</label>
                        <div class="col-sm-10">
                            <input name="saldo" type="text" min="0" class="form-control" id="saldo" disabled>
                        </div>
                    </div>

                    {{-- Input nominal --}}
                    <div class="row mb-3">
                        <label for="nominal" class="col-sm-2 col-form-label">Nominal</label>
                        <div class="col-sm-10">
                            <input name="nominal" type="number" min="0" class="form-control" id="nominal" required value="{{ old('nominal') }}" placeholder="Masukan nominal tarik kas" oninput="checkInfoSaldo(event)">
                        </div>
                    </div>

                    {{-- Tombol --}}
                    <div class="mt-5">
                        <a href="{{ route('halamanUtamaKasSimpanan') }}" class="btn btn-light">
                            <i class="fa-solid fa-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary mx-2">
                            <i class="fa-solid fa-circle-check"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('after-scripts')
    <script>
        function showInfoSaldo(event) {
            $('#info-saldo').removeClass('d-none');

            const selected = $(event.target).find(':selected');
            const saldo = selected.data('saldo');

            $('input#saldo').val(saldo);
        }

        function checkInfoSaldo(event) {
            const saldo = $('input#saldo').val();

            if (saldo && parseInt(event.target.value) > parseInt(saldo)) {
                alert('Saldo nasabah tidak mencukupi.');
                $(event.target).val(0);
            }
        }
    </script>
@endpush
