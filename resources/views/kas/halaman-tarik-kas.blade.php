@extends('layouts.layout')

@php
    $sidebarSimpanan = 'active-page';
    $sidebarKasSimpanan = 'fw-bold';
@endphp

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                {{-- Tampilkan jika ada pesan sukses --}}
                @if (session('failed'))
                    <div class="alert alert-danger" role="alert">{{ session('failed') }}</div>
                @endif
            </div>
            <div class="col-12">
                <div class="page-description">
                    <h1>Tarik Kas Simpanan</h1>
                </div>
            </div>
        </div>
        <div class="row card">
            <div class="col card-body">
                <form action="{{ route('prosesTarikKasSimpanan') }}" method="POST">
                    @csrf
                    {{-- Input no tabungan --}}
                    <div class="row mb-3">
                        <label for="id_tabungan" class="col-sm-2 col-form-label">Nomor Tabungan</label>
                        <div class="col-sm-10">
                            <select id="id_tabungan" name="id_tabungan" class="form-select select-2" aria-label="Pilih Nomor Tabungan" required onchange="showInfoSaldo(event)">
                                <option selected hidden disabled value="">Pilih Nomor Tabungan</option>
                                @foreach ($noTabungan as $n)
                                    <option value="{{ $n->id_tabungan }}" data-saldo="{{ $n->saldo }}" data-saldo-formatted="{{ number_to_idr($n->saldo) }}" {{ old('id_tabungan') == $n->id_tabungan ? 'selected' : '' }}>
                                        {{ $n->no_tabungan }} a.n. {{ $n->nasabah->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Info saldo --}}
                    <div id="info-saldo" class="row mb-3 {{ old('saldo') ? '' : 'd-none' }}">
                        <label for="saldo-formatted" class="col-sm-2 col-form-label">Saldo Kas</label>
                        <div class="col-sm-10">
                            <input name="saldo-formatted" type="text" class="form-control" id="saldo-formatted" value="{{ old('saldo-formatted') }}" readonly>
                            <input name="saldo" type="hidden" min="0" class="form-control" id="saldo">
                        </div>
                    </div>

                    {{-- Input nominal --}}
                    <div class="row mb-3">
                        <label for="nominal" class="col-sm-2 col-form-label">Nominal Penarikan</label>
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
            const saldoFormatted = selected.data('saldo-formatted');

            $('input#saldo').val(saldo);
            $('input#saldo-formatted').val(saldoFormatted);
        }

        function checkInfoSaldo(event) {
            const saldo = $('input#saldo').val();

            if (saldo && parseInt(event.target.value) > parseInt(saldo)) {
                alert('Saldo nasabah tidak mencukupi.');
                $(event.target).val(saldo);
            }
        }
    </script>
@endpush
