<?php

namespace App\Http\Controllers;

use App\Mail\LupaPasswordMail;
use App\Models\Nasabah;
use App\Models\Pegawai;
use App\Models\Pengawas;
use App\Models\Direktur;
use App\Models\Kas;
use App\Models\KitirKredit;
use App\Models\NoPinjaman;
use App\Models\NoTabungan;
use App\Models\PermohonanPinjam;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Mail;

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

    // Fungsi untuk logout
    public function prosesLogout()
    {
        auth()->guard(request()->guard)->logout();
        return redirect()->route('halamanLogin');
    }

    // Fungsi untuk masuk ke halaman lupa password
    public function halamanLupaPassword(Request $form)
    {
        return view('lupa-password', $form->all());
    }

    // Fungsi untuk mengirim email lupa password ke alamat email user
    public function emailLupaPassword(Request $form)
    {
        // Ambil data email dari form
        $email = $form->email;
        $type = $form->guard;

        // Validasi, pastikan email terdaftar pada sistem
        $form->validate([
            'email' => "required|email|exists:$type,email"
        ]);

        // Proses pengiriman email
        Mail::send(new LupaPasswordMail($email, $type));

        return redirect()->back()->with('success', 'Berhasil mengirim link, silahkan periksa kotak pesan email anda.');
    }

    // Fungsi untuk melakukan reset password
    public function prosesLupaPassword(Request $form)
    {
        // Konfirmasi kecocokan password
        $form->validate([
            'password' => 'required|confirmed',
        ]);

        // Ubah password berdasarkan jenis pengguna
        switch ($form->type) {
            case 'pegawai':
                // Ubah password jika berjenis pegawai
                Pegawai::where('email', $form->email)->update([
                    'password' => Hash::make($form->password)
                ]);
                break;
            case 'pengawas':
                // Ubah password jika berjenis pengawas
                Pengawas::where('email', $form->email)->update([
                    'password' => Hash::make($form->password)
                ]);
                break;
            case 'direktur':
                // Ubah password jika berjenis direktur
                Direktur::where('email', $form->email)->update([
                    'password' => Hash::make($form->password)
                ]);
                break;
        }

        return redirect()->route('halamanLogin')->with('success', 'Berhasil mengubah password, silahkan lakukan proses login.');
    }

    /**
     * DASHBOARD
     */

    public function halamanDashboard()
    {
        // Siapkan data untuk tampilan dashboard
        $data = [
            'totalSimpanan' => Kas::getTotal(),
            'totalPinjaman' => PermohonanPinjam::getTotal(),
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
        $data['kas'] = Kas::orderByDesc('tanggal')->get();

        // Redirect ke halaman kas, beserta dengan data kas
        return view('kas.halaman-utama-kas')->with($data);
    }

    public function halamanTambahKasSimpanan()
    {
        // Ambil seluruh data tabungan
        $data['noTabungan'] = NoTabungan::with(['nasabah'])->orderBy('no_tabungan')->get();

        // Redirect ke halaman tambah kas
        return view('kas.halaman-tambah-kas')->with($data);
    }

    public function halamanTarikKasSimpanan()
    {
        // Ambil seluruh data tabungan
        $data['noTabungan'] = NoTabungan::with(['nasabah'])->orderBy('no_tabungan')->get();

        // Redirect ke halaman tarik kas
        return view('kas.halaman-tarik-kas')->with($data);
    }

    public function prosesTambahKasSimpanan(Request $form)
    {
        // Ambil data kas dari form
        $dataKas = [
            'id_tabungan' => $form->id_tabungan,
            'jenis' => 'Uang Masuk',
            'nominal' => $form->nominal,
            'total' => $form->nominal,
            'tanggal' => now(),
        ];

        // Insert data kas simpanan ke database
        Kas::create($dataKas);

        // Redirect ke halaman utama kas simpanan
        return redirect()->route('halamanUtamaKasSimpanan')->with('success', 'Berhasil menambah data kas simpanan.');
    }

    public function prosesTarikKasSimpanan(Request $form)
    {
        // Check agar jumlah penarikan tidak melebihi jumlah saldo
        if ($form->saldo >= $form->nominal) {
            // Ambil data kas dari form
            $dataKas = [
                'id_tabungan' => $form->id_tabungan,
                'jenis' => 'Uang Keluar',
                'nominal' => $form->nominal,
                'total' => $form->nominal,
                'tanggal' => now(),
            ];

            // Insert data kas simpanan ke database
            Kas::create($dataKas);

            // Redirect ke halaman utama kas simpanan
            return redirect()->route('halamanUtamaKasSimpanan')->with('success', 'Berhasil melakukan penarikan kas simpanan.');
        } else {
            return back()->with('failed', 'Jumlah penarikan tidak boleh melebihi saldo nasabah.')->withInput($form->all());
        }
    }

    public function halamanDetailKasSimpanan($id)
    {
        // Ambil data kas, beserta dengan data tabungannya
        $data['kas'] = Kas::with(['tabungan'])->find($id);

        // Redirect ke halaman detail kas
        return view('kas.halaman-detail-kas')->with($data);
    }

    /**
     * KELOLA NO PINJAMAN
     */

    public function halamanUtamaNoPinjaman()
    {
        // Ambil semua data no pinjaman yang ingin ditampilkan
        $data['noPinjaman'] = NoPinjaman::all();

        // Redirect ke halaman no pinjaman, beserta dengan data no pinjaman
        return view('no-pinjaman.halaman-utama-no-pinjaman')->with($data);
    }

    public function halamanTambahNoPinjaman()
    {
        // Generate nomor pinjaman, otomatis oleh sistem
        $data['noPinjaman'] = NoPinjaman::generateNoPinjaman();
        $data['nasabah'] = Nasabah::all();

        // Redirect ke halaman tambah no pinjaman
        return view('no-pinjaman.halaman-tambah-no-pinjaman')->with($data);
    }

    public function prosesTambahNoPinjaman(Request $form)
    {
        // Ambil data nomor pinjaman dari form
        $dataNoPinjaman = [
            'no_pinjaman' => $form->no_pinjaman,
            'id_nasabah' => $form->id_nasabah,
        ];

        // Insert data no pinjaman ke database
        NoPinjaman::create($dataNoPinjaman);

        // Redirect ke halaman utama no pinjaman
        return redirect()->route('halamanUtamaNoPinjaman')->with('success', 'Berhasil menambah data no pinjaman.');
    }

    public function halamanDetailNoPinjaman($id)
    {
        // Ambil data no pinjaman, beserta dengan data nasabah dan kas
        $data['noPinjaman'] = NoPinjaman::with(['nasabah', 'pinjaman'])->find($id);

        // Redirect ke halaman detail no pinjaman
        return view('no-pinjaman.halaman-detail-no-pinjaman')->with($data);
    }

    public function prosesHapusNoPinjaman($id)
    {
        // Ambil data no pinjaman berdasarkan ID
        $noPinjaman = NoPinjaman::find($id);

        // Hapus no pinjaman, beserta data kas
        $noPinjaman->delete();

        // Redirect ke halaman utama no pinjaman
        return redirect()->route('halamanUtamaNoPinjaman')->with('success', 'Berhasil menghapus data no pinjaman.');
    }

    /**
     * KELOLA PINJAMAN
     */

    public function halamanUtamaPinjaman()
    {
        // Ambil semua data pinjaman yang ingin ditampilkan, beserta data noPinjaman dan kitirKredit
        $data['pinjaman'] = PermohonanPinjam::with(['noPinjaman', 'kitirKredit'])->orderByDesc('tanggal')->get();

        // Redirect ke halaman pinjaman, beserta dengan data pinjaman
        return view('pinjaman.halaman-utama-pinjaman')->with($data);
    }

    public function halamanTambahPinjaman()
    {
        // Ambil seluruh data no pinjaman
        $data['noPinjaman'] = NoPinjaman::with(['nasabah'])->orderBy('no_pinjaman')->get();

        // Redirect ke halaman tambah pinjaman
        return view('pinjaman.halaman-tambah-pinjaman')->with($data);
    }

    public function prosesTambahPinjaman(Request $form)
    {
        // Ambil data pinjaman dari form
        $dataPinjaman = [
            'id_pinjaman' => $form->id_pinjaman,
            'besar_permohonan_pinjam' => $form->besar_permohonan_pinjam,
            'jumlah_angsuran' => get_angsuran($form),
            'jangka_waktu' => get_jangka_waktu($form),
            'tanggal' => now(),
            'tanggal_terakhir_bayar' => now()->addMonth(1)->toDateTime(), // Terakhir bayar bulan depan
        ];

        // Insert data pinjaman simpanan ke database
        $pinjaman = PermohonanPinjam::create($dataPinjaman);

        // Siapkan tagihan kitir untuk bulan pertama
        $pokok = $dataPinjaman['jumlah_angsuran'];
        $bunga = get_bunga($dataPinjaman['besar_permohonan_pinjam'], 1.5);
        $dataKitir = [
            'id_permohonan_pinjam' => $pinjaman->id_permohonan_pinjam,
            'pokok' => $pokok,
            'bunga' => $bunga,
            'status' => false,
        ];

        // Insert data kitir kredit ke database
        KitirKredit::create($dataKitir);

        // Redirect ke halaman utama pinjaman
        return redirect()->route('halamanUtamaPinjaman')->with('success', 'Berhasil menambah data pinjaman.');
    }

    public function halamanDetailPinjaman($id)
    {
        // Ambil data pinjaman, beserta dengan data no pinjaman dan kitir kredit
        $data['pinjaman'] = PermohonanPinjam::with(['noPinjaman', 'kitirKredit'])->find($id);

        // Redirect ke halaman detail pinjaman
        return view('pinjaman.halaman-detail-pinjaman')->with($data);
    }

    public function prosesVerifikasiPinjaman($id)
    {
        // Ambil data pinjaman yang ingin diverifikasi berdasarkan ID
        $pinjaman = PermohonanPinjam::find($id);

        // Ubah status pinjaman menjadi verified
        $pinjaman->update([
            'status' => true,
        ]);

        // Redirect kembali ke halaman utama pinjaman
        return back()->with('success', 'Berhasil melakukan verifikasi pinjaman.');
    }

    public function prosesBatalVerifikasiPinjaman($id)
    {
        // Ambil data pinjaman berdasarkan ID
        $pinjaman = PermohonanPinjam::find($id);

        // Ubah status pinjaman menjadi false / unverified
        $pinjaman->update([
            'status' => false,
        ]);

        // Redirect kembali ke halaman utama pinjaman
        return back()->with('success', 'Berhasil membatalkan verifikasi pinjaman.');
    }

    public function prosesBayarPinjaman($id)
    {
        // Ambil data kitir yang ingin dibayar
        $kitir = KitirKredit::find($id);

        // Ubah status kitir menjadi true / sudah bayar
        $kitir->update([
            'status' => true,
            'denda' => $kitir->denda,
            'jumlah' => $kitir->jumlah,
            'sisa_pinjam' => $kitir->permohonanPinjam->sisa_pinjam - $kitir->pokok,
            'tanggal_transaksi' => now(),
        ]);

        // Ubah tanggal terakhir bayar jadi bulan depan
        $pinjaman = $kitir->permohonanPinjam;
        $pinjaman->update([
            'tanggal_terakhir_bayar' => Carbon::make($pinjaman->tanggal_terakhir_bayar)->addMonth(1),
        ]);

        // Siapkan tagihan kitir untuk bulan depan, hanya jika pinjaman belum lunas
        // Jika pinjaman sudah lunas, maka kitir bulan depan tidak akan dibuat lagi
        if ($pinjaman->sisa_pinjam > 0) {
            $pokok = $pinjaman['jumlah_angsuran'];
            $bunga = get_bunga($pinjaman->sisa_pinjam, 1.5);

            if ($pinjaman->sisa_pinjam < $pokok) {
                $pokok = $pinjaman->sisa_pinjam;
            }

            $dataKitir = [
                'id_permohonan_pinjam' => $pinjaman->id_permohonan_pinjam,
                'pokok' => $pokok,
                'bunga' => $bunga,
                'status' => false,
            ];

            // Insert data kitir kredit ke database
            KitirKredit::create($dataKitir);
        }

        // Kalau sisa pinjaman sudah tersisa 0, maka ubah status pinjaman menjadi true / lunas
        if ($pinjaman->sisa_pinjam == 0) {
            $pinjaman->update([
                'status' => true,
            ]);
        }

        // Redirect kembali ke halaman utama pinjaman
        return back()->with('success', 'Berhasil melakukan pembayaran angsuran pinjaman.');
    }
}
