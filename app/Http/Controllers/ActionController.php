<?php

namespace App\Http\Controllers;

use App\Models\Nasabah;
use App\Models\Pegawai;
use App\Models\Pengawas;
use App\Models\Direktur;
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

    public function prosesLogin(Request $form)
    {
        $guard = $form->guard;

        // Ambil username dan password dari form login
        $username = $form->username;
        $password = $form->password;

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
        // Siapkan data untuk tampilan dashboard
        $data = [
            'jumlahPengawas' => Pengawas::count(),
            'jumlahPegawai' => Pegawai::count(),
            'jumlahDirektur' => Direktur::count(),
            'jumlahNasabah' => Nasabah::count(),
        ];

        // Redirect ke halaman dashboard
        return view('dashboard', $data);
    }

    /**
     * PROFILE
     */

    public function halamanProfile()
    {
        // Redirect ke halaman profile
        return view('profile');
    }

    public function prosesUbahProfile(Request $form)
    {
        $profile = null;

        // Tentukan jenis pengguna yang ingin diubah
        switch ($form->guard) {
            case 'pegawai':
                $profile = Pegawai::find(user()->id_pegawai);
                break;
            case 'pengawas':
                $profile = Pengawas::find(user()->id_pengawas);
                break;
            case 'direktur':
                $profile = Direktur::find(user()->id_tim);
                break;
        }

        // Ambil data profile dari form edit profile
        $dataProfile = [
            'username' => $form->username,
            'nama' => $form->nama,
            'no_tlp' => $form->no_tlp,
            'alamat' => $form->alamat,
            'password' => $form->password ? Hash::make($form->password) : user()->password,
            'email' => $form->email,
            'jenis_kelamin' => $form->jenis_kelamin,
        ];

        // Proses ubah profile pengguna
        $profile->update($dataProfile);

        // Redirect ke halaman profile
        return redirect()->back()->with('success', 'Berhasil mengubah profile pengguna.');
    }

    /**
     * KELOLA PENGAWAS
     */

    public function halamanUtamaPengawas()
    {
        // Ambil semua data pengawas yang ingin ditampilkan
        $form['pengawas'] = Pengawas::all();

        // Redirect ke halaman pengawas, beserta dengan data pengawas 
        return view('pengawas.halaman-utama-pengawas')->with($form);
    }

    public function halamanTambahPengawas()
    {
        // Redirect ke halaman tambah pengawas
        return view('pengawas.halaman-tambah-pengawas');
    }

    public function prosesTambahPengawas(Request $form)
    {
        // Ambil data pengawas dari form
        $dataPengawas = [
            'username' => $form->username,
            'nama' => $form->nama,
            'no_tlp' => $form->no_tlp,
            'alamat' => $form->alamat,
            'password' => Hash::make($form->password),
            'email' => $form->email,
            'jenis_kelamin' => $form->jenis_kelamin,
        ];

        // Insert data pengawas ke database
        Pengawas::create($dataPengawas);

        // Redirect ke halaman utama pengawas
        return redirect()->route('halamanUtamaPengawas')->with('success', 'Berhasil menambah data pengawas.');
    }

    public function halamanDetailPengawas($id)
    {
        // Ambil data pengawas berdasarkan ID
        $form['pengawas'] = Pengawas::find($id);

        // Redirect ke halaman detail pengawas
        return view('pengawas.halaman-detail-pengawas')->with($form);
    }


    public function halamanUbahPengawas($id)
    {
        // Ambil data pengawas yang ingin diubah, ambil berdasarkan ID
        $form['pengawas'] = Pengawas::find($id);

        // Redirect ke halaman ubah pengawas, beserta dengan data pengawas 
        return view('pengawas.halaman-ubah-pengawas')->with($form);
    }

    public function prosesUbahPengawas(Request $form, $id)
    {
        // Ambil data pengawas berdasarkan ID
        $pengawas = Pengawas::find($id);

        // Ambil data pengawas terbaru dari form
        $dataPengawas = [
            'username' => $form->username,
            'nama' => $form->nama,
            'no_tlp' => $form->no_tlp,
            'alamat' => $form->alamat,
            'password' => $form->password ? Hash::make($form->password) : $pengawas->password,
            'email' => $form->email,
            'jenis_kelamin' => $form->jenis_kelamin,
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
        $form['pegawai'] = Pegawai::all();

        // Redirect ke halaman pegawai, beserta dengan data pegawai 
        return view('pegawai.halaman-utama-pegawai')->with($form);
    }

    public function halamanTambahPegawai()
    {
        // Redirect ke halaman tambah pegawai
        return view('pegawai.halaman-tambah-pegawai');
    }

    public function prosesTambahPegawai(Request $form)
    {
        // Ambil data pegawai dari form
        $dataPegawai = [
            'username' => $form->username,
            'nama' => $form->nama,
            'no_tlp' => $form->no_tlp,
            'alamat' => $form->alamat,
            'password' => Hash::make($form->password),
            'email' => $form->email,
            'jenis_kelamin' => $form->jenis_kelamin,
        ];

        // Insert data pegawai ke database
        Pegawai::create($dataPegawai);

        // Redirect ke halaman utama pegawai
        return redirect()->route('halamanUtamaPegawai')->with('success', 'Berhasil menambah data pegawai.');
    }

    public function halamanDetailPegawai($id)
    {
        // Ambil data pegawai berdasarkan ID
        $form['pegawai'] = Pegawai::find($id);

        // Redirect ke halaman detail pegawai
        return view('pegawai.halaman-detail-pegawai')->with($form);
    }

    public function halamanUbahPegawai($id)
    {
        // Ambil data pegawai yang ingin diubah, ambil berdasarkan ID
        $form['pegawai'] = Pegawai::find($id);

        // Redirect ke halaman ubah pegawai, beserta dengan data pegawai 
        return view('pegawai.halaman-ubah-pegawai')->with($form);
    }

    public function prosesUbahPegawai(Request $form, $id)
    {
        // Ambil data pegawai berdasarkan ID
        $pegawai = Pegawai::find($id);

        // Ambil data pegawai terbaru dari form
        $dataPegawai = [
            'username' => $form->username,
            'nama' => $form->nama,
            'no_tlp' => $form->no_tlp,
            'alamat' => $form->alamat,
            'password' => $form->password ? Hash::make($form->password) : $pegawai->password,
            'email' => $form->email,
            'jenis_kelamin' => $form->jenis_kelamin,
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
     * KELOLA DIREKTUR
     */

    public function halamanUtamaDirektur()
    {
        // Ambil semua data direktur yang ingin ditampilkan
        $form['direktur'] = Direktur::all();

        // Redirect ke halaman direktur, beserta dengan data direktur 
        return view('direktur.halaman-utama-direktur')->with($form);
    }

    public function halamanTambahDirektur()
    {
        // Redirect ke halaman tambah direktur
        return view('direktur.halaman-tambah-direktur');
    }

    public function prosesTambahDirektur(Request $form)
    {
        // Ambil data direktur dari form
        $dataDirektur = [
            'username' => $form->username,
            'nama' => $form->nama,
            'no_tlp' => $form->no_tlp,
            'alamat' => $form->alamat,
            'password' => Hash::make($form->password),
            'email' => $form->email,
            'jenis_kelamin' => $form->jenis_kelamin,
        ];

        // Insert data direktur ke database
        Direktur::create($dataDirektur);

        // Redirect ke halaman utama direktur
        return redirect()->route('halamanUtamaDirektur')->with('success', 'Berhasil menambah data direktur.');
    }

    public function halamanDetailDirektur($id)
    {
        // Ambil data direktur berdasarkan ID
        $form['direktur'] = Direktur::find($id);

        // Redirect ke halaman detail direktur
        return view('direktur.halaman-detail-direktur')->with($form);
    }

    public function halamanUbahDirektur($id)
    {
        // Ambil data direktur yang ingin diubah, ambil berdasarkan ID
        $form['direktur'] = Direktur::find($id);

        // Redirect ke halaman ubah direktur, beserta dengan data direktur 
        return view('direktur.halaman-ubah-direktur')->with($form);
    }

    public function prosesUbahDirektur(Request $form, $id)
    {
        // Ambil data direktur berdasarkan ID
        $direktur = Direktur::find($id);

        // Ambil data direktur terbaru dari form
        $dataDirektur = [
            'username' => $form->username,
            'nama' => $form->nama,
            'no_tlp' => $form->no_tlp,
            'alamat' => $form->alamat,
            'password' => $form->password ? Hash::make($form->password) : $direktur->password,
            'email' => $form->email,
            'jenis_kelamin' => $form->jenis_kelamin,
        ];

        // Ubah data direktur di database
        $direktur->update($dataDirektur);

        // Redirect ke halaman utama direktur
        return redirect()->route('halamanUtamaDirektur')->with('success', 'Berhasil mengubah data direktur verifikasi.');
    }

    public function prosesHapusDirektur($id)
    {
        // Ambil data direktur berdasarkan ID
        $direktur = Direktur::find($id);

        // Hapus direktur tersebut
        $direktur->delete();

        // Redirect ke halaman utama direktur
        return redirect()->route('halamanUtamaDirektur')->with('success', 'Berhasil menghapus data direktur verifikasi.');
    }

    /**
     * KELOLA NASABAH
     */

    public function halamanUtamaNasabah()
    {
        // Ambil semua data nasabah yang ingin ditampilkan
        $form['nasabah'] = Nasabah::all();

        // Redirect ke halaman nasabah, beserta dengan data nasabah 
        return view('nasabah.halaman-utama-nasabah')->with($form);
    }

    public function halamanTambahNasabah()
    {
        // Redirect ke halaman tambah nasabah
        return view('nasabah.halaman-tambah-nasabah');
    }

    public function prosesTambahNasabah(Request $form)
    {
        // Ambil data nasabah dari form
        $dataNasabah = [
            'id_pegawai' => $form->id_pegawai,
            'kode_nasabah' => $form->kode_nasabah,
            'nama' => $form->nama,
            'pekerjaan' => $form->pekerjaan,
            'alamat' => $form->alamat,
            'tanggal_lahir' => $form->tanggal_lahir,
            'status_pinjam' => 0,
        ];

        // Insert data nasabah ke database
        Nasabah::create($dataNasabah);

        // Redirect ke halaman utama nasabah
        return redirect()->route('halamanUtamaNasabah')->with('success', 'Berhasil menambah data nasabah.');
    }

    public function halamanDetailNasabah($id)
    {
        // Ambil data nasabah berdasarkan ID
        $form['nasabah'] = Nasabah::find($id);

        // Redirect ke halaman detail nasabah
        return view('nasabah.halaman-detail-nasabah')->with($form);
    }

    public function halamanUbahNasabah($id)
    {
        // Ambil data nasabah yang ingin diubah, ambil berdasarkan ID
        $form['nasabah'] = Nasabah::find($id);

        // Redirect ke halaman ubah nasabah, beserta dengan data nasabah 
        return view('nasabah.halaman-ubah-nasabah')->with($form);
    }

    public function prosesUbahNasabah(Request $form, $id)
    {
        // Ambil data nasabah berdasarkan ID
        $nasabah = Nasabah::find($id);

        // Ambil data nasabah terbaru dari form
        $dataNasabah = [
            'kode_nasabah' => $form->kode_nasabah,
            'nama' => $form->nama,
            'pekerjaan' => $form->pekerjaan,
            'alamat' => $form->alamat,
            'tanggal_lahir' => $form->tanggal_lahir,
        ];

        // Ubah data nasabah di database
        $nasabah->update($dataNasabah);

        // Redirect ke halaman utama nasabah
        return redirect()->route('halamanUtamaNasabah')->with('success', 'Berhasil mengubah data nasabah.');
    }

    public function prosesHapusNasabah($id)
    {
        // Ambil data nasabah berdasarkan ID
        $nasabah = Nasabah::find($id);

        // Hapus nasabah tersebut
        $nasabah->delete();

        // Redirect ke halaman utama nasabah
        return redirect()->route('halamanUtamaNasabah')->with('success', 'Berhasil menghapus data nasabah.');
    }
}
