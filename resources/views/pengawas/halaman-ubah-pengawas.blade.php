@extends('layouts.layout')

@php
    $sidebarPengawas = 'active-page';
@endphp

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="page-description">
                    <h1>Ubah Pengawas</h1>
                </div>
            </div>
        </div>
        <div class="row card">
            <div class="col card-body">
                <form action="{{ route('prosesUbahPengawas', $pengawas->id_pengawas) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Input username --}}
                    <div class="row mb-3">
                        <label for="username" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                            <input name="username" type="text" class="form-control" id="username" required value="{{ $pengawas->username }}">
                        </div>
                    </div>

                    {{-- Input nama --}}
                    <div class="row mb-3">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input name="nama" type="text" class="form-control" id="nama" required value="{{ $pengawas->nama }}">
                        </div>
                    </div>

                    {{-- Input nomor telepon --}}
                    <div class="row mb-3">
                        <label for="no_tlp" class="col-sm-2 col-form-label">Nomor Telepon</label>
                        <div class="col-sm-10">
                            <input name="no_tlp" type="number" class="form-control" id="no_tlp" required value="{{ $pengawas->no_tlp }}">
                        </div>
                    </div>

                    {{-- Input alamat --}}
                    <div class="row mb-3">
                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <textarea name="alamat" type="text" class="form-control" id="alamat" required>{{ $pengawas->alamat }}</textarea>
                        </div>
                    </div>

                    {{-- Input password --}}
                    <div class="row mb-3">
                        <label for="password" class="col-sm-2 col-form-label">Password (Optional)</label>
                        <div class="col-sm-10">
                            <input name="password" type="password" class="form-control" id="password">
                        </div>
                    </div>

                    {{-- Input email --}}
                    <div class="row mb-3">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input name="email" type="email" class="form-control" id="email" required value="{{ $pengawas->email }}">
                        </div>
                    </div>

                    {{-- Input jenis kelamin --}}
                    <fieldset class="row mb-3">
                        <legend class="col-form-label col-sm-2 pt-0">Jenis Kelamin</legend>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin_1" value="Pria" {{ $pengawas->jenis_kelamin == 'Pria' ? 'checked' : '' }}>
                                <label class="form-check-label" for="jenis_kelamin_1">Pria</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin_2" value="Wanita" {{ $pengawas->jenis_kelamin == 'Wanita' ? 'checked' : '' }}>
                                <label class="form-check-label" for="jenis_kelamin_2">Wanita</label>
                            </div>
                        </div>
                    </fieldset>

                    {{-- Tombol --}}
                    <div class="mt-5">
                        <a href="{{ route('halamanUtamaPengawas') }}" class="btn btn-light">
                            <i class="fa-solid fa-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary mx-2">
                            <i class="fa-solid fa-circle-check"></i> Ubah
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
