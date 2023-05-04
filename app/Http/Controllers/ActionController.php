<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Pengawas;
use App\Models\TimVerifikasi;
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
     * KELOLA PENGAWAS
     */

    public function halamanUtamaPengawas()
    {
        // Ambil semua data pengawas yang ingin ditampilkan
        $data['pengawas'] = Pengawas::all();

        // Redirect ke halaman pengawas, beserta dengan data pengawas 
        return view('pengawas.halaman-utama-pengawas')->with($data);
    }

    public function halamanTambahPengawas()
    {
        // Redirect ke halaman tambah pengawas
        return view('pengawas.halaman-tambah-pengawas');
    }

    public function prosesTambahPengawas(Request $data)
    {
        // Ambil data pengawas dari form
        $dataPengawas = [
            'username' => $data->username,
            'nama' => $data->nama,
            'no_tlp' => $data->no_tlp,
            'alamat' => $data->alamat,
            'password' => Hash::make($data->password),
            'jenis_kelamin' => $data->jenis_kelamin,
        ];

        // Insert data pengawas ke database
        Pengawas::create($dataPengawas);

        // Redirect ke halaman utama pengawas
        return redirect()->route('halamanUtamaPengawas')->with('success', 'Berhasil menambah data pengawas.');
    }

    public function halamanDetailPengawas($id)
    {
        // Ambil data pengawas berdasarkan ID
        $data['pengawas'] = Pengawas::find($id);

        // Redirect ke halaman detail pengawas
        return view('pengawas.halaman-detail-pengawas')->with($data);
    }


    public function halamanUbahPengawas($id)
    {
        // Ambil data pengawas yang ingin diubah, ambil berdasarkan ID
        $data['pengawas'] = Pengawas::find($id);

        // Redirect ke halaman ubah pengawas, beserta dengan data pengawas 
        return view('pengawas.halaman-ubah-pengawas')->with($data);
    }

    public function prosesUbahPengawas(Request $data, $id)
    {
        // Ambil data pengawas berdasarkan ID
        $pengawas = Pengawas::find($id);

        // Ambil data pengawas terbaru dari form
        $dataPengawas = [
            'username' => $data->username,
            'nama' => $data->nama,
            'no_tlp' => $data->no_tlp,
            'alamat' => $data->alamat,
            'password' => $data->password ? Hash::make($data->password) : $pengawas->password,
            'jenis_kelamin' => $data->jenis_kelamin,
        ];

        // Ubah data pengawas di database
        $pengawas->update($dataPengawas);

        // Redirect ke halaman utama pengawas
        return redirect()->route('halamanUtamaPengawas')->with('success', 'Berhasil mengubah data pengawas.');
    }

    public function prosesHapusPengawas($id)
    {
        // Ambil data pengawas berdasarkan ID
        $pengawas = Pengawas::find($id);

        // Hapus pengawas tersebut
        $pengawas->delete();

        // Redirect ke halaman utama pengawas
        return redirect()->route('halamanUtamaPengawas')->with('success', 'Berhasil menghapus data pengawas.');
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
 
     public function halamanTambahPegawai()
     {
         // Redirect ke halaman tambah pegawai
         return view('pegawai.halaman-tambah-pegawai');
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
 
     public function halamanDetailPegawai($id)
     {
         // Ambil data pegawai berdasarkan ID
         $data['pegawai'] = Pegawai::find($id);
 
         // Redirect ke halaman detail pegawai
         return view('pegawai.halaman-detail-pegawai')->with($data);
     }
 
     public function halamanUbahPegawai($id)
     {
         // Ambil data pegawai yang ingin diubah, ambil berdasarkan ID
         $data['pegawai'] = Pegawai::find($id);
 
         // Redirect ke halaman ubah pegawai, beserta dengan data pegawai 
         return view('pegawai.halaman-ubah-pegawai')->with($data);
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

     /**
     * KELOLA TIM VERIFIKASI
     */

     public function halamanUtamaTim()
     {
         // Ambil semua data tim yang ingin ditampilkan
         $data['tim'] = TimVerifikasi::all();
 
         // Redirect ke halaman tim, beserta dengan data tim 
         return view('tim.halaman-utama-tim')->with($data);
     }
 
     public function halamanTambahTim()
     {
         // Redirect ke halaman tambah tim
         return view('tim.halaman-tambah-tim');
     }
 
     public function prosesTambahTim(Request $data)
     {
         // Ambil data tim dari form
         $dataTim = [
             'username' => $data->username,
             'nama' => $data->nama,
             'no_tlp' => $data->no_tlp,
             'alamat' => $data->alamat,
             'password' => Hash::make($data->password),
             'email' => $data->email,
             'jenis_kelamin' => $data->jenis_kelamin,
         ];
 
         // Insert data tim ke database
         TimVerifikasi::create($dataTim);
 
         // Redirect ke halaman utama tim
         return redirect()->route('halamanUtamaTim')->with('success', 'Berhasil menambah data tim verifikasi.');
     }
 
     public function halamanDetailTim($id)
     {
         // Ambil data tim berdasarkan ID
         $data['tim'] = TimVerifikasi::find($id);
 
         // Redirect ke halaman detail tim
         return view('tim.halaman-detail-tim')->with($data);
     }
 
     public function halamanUbahTim($id)
     {
         // Ambil data tim yang ingin diubah, ambil berdasarkan ID
         $data['tim'] = TimVerifikasi::find($id);
 
         // Redirect ke halaman ubah tim, beserta dengan data tim 
         return view('tim.halaman-ubah-tim')->with($data);
     }
 
     public function prosesUbahTim(Request $data, $id)
     {
         // Ambil data tim berdasarkan ID
         $tim = TimVerifikasi::find($id);
 
         // Ambil data tim terbaru dari form
         $dataTim = [
             'username' => $data->username,
             'nama' => $data->nama,
             'no_tlp' => $data->no_tlp,
             'alamat' => $data->alamat,
             'password' => $data->password ? Hash::make($data->password) : $tim->password,
             'email' => $data->email,
             'jenis_kelamin' => $data->jenis_kelamin,
         ];
 
         // Ubah data tim di database
         $tim->update($dataTim);
 
         // Redirect ke halaman utama tim
         return redirect()->route('halamanUtamaTim')->with('success', 'Berhasil mengubah data tim verifikasi.');
     }
 
     public function prosesHapusTim($id)
     {
         // Ambil data tim berdasarkan ID
         $tim = TimVerifikasi::find($id);
 
         // Hapus tim tersebut
         $tim->delete();
 
         // Redirect ke halaman utama tim
         return redirect()->route('halamanUtamaTim')->with('success', 'Berhasil menghapus data tim verifikasi.');
     }
}
