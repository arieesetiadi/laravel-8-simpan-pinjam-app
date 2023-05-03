<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ActionController extends Controller
{
    /**
     * LOGIN
     */

    public function halamanLogin()
    {
        return view('login');
    }

    public function prosesLogin(Request $data)
    {
        $guard = $data->guard;

        // Ambil username dan password dari form login
        $username = $data->username;
        $password = $data->password;

        // Lakukan proses login dengan username dan password yang diinputkan
        $login = auth()->guard($guard)->attempt([
            'username' => $username,
            'password' => $password,
        ]);

        // Cek status login
        if ($login == true) {
            // Jika login sukses, tampilkan halaman dashboard
            return redirect()->route('halamanDashboard');
        } else {
            // Jika login gagal, redirect back ke halaman login
            return back()->with('alert', 'Login gagal, silahkan coba lagi.');
        }
    }

    public function prosesLogout()
    {
        auth()->guard(request()->guard)->logout();
        return redirect()->route('halamanLogin');
    }

    /**
     * DASHBOARD
     */

    public function halamanDashboard()
    {
        // Redirect ke halaman dashboard
        return view('dashboard');
    }

    /**
     * KELOLA PEGAWAI
     */

    public function halamanUtamaPegawai()
    {
        // Ambil semua data pegawai yang ingin ditampilkan
        $data['pegawai'] = Pegawai::all();

        // Redirect ke halaman pegawai, beserta dengan data pegawai 
        return view('pegawai.halaman-utama-pegawai')->with($data);
    }

    public function halamanDetailPegawai($id)
    {
        // Ambil data pegawai berdasarkan ID
        $data['pegawai'] = Pegawai::find($id);

        // Redirect ke halaman detail pegawai
        return view('pegawai.halaman-detail-pegawai')->with($data);
    }

    public function halamanTambahPegawai()
    {
        // Redirect ke halaman tambah pegawai
        return view('pegawai.halaman-tambah-pegawai');
    }

    public function halamanUbahPegawai($id)
    {
        // Ambil data pegawai yang ingin diubah, ambil berdasarkan ID
        $data['pegawai'] = Pegawai::find($id);

        // Redirect ke halaman ubah pegawai, beserta dengan data pegawai 
        return view('pegawai.halaman-ubah-pegawai')->with($data);
    }

    public function prosesTambahPegawai(Request $data)
    {
        // Ambil data pegawai dari form
        $dataPegawai = [
            'username' => $data->username,
            'nama' => $data->nama,
            'no_tlp' => $data->no_tlp,
            'alamat' => $data->alamat,
            'password' => Hash::make($data->password),
            'jabatan' => $data->jabatan,
            'jenis_kelamin' => $data->jenis_kelamin,
        ];

        // Insert data pegawai ke database
        Pegawai::create($dataPegawai);

        // Redirect ke halaman utama pegawai
        return redirect()->route('halamanUtamaPegawai')->with('success', 'Berhasil menambah data pegawai.');
    }

    public function prosesUbahPegawai(Request $data, $id)
    {
        // Ambil data pegawai berdasarkan ID
        $pegawai = Pegawai::find($id);

        // Ambil data pegawai terbaru dari form
        $dataPegawai = [
            'username' => $data->username,
            'nama' => $data->nama,
            'no_tlp' => $data->no_tlp,
            'alamat' => $data->alamat,
            'password' => $data->password ? Hash::make($data->password) : $pegawai->password,
            'jabatan' => $data->jabatan,
            'jenis_kelamin' => $data->jenis_kelamin,
        ];

        // Ubah data pegawai di database
        $pegawai->update($dataPegawai);

        // Redirect ke halaman utama pegawai
        return redirect()->route('halamanUtamaPegawai')->with('success', 'Berhasil mengubah data pegawai.');
    }

    public function prosesHapusPegawai($id)
    {
        // Ambil data pegawai berdasarkan ID
        $pegawai = Pegawai::find($id);

        // Hapus pegawai tersebut
        $pegawai->delete();

        // Redirect ke halaman utama pegawai
        return redirect()->route('halamanUtamaPegawai')->with('success', 'Berhasil menghapus data pegawai.');
    }
}
