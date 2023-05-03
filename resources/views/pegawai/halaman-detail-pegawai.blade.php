@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="page-description">
                    <h1>Detail Pegawai</h1>
                </div>
            </div>
        </div>
        <div class="row card">
            <div class="col card-body">
                <form>
                    {{-- Info username --}}
                    <div class="row mb-3">
                        <label for="username" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="username" value="{{ $pegawai->username }}" disabled>
                        </div>
                    </div>

                    {{-- Info nama --}}
                    <div class="row mb-3">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" value="{{ $pegawai->nama }}" disabled>
                        </div>
                    </div>

                    {{-- Info nomor telepon --}}
                    <div class="row mb-3">
                        <label for="no_tlp" class="col-sm-2 col-form-label">Nomor Telepon</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="no_tlp" value="{{ $pegawai->no_tlp }}" disabled>
                        </div>
                    </div>

                    {{-- Info alamat --}}
                    <div class="row mb-3">
                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <textarea type="text" class="form-control" id="alamat" disabled>{{ $pegawai->alamat }}</textarea>
                        </div>
                    </div>

                    {{-- Info jabatan --}}
                    <div class="row mb-3">
                        <label for="jabatan" class="col-sm-2 col-form-label">Jabatan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="jabatan" value="{{ $pegawai->jabatan }}" disabled>
                        </div>
                    </div>

                    {{-- Info jenis kelamin --}}
                    <div class="row mb-3">
                        <label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="jenis_kelamin" value="{{ $pegawai->jenis_kelamin }}" disabled>
                        </div>
                    </div>

                    {{-- Tombol --}}
                    <div class="mt-5">
                        <a href="{{ route('halamanUtamaPegawai') }}" class="btn btn-light">
                            <i class="fa-solid fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
