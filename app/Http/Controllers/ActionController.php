<?php

namespace App\Http\Controllers;

use App\Models\Nasabah;
use App\Models\Pegawai;
use App\Models\Pengawas;
use App\Models\Direktur;
use App\Models\Kas;
use App\Models\NoTabungan;
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
            'totalSimpanan' => Kas::sum('nominal'),
            'totalPinjaman' => 0,
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
        $data['pengawas'] = Pengawas::all();

        // Redirect ke halaman pengawas, beserta dengan data pengawas
        return view('pengawas.halaman-utama-pengawas')->with($data);
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
        $data['pegawai'] = Pegawai::all();

        // Redirect ke halaman pegawai, beserta dengan data pegawai
        return view('pegawai.halaman-utama-pegawai')->with($data);
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
        $data['direktur'] = Direktur::all();

        // Redirect ke halaman direktur, beserta dengan data direktur
        return view('direktur.halaman-utama-direktur')->with($data);
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
        $data['direktur'] = Direktur::find($id);

        // Redirect ke halaman detail direktur
        return view('direktur.halaman-detail-direktur')->with($data);
    }

    public function halamanUbahDirektur($id)
    {
        // Ambil data direktur yang ingin diubah, ambil berdasarkan ID
        $data['direktur'] = Direktur::find($id);

        // Redirect ke halaman ubah direktur, beserta dengan data direktur
        return view('direktur.halaman-ubah-direktur')->with($data);
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
        $data['nasabah'] = Nasabah::all();

        // Redirect ke halaman nasabah, beserta dengan data nasabah
        return view('nasabah.halaman-utama-nasabah')->with($data);
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
        $data['nasabah'] = Nasabah::find($id);

        // Redirect ke halaman detail nasabah
        return view('nasabah.halaman-detail-nasabah')->with($data);
    }

    public function halamanUbahNasabah($id)
    {
        // Ambil data nasabah yang ingin diubah, ambil berdasarkan ID
        $data['nasabah'] = Nasabah::find($id);

        // Redirect ke halaman ubah nasabah, beserta dengan data nasabah
        return view('nasabah.halaman-ubah-nasabah')->with($data);
    }

    public function prosesUbahNasabah(Request $form, $id)
    {
        // Ambil data nasabah berdasarkan ID
        $nasabah = Nasabah::find($id);

        // Ambil data nasabah terbaru dari form
        $dataNasabah = [
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

    /**
     * KELOLA NO TABUNGAN
     */

    public function halamanUtamaNoTabungan()
    {
        // Ambil semua data no tabungan yang ingin ditampilkan
        $data['noTabungan'] = NoTabungan::all();

        // Redirect ke halaman no tabungan, beserta dengan data no tabungan
        return view('no-tabungan.halaman-utama-no-tabungan')->with($data);
    }

    public function halamanTambahNoTabungan()
    {
        // Generate nomor tabungan, otomatis oleh sistem
        $data['noTabungan'] = NoTabungan::generateNoTabungan();
        $data['nasabah'] = Nasabah::all();

        // Redirect ke halaman tambah no tabungan
        return view('no-tabungan.halaman-tambah-no-tabungan')->with($data);
    }

    public function prosesTambahNoTabungan(Request $form)
    {
        // Ambil data nomor tabungan dari form
        $dataNoTabungan = [
            'no_tabungan' => $form->no_tabungan,
            'id_nasabah' => $form->id_nasabah,
        ];

        // Insert data no tabungan ke database
        NoTabungan::create($dataNoTabungan);

        // Redirect ke halaman utama no tabungan
        return redirect()->route('halamanUtamaNoTabungan')->with('success', 'Berhasil menambah data no tabungan.');
    }

    public function halamanDetailNoTabungan($id)
    {
        // Ambil data no tabungan, beserta dengan data nasabah dan kas
        $data['noTabungan'] = NoTabungan::with(['nasabah', 'kas'])->find($id);

        // Redirect ke halaman detail no tabungan
        return view('no-tabungan.halaman-detail-no-tabungan')->with($data);
    }

    public function prosesHapusNoTabungan($id)
    {
        // Ambil data no tabungan berdasarkan ID
        $noTabungan = NoTabungan::find($id);

        // Hapus no tabungan, beserta data kas
        $noTabungan->kas()?->delete();
        $noTabungan->delete();

        // Redirect ke halaman utama no tabungan
        return redirect()->route('halamanUtamaNoTabungan')->with('success', 'Berhasil menghapus data no tabungan.');
    }

    /**
     * KELOLA KAS SIMPANAN
     */

    public function halamanUtamaKasSimpanan()
    {
        // Ambil semua data kas yang ingin ditampilkan
        $data['kas'] = Kas::all();

        // Redirect ke halaman kas, beserta dengan data kas
        return view('kas.halaman-utama-kas')->with($data);
    }

    public function halamanTambahKasSimpanan()
    {
        // Ambil seluruh data tabungan
        $data['noTabungan'] = NoTabungan::with(['nasabah'])->orderBy('no_tabungan')->get();

        // Redirect ke halaman tambah no tabungan
        return view('kas.halaman-tambah-kas')->with($data);
    }

    public function prosesTambahKasSimpanan(Request $form)
    {
        // Ambil data kas dari form
        $dataKas = [
            'id_tabungan' => $form->id_tabungan,
            'nominal' => $form->nominal,
            'total' => $form->nominal,
            'tanggal' => now(),
        ];

        // Insert data kas simpanan ke database
        Kas::create($dataKas);

        // Redirect ke halaman utama kas simpanan
        return redirect()->route('halamanUtamaKasSimpanan')->with('success', 'Berhasil menambah data kas simpanan.');
    }

    public function halamanDetailKasSimpanan($id)
    {
        // Ambil data kas, beserta dengan data tabungannya
        $data['kas'] = Kas::with(['tabungan'])->find($id);

        // Redirect ke halaman detail kas
        return view('kas.halaman-detail-kas')->with($data);
    }
}
