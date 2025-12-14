<?php

namespace App\Controllers;

use App\Libraries\SuratWordService; // pastikan namespace benar

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use App\Models\AdminModel;
use App\Models\KontakModel;
use App\Models\KlienModel;
use App\Models\PerkaraModel;
use App\Models\PengacaraModel;
use App\Models\JadwalPertemuanModel;
use App\Models\JadwalModel;
use App\Models\HonorModel;
use App\Models\SuratKuasaModel;
use App\Models\DokumenPerkaraModel;
use App\Models\PengeluaranUangModel;
use App\Models\TabelBarcodeModel;




class Admin extends BaseController
{
    protected $honorModel;
    protected $pengacaraModel;
    protected $suratKuasaModel;
    protected $klienModel;
    protected $perkaraModel;
    protected $DokumenPerkaraModel;
    protected $AdminModel;
    protected $KontakModel;
    protected $tabelBarcodeModel;
    protected $suratWordService; // ✅ deklarasikan property



     public function __construct()
    {
        $this->adminModel      = new AdminModel();
        $this->honorModel = new HonorModel();
        $this->pengacaraModel = new PengacaraModel();
        $this->suratKuasaModel = new SuratKuasaModel();
        $this->klienModel      = new KlienModel();
        $this->perkaraModel      = new PerkaraModel();
        $this->dokumenPerkaraModel = new DokumenPerkaraModel();
        $this->suratWordService = new SuratWordService();


    }
    // ==========================
    // DASHBOARD
    // ==========================
    public function dashboard()
    {
        
        $adminModel = new \App\Models\AdminModel();
        $pembayaranModel = new \App\Models\PembayaranModel();
        $perkaraModel = new \App\Models\PerkaraModel();


        // Ambil semua pengguna (untuk keperluan lain, misal list dropdown)
        $users = $adminModel->findAll();

        // Ambil pengguna pertama
        $admin = $adminModel->first(); 
        $username = $admin['username'] ?? 'Admin';
        $email    = $admin['email'] ?? '-';
        $peran    = $admin['peran'] ?? '-';

        $totalAkun = $adminModel->countAll();
        // Total data transaksi pembayaran
        $totalPembayaran = $pembayaranModel->countAll();
        $totalNominal = $pembayaranModel->selectSum('jumlah')->first()['jumlah'] ?? 0;
        // 
        $totalPerkara = $perkaraModel->countAll();
        $listPerkara = $perkaraModel
        ->select('
            tabel_perkara.*, 
            tabel_klien.nama as nama_klien, 
            tabel_jenis_perkara.nama_jenis as jenis_kasus, 
            tabel_pengacara.nama as nama_pengacara,
            tabel_status_perkara.nama_status as status
        ')
        ->join('tabel_klien', 'tabel_klien.id = tabel_perkara.id_klien')
        ->join('tabel_jenis_perkara', 'tabel_jenis_perkara.id = tabel_perkara.jenis_kasus')
        ->join('tabel_pengacara', 'tabel_pengacara.id = tabel_perkara.id_pengacara')
        ->join('tabel_status_perkara', 'tabel_status_perkara.id = tabel_perkara.status')
        ->findAll();

        $kontakModel = new KontakModel();

        $kontak = $kontakModel
            ->where('is_read', 0)
            ->orderBy('created_at', 'DESC')
            ->findAll();

     // Hitung total pengacara
        $pengacaraModel = new \App\Models\PengacaraModel();
        $jumlahPengacara = $pengacaraModel->countAll();

        // Atau bisa juga pakai builder (pilih salah satu):
        // $db      = \Config\Database::connect();
        // $jumlahPengacara = $db->table('tabel_pengacara')->countAllResults();

        $data = [
            'judul'           => '',
            'username'        => $username,
            'email'           => $email,
            'peran'           => $peran,
            'totalAkun'       => $totalAkun,
            'totalPembayaran' => $totalPembayaran,
            'totalNominal'    => $totalNominal,
            'totalPerkara'    => $totalPerkara,
            'listPerkara'     => $listPerkara,
            'kontak'          => $kontak,
            'jumlahPengacara' => $jumlahPengacara
        ];

        echo view('temp_admin/head', $data);
        echo view('temp_admin/header', $data);
        echo view('temp_admin/nav', $data);
        echo view('temp_admin/dashboard', $data);
        echo view('temp_admin/footer', $data);
        }

// Controller Admin/Dashboard.php
public function markAllRead()
{
    $kontakModel = new \App\Models\KontakModel();
    $kontakModel->set(['is_read' => 1])->where('is_read', 0)->update();
    return $this->response->setJSON(['status' => 'success']);
}


public function tagihan()
{
    $tagihanModel = new \App\Models\TagihanModel();
    $klienModel   = new \App\Models\KlienModel();
    $perkaraModel = new \App\Models\PerkaraModel();
    $adminModel   = new \App\Models\AdminModel();

    // Ambil semua pengguna (untuk keperluan lain, misal list dropdown)
    $users = $adminModel->findAll();

    // Ambil pengguna pertama
    $admin = $adminModel->first(); 
    $username = $admin['username'] ?? 'Admin';
    $email    = $admin['email'] ?? '-';
    $peran    = $admin['peran'] ?? '-';

    // Ambil semua tagihan beserta nama klien dan nomor perkara
    $tagihan = $tagihanModel->select('
        tabel_tagihan.*,
        tabel_klien.nama AS nama_klien,
        tabel_perkara.nomor_perkara
    ')
    ->join('tabel_klien', 'tabel_klien.id = tabel_tagihan.id_klien', 'left')
    ->join('tabel_perkara', 'tabel_perkara.id = tabel_tagihan.id_perkara', 'left')
    ->orderBy('tanggal_terbit', 'DESC')
    ->findAll();

    // Ambil semua klien dan perkara untuk dropdown modal
    $klien   = $klienModel->findAll();
    $perkara = $perkaraModel->findAll();
    $kontakModel = new KontakModel();

        $kontak = $kontakModel
            ->where('is_read', 0)
            ->orderBy('created_at', 'DESC')
            ->findAll();

    $data = [
        'judul'   => 'Daftar Tagihan',
        'username'=> $username,
        'email'   => $email,
        'peran'   => $peran,
        'tagihan' => $tagihan,
        'klien'   => $klien,
        'perkara' => $perkara,
        'kontak'    => $kontak
    ];

    // Jika request AJAX, kirim JSON
    if ($this->request->isAJAX()) {
        return $this->response->setJSON($tagihan);
    }

    return view('temp_admin/head', $data)
        . view('temp_admin/header', $data)
        . view('temp_admin/nav', $data)
        . view('temp_admin/tagihan/list', $data)
        . view('temp_admin/footer');
}
public function tambahTagihan()
{
    $model = new \App\Models\TagihanModel();

    // Validasi input
    if (!$this->validate([
        'id_klien' => 'required|integer',
        'id_perkara' => 'required|integer',
        'jumlah' => 'required|numeric',
        'status' => 'required|in_list[Belum Lunas,Lunas]',
        'tanggal_terbit' => 'required|valid_date',
        'tanggal_jatuh_tempo' => 'required|valid_date'
    ])) {
        // Jika validasi gagal, redirect kembali dengan error
        return redirect()->back()->withInput()->with('error', 'Data tagihan tidak valid.');
    }

    // Ambil data dari form
    $data = [
        'id_klien' => $this->request->getPost('id_klien'),
        'id_perkara' => $this->request->getPost('id_perkara'),
        'jumlah' => $this->request->getPost('jumlah'),
        'deskripsi' => $this->request->getPost('deskripsi'),
        'status' => $this->request->getPost('status'),
        'tanggal_terbit' => $this->request->getPost('tanggal_terbit'),
        'tanggal_jatuh_tempo' => $this->request->getPost('tanggal_jatuh_tempo'),
        'dibuat_pada' => date('Y-m-d H:i:s')
    ];

    // Simpan ke database
    if ($model->insert($data)) {
        session()->setFlashdata('success', 'Tagihan berhasil ditambahkan!');
    } else {
        session()->setFlashdata('error', 'Gagal menambahkan tagihan.');
    }

    return redirect()->to(base_url('admin/tagihan'));
}

public function updateTagihan()
{
    $post = $this->request->getPost();
    $tagihanModel = new \App\Models\TagihanModel();

    // Validasi ID tagihan
    if (empty($post['id'])) {
        return redirect()->back()->with('error', 'ID tagihan tidak ditemukan.');
    }

    // Pastikan semua field ada agar tidak error undefined index
    $id_klien         = $post['id_klien']          ?? null;
    $id_perkara       = $post['id_perkara']        ?? null;
    $jumlah           = $post['jumlah']            ?? null;
    $deskripsi        = $post['deskripsi']         ?? null;
    $status           = $post['status']            ?? null;
    $tanggal_terbit   = $post['tanggal_terbit']    ?? null;
    $tanggal_jatuh    = $post['tanggal_jatuh_tempo'] ?? null;

    // Data yang akan diupdate
    $updateData = [
        'id_klien'           => $id_klien,
        'id_perkara'         => $id_perkara,
        'jumlah'             => $jumlah,
        'deskripsi'          => $deskripsi,
        'status'             => $status,
        'tanggal_terbit'     => $tanggal_terbit,
        'tanggal_jatuh_tempo'=> $tanggal_jatuh
    ];

    // Jalankan update
    if (!$tagihanModel->update($post['id'], $updateData)) {
        return redirect()->back()
                         ->with('error', 'Gagal memperbarui tagihan!')
                         ->withInput();
    }

    return redirect()->to(base_url('admin/tagihan'))
                     ->with('success', 'Tagihan berhasil diperbarui!');
}


public function deleteTagihan($id = null)
{
    $model = new \App\Models\TagihanModel();

    if ($id === null) {
        return redirect()->to(base_url('admin/tagihan'))->with('error', 'ID tagihan tidak ditemukan.');
    }

    // Hapus data
    $model->delete($id);

    // Redirect dengan pesan sukses
    return redirect()->to(base_url('admin/tagihan'))->with('success', 'Tagihan berhasil dihapus!');
}

// HONORARIUM PENGACARA
public function honorariumPengacara()
{
    $honorModel     = new \App\Models\HonorModel();
    $pengacaraModel = new \App\Models\PengacaraModel();
    $adminModel     = new \App\Models\AdminModel();

    // Ambil admin pertama
    $admin = $adminModel->first(); 
    $username = $admin['username'] ?? 'Admin';
    $email    = $admin['email'] ?? '-';
    $peran    = $admin['peran'] ?? '-';

    // Ambil seluruh honorarium + join pengacara
    $honorarium = $honorModel->select('
            tabel_honorarium.*,
            tabel_pengacara.nama AS nama_pengacara
        ')
        ->join('tabel_pengacara', 'tabel_pengacara.id = tabel_honorarium.id_pengacara', 'left')
        ->orderBy('tabel_honorarium.created_at', 'DESC')
        ->findAll();

    // Ambil daftar pengacara untuk dropdown di modal tambah/edit
    $pengacara = $pengacaraModel->findAll();

    $kontakModel = new KontakModel();

        $kontak = $kontakModel
            ->where('is_read', 0)
            ->orderBy('created_at', 'DESC')
            ->findAll();

    $data = [
        'judul'      => 'Honorarium Pengacara',
        'honorarium' => $honorarium,
        'pengacara'  => $pengacara,
        'username'   => $username,
        'email'      => $email,
        'peran'      => $peran,
        'kontak'     => $kontak
    ];

    return view('temp_admin/head', $data)
        . view('temp_admin/header', $data)
        . view('temp_admin/nav', $data)
        . view('temp_admin/honorariumpengacara/list', $data)
        . view('temp_admin/footer');
}


public function proses_honorariumPengacara()
{
    $post = $this->request->getPost();

    // Ambil ID pengacara dari form
    $id_pengacara = $post['id_pengacara'] ?? null;
    $jumlah       = $post['jumlah'] ?? 0;
    $status       = $post['status'] ?? 'Belum Lunas';
    $keterangan   = $post['keterangan'] ?? null;

    // Validasi
    if (!$id_pengacara || !$jumlah) {
        return redirect()->back()->with('error', 'Pengacara dan jumlah honor wajib diisi.');
    }

    // Ambil data pengacara dari database
    $pengacara = $this->pengacaraModel->find($id_pengacara);

    if (!$pengacara) {
        return redirect()->back()->with('error', 'Data pengacara tidak ditemukan.');
    }

    // Ambil nama pengacara
    $namaPengacara = $pengacara['nama'];

    // Data yang disimpan
    $data = [
        'id_pengacara'   => $id_pengacara,
        'nama_pengacara' => $namaPengacara,
        'jumlah'         => $jumlah,
        'status'         => $status,
        'keterangan'     => $keterangan,
        'created_at'     => date('Y-m-d H:i:s')
    ];

    // Simpan
    $this->honorModel->insert($data);

    return redirect()->back()->with('success', 'Honorarium pengacara berhasil disimpan.');
}

public function updateHonorariumPengacara()
{
    $post = $this->request->getPost();

    $id_honor     = $post['id'] ?? null;
    $id_pengacara = $post['id_pengacara'] ?? null;
    $jumlah       = $post['jumlah'] ?? 0;
    $status       = $post['status'] ?? 'Belum Lunas';
    $keterangan   = $post['keterangan'] ?? null;

    // Validasi
    if (!$id_honor || !$id_pengacara || !$jumlah) {
        return redirect()->back()->with('error', 'Data honorarium tidak lengkap.');
    }

    // Ambil data pengacara
    $pengacara = $this->pengacaraModel->find($id_pengacara);
    if (!$pengacara) {
        return redirect()->back()->with('error', 'Data pengacara tidak ditemukan.');
    }

    $namaPengacara = $pengacara['nama'];

    // Data yang akan diupdate
    $data = [
        'id_pengacara'   => $id_pengacara,
        'nama_pengacara' => $namaPengacara,
        'jumlah'         => $jumlah,
        'status'         => $status,
        'keterangan'     => $keterangan,
        'created_at'     => date('Y-m-d H:i:s') // opsional, bisa biarkan lama
    ];

    // Update data
    $this->honorModel->update($id_honor, $data);

    return redirect()->back()->with('success', 'Honorarium pengacara berhasil diperbarui.');
}

public function suratKuasaWord($id)
{
    // Bersihkan semua buffer output
    while (ob_get_level()) {
        ob_end_clean();
    }

    $suratData = $this->suratKuasaModel->getSuratWithDetails($id);
    if (!$suratData) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException("Data surat tidak ditemukan");
    }

    // Kirim seluruh data ke service
    $this->suratWordService->generate($suratData);
}


public function suratKuasa()
{
    $suratModel    = new \App\Models\SuratKuasaModel();
    $adminModel    = new \App\Models\AdminModel();
    $klienModel    = new \App\Models\KlienModel();      // model tabel_klien
    $perkaraModel  = new \App\Models\PerkaraModel();    // model tabel_perkara

    // Ambil admin pertama
    $admin = $adminModel->first(); 
    $username = $admin['username'] ?? 'Admin';
    $email    = $admin['email'] ?? '-';
    $peran    = $admin['peran'] ?? '-';

    // Ambil data surat kuasa + join klien & perkara
    $suratKuasa = $suratModel->select('
            tabel_surat_kuasa.*,
            tabel_klien.nama AS nama_klien,
            tabel_perkara.nomor_perkara,
            tabel_surat_kuasa.tanggal
        ')
        ->join('tabel_klien', 'tabel_klien.id = tabel_surat_kuasa.id_klien', 'left')
        ->join('tabel_perkara', 'tabel_perkara.id = tabel_surat_kuasa.id_perkara', 'left')
        ->orderBy('tabel_surat_kuasa.created_at', 'DESC')
        ->findAll();

    // Ambil semua klien & perkara untuk dropdown modal
    $klien    = $klienModel->findAll();
    $perkara  = $perkaraModel->findAll();

    $kontakModel = new KontakModel();

        $kontak = $kontakModel
            ->where('is_read', 0)
            ->orderBy('created_at', 'DESC')
            ->findAll();

    $data = [
        'judul'       => 'Daftar Surat Kuasa',
        'suratKuasa'  => $suratKuasa,
        'username'    => $username,
        'email'       => $email,
        'peran'       => $peran,
        'klien'       => $klien,       // kirim ke view
        'perkara'     => $perkara,
        'kontak'      => $kontak     // kirim ke view
    ];

    return view('temp_admin/head', $data)
        . view('temp_admin/header', $data)
        . view('temp_admin/nav', $data)
        . view('temp_admin/suratkuasa/list', $data)
        . view('temp_admin/footer');
}


public function proses_suratKuasa()
{
    $post = $this->request->getPost();

    // Ambil input dengan fallback null jika tidak ada
    $id_klien      = isset($post['id_klien']) ? (int)$post['id_klien'] : null;
    $id_perkara    = isset($post['id_perkara']) ? (int)$post['id_perkara'] : null;
    $deskripsi     = $post['deskripsi'] ?? null;
    $tanggal       = $post['tanggal'] ?? date('Y-m-d');

    // Field tambahan
    $nik           = $post['nik'] ?? null;
    $ttl           = $post['ttl'] ?? null;
    $jenis_kelamin = $post['jenis_kelamin'] ?? null;
    $pekerjaan     = $post['pekerjaan'] ?? null;
    $alamat        = $post['alamat'] ?? null;
    $penerima      = $post['penerima'] ?? null;
    $alamat_kantor = $post['alamat_kantor'] ?? null;

    // Validasi sederhana
    if (!$id_klien || !$id_perkara) {
        return redirect()->back()->with('error', 'Klien dan Perkara wajib dipilih.');
    }

    // Pastikan klien dan perkara ada
    $klien   = $this->klienModel->find($id_klien);
    $perkara = $this->perkaraModel->find($id_perkara);

    if (!$klien || !$perkara) {
        return redirect()->back()->with('error', 'Data Klien atau Perkara tidak ditemukan.');
    }

    // Siapkan data untuk insert
    $data = [
        'id_klien'      => $id_klien,
        'id_perkara'    => $id_perkara,
        'deskripsi'     => $deskripsi,
        'tanggal'       => $tanggal,
        'nik'           => $nik,
        'ttl'           => $ttl,
        'jenis_kelamin' => $jenis_kelamin,
        'pekerjaan'     => $pekerjaan,
        'alamat'        => $alamat,
        'penerima'      => $penerima,
        'alamat_kantor' => $alamat_kantor
    ];

    // Insert ke database, timestamps otomatis akan di-handle oleh model
    $this->suratKuasaModel->insert($data);

    return redirect()->back()->with('success', 'Surat kuasa berhasil disimpan.');
}


public function updateSuratKuasa()
{
    $post = $this->request->getPost();

    $id          = $post['id'] ?? null;
    $id_klien    = $post['id_klien'] ?? null;
    $id_perkara  = $post['id_perkara'] ?? null;
    $deskripsi   = $post['deskripsi'] ?? null;
    $tanggal     = $post['tanggal'] ?? date('Y-m-d'); // default ke hari ini jika kosong
    $nik         = $post['nik'] ?? null;
    $ttl         = $post['ttl'] ?? null;
    $jenis_kelamin = $post['jenis_kelamin'] ?? null;
    $pekerjaan   = $post['pekerjaan'] ?? null;
    $telepon     = $post['telepon'] ?? null;
    $alamat      = $post['alamat'] ?? null;
    $penerima    = $post['penerima'] ?? null;
    $alamat_kantor = $post['alamat_kantor'] ?? null;

    // Validasi sederhana
    if (!$id || !$id_klien || !$id_perkara || !$nik || !$ttl || !$jenis_kelamin || !$pekerjaan) {
        return redirect()->back()->with('error', 'Data tidak lengkap.');
    }

    // Ambil data klien & perkara
    $klien   = $this->klienModel->find($id_klien);
    $perkara = $this->perkaraModel->find($id_perkara);

    if (!$klien || !$perkara) {
        return redirect()->back()->with('error', 'Data Klien atau Perkara tidak ditemukan.');
    }

    $data = [
        'id_klien'       => $id_klien,
        'id_perkara'     => $id_perkara,
        'nama_klien'     => $klien['nama'],
        'nomor_perkara'  => $perkara['nomor_perkara'],
        'nik'            => $nik,
        'ttl'            => $ttl,
        'jenis_kelamin'  => $jenis_kelamin,
        'pekerjaan'      => $pekerjaan,
        'telepon'        => $telepon,
        'deskripsi'      => $deskripsi,
        'alamat'         => $alamat,
        'penerima'       => $penerima,
        'alamat_kantor'  => $alamat_kantor,
        'tanggal'        => $tanggal,
        'updated_at'     => date('Y-m-d H:i:s')
    ];

    // Update data
    $this->suratKuasaModel->update($id, $data);

    return redirect()->back()->with('success', 'Surat kuasa berhasil diupdate.');
}

public function deleteSuratKuasa($id = null)
{
    if (!$id) {
        return redirect()->back()->with('error', 'ID Surat Kuasa tidak ditemukan.');
    }

    // Cek apakah data ada
    $surat = $this->suratKuasaModel->find($id);
    if (!$surat) {
        return redirect()->back()->with('error', 'Data Surat Kuasa tidak ditemukan.');
    }

    // Hapus data
    $this->suratKuasaModel->delete($id);

    return redirect()->back()->with('success', 'Surat Kuasa berhasil dihapus.');
}

// Dokumen Perkara
// Dokumen Perkara
public function dokumenPerkara()
{
    $dokumenModel  = new \App\Models\DokumenPerkaraModel();
    $perkaraModel  = new \App\Models\PerkaraModel();
    $adminModel    = new \App\Models\AdminModel();

    // Ambil data admin yang login (opsional)
    $admin = $adminModel->first();
    $username = $admin['username'] ?? 'Admin';
    $email    = $admin['email'] ?? '-';
    $peran    = $admin['peran'] ?? '-';

    // Ambil data dokumen dengan join ke perkara & pengguna untuk menampilkan username
    $dokumen = $dokumenModel->select('
            tabel_dokumen_perkara.*,
            tabel_perkara.nomor_perkara,
            tabel_pengguna.username AS diunggah_oleh_username
        ')
        ->join('tabel_perkara', 'tabel_perkara.id = tabel_dokumen_perkara.id_perkara', 'left')
        ->join('tabel_pengguna', 'tabel_pengguna.id = tabel_dokumen_perkara.diunggah_oleh', 'left')
        ->orderBy('tabel_dokumen_perkara.diunggah_pada', 'DESC')
        ->findAll();

    $perkara = $perkaraModel->findAll();
    $kontakModel = new KontakModel();

        $kontak = $kontakModel
            ->where('is_read', 0)
            ->orderBy('created_at', 'DESC')
            ->findAll();

    $data = [
        'judul'     => 'Dokumen Perkara',
        'dokumen'   => $dokumen,
        'username'  => $username,
        'email'     => $email,
        'peran'     => $peran,
        'perkara'   => $perkara,
        'kontak'    => $kontak
    ];

    return view('temp_admin/head', $data)
        . view('temp_admin/header', $data)
        . view('temp_admin/nav', $data)
        . view('temp_admin/dokumenperkara/list', $data)
        . view('temp_admin/footer');
}

public function proses_dokumenPerkara()
{
    $post = $this->request->getPost();
    $file = $this->request->getFile('file'); // pastikan input type="file" name="file"

    // Validasi sederhana
    if (empty($post['id_perkara']) || !$file || !$file->isValid() || empty($post['nama_file'])) {
        return redirect()->back()->with('error', 'Perkara, nama file, dan file wajib diisi.');
    }

    // Ambil user ID dari session
    $diunggah_oleh = session()->get('user_id'); 
    if (!$diunggah_oleh) {
        return redirect()->back()->with('error', 'User belum login.');
    }

    // Cek ekstensi file (opsional: PDF dan Word saja)
    $allowedExt = ['pdf','doc','docx'];
    $ext = strtolower($file->getClientExtension());
    if (!in_array($ext, $allowedExt)) {
        return redirect()->back()->with('error', 'Hanya file PDF atau Word yang diperbolehkan.');
    }

    // Generate nama file unik untuk disimpan di server
    $fileNameServer = $file->getRandomName();

    // Pindahkan file ke folder publik supaya bisa diakses/download
    $uploadPath = FCPATH . 'uploads/dokumen/';
    if (!is_dir($uploadPath)) {
        mkdir($uploadPath, 0777, true);
    }

    $file->move($uploadPath, $fileNameServer);

    // Siapkan data untuk insert
    $data = [
        'id_perkara'    => $post['id_perkara'],
        'nama_file'     => $post['nama_file'], // ambil dari input text user
        'path_file'     => 'uploads/dokumen/' . $fileNameServer, // path fisik
        'kategori'      => $post['kategori'] ?? 'Umum',
        'diunggah_oleh' => $diunggah_oleh,
        'diunggah_pada' => date('Y-m-d H:i:s')
    ];

    $this->dokumenPerkaraModel->insert($data);

    return redirect()->back()->with('success', 'Dokumen berhasil diunggah.');
}

public function updateDokumenPerkara()
{
    $post = $this->request->getPost();
    $id   = $post['id'] ?? null;

    if (!$id || empty($post['id_perkara']) || empty($post['kategori']) || empty($post['nama_file'])) {
        return redirect()->back()->with('error', 'Data tidak lengkap.');
    }

    $data = [
        'id_perkara'    => $post['id_perkara'],
        'kategori'      => $post['kategori'],
        'nama_file'     => $post['nama_file'], // nama file sesuai input user
        'diunggah_pada' => date('Y-m-d H:i:s')
    ];

    // Ambil file dari input form (pastikan name="path_file" di form)
    $file = $this->request->getFile('path_file');

    if ($file && $file->isValid()) {

        // Cek ekstensi file (PDF/Word)
        $allowedExt = ['pdf', 'doc', 'docx'];
        $ext = strtolower($file->getClientExtension());
        if (!in_array($ext, $allowedExt)) {
            return redirect()->back()->with('error', 'Hanya file PDF atau Word yang diperbolehkan.');
        }

        // Hapus file lama jika ada
        $existing = $this->dokumenPerkaraModel->find($id);
        if ($existing && is_file(FCPATH . $existing['path_file'])) {
            @unlink(FCPATH . $existing['path_file']);
        }

        // Simpan file baru dengan nama unik
        $fileNameServer = $file->getRandomName();
        $uploadPath = FCPATH . 'uploads/dokumen/';
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }
        $file->move($uploadPath, $fileNameServer);

        // Update path_file
        $data['path_file'] = 'uploads/dokumen/' . $fileNameServer;
    }

    $this->dokumenPerkaraModel->update($id, $data);

    return redirect()->back()->with('success', 'Dokumen berhasil diupdate.');
}

public function deleteDokumenPerkara($id)
{
    $dokumen = $this->dokumenPerkaraModel->find($id);
    if ($dokumen) {
        // Hapus file fisik
        if (file_exists($dokumen['path_file'])) {
            unlink($dokumen['path_file']);
        }
        $this->dokumenPerkaraModel->delete($id);
        return redirect()->back()->with('success', 'Dokumen berhasil dihapus.');
    }

    return redirect()->back()->with('error', 'Dokumen tidak ditemukan.');
}

// PEMBAYARAN

public function pembayaran()
{
    $model = new \App\Models\PembayaranModel();
    $adminModel = new \App\Models\AdminModel();
    $tagihanModel = new \App\Models\TagihanModel();
    $pengeluaranModel = new \App\Models\PengeluaranUangModel();
    $pembayaranModel = new \App\Models\PembayaranModel();

    // Hitung total pemasukan
    $totalPemasukanData = $pembayaranModel->selectSum('jumlah')->first();
    $totalPemasukan = $totalPemasukanData['jumlah'] ?? 0;

    // Hitung total pengeluaran
    $totalPengeluaranData = $pengeluaranModel->selectSum('jumlah')->first();
    $totalPengeluaran = $totalPengeluaranData['jumlah'] ?? 0;

    // Sisa uang = total pemasukan - total pengeluaran
    $sisaUang = $totalPemasukan - $totalPengeluaran;

    // Ambil semua data pengeluaran beserta total pembayaran per pengeluaran
    $listPengeluaran = $pengeluaranModel
        ->select('tabel_pengeluaran_uang.*, SUM(tabel_pembayaran.jumlah) as total_bayar')
        ->join('tabel_pembayaran', 'tabel_pembayaran.jumlah = tabel_pengeluaran_uang.id', 'left')
        ->groupBy('tabel_pengeluaran_uang.id')
        ->findAll();

    // Ambil semua pengguna
    $users = $adminModel->findAll();

    // Ambil pengguna pertama
    $admin = $adminModel->first(); 
    $username = $admin['username'] ?? 'Admin';
    $email    = $admin['email'] ?? '-';
    $peran    = $admin['peran'] ?? '-';

    // Ambil data pembayaran dengan join tabel_tagihan, tabel_perkara, tabel_klien
    $pembayaran = $model->select('
        tabel_pembayaran.*,
        tabel_pembayaran.bukti_transfer as bukti_transaksi,
        tabel_tagihan.id_perkara,
        tabel_tagihan.jumlah AS total_tagihan,
        tabel_tagihan.deskripsi,
        tabel_perkara.nomor_perkara,
        tabel_klien.nama AS nama_klien
    ')
    ->join('tabel_tagihan', 'tabel_tagihan.id = tabel_pembayaran.id_tagihan', 'left')
    ->join('tabel_perkara', 'tabel_perkara.id = tabel_tagihan.id_perkara', 'left')
    ->join('tabel_klien', 'tabel_klien.id = tabel_tagihan.id_klien', 'left')
    ->orderBy('tabel_pembayaran.tanggal_pembayaran', 'DESC')
    ->findAll();

    // Ambil semua tagihan untuk dropdown modal
    $tagihan = $tagihanModel->select('tabel_tagihan.*, tabel_klien.nama')
                ->join('tabel_klien', 'tabel_klien.id = tabel_tagihan.id_klien', 'left')
                ->findAll();

    $kontakModel = new KontakModel();

        $kontak = $kontakModel
            ->where('is_read', 0)
            ->orderBy('created_at', 'DESC')
            ->findAll();

    $data = [
        'judul' => 'Daftar Pembayaran',
        'pembayaran' => $pembayaran,
        'username' => $username,
        'email'    => $email,
        'peran'    => $peran,
        'tagihan'   => $tagihan,
        'totalPemasukan'    => $totalPemasukan,
        'totalPengeluaran'  => $totalPengeluaran,
        'sisaUang'          => $sisaUang,
        'listPengeluaran'   => $listPengeluaran,
        'kontak'            => $kontak
    ];

    return view('temp_admin/head', $data)
        . view('temp_admin/header', $data)
        . view('temp_admin/nav', $data)
        . view('temp_admin/pembayaran/list', $data)
        . view('temp_admin/footer');
}


public function tambahPembayaran()
{
    $pembayaranModel = new \App\Models\PembayaranModel();
    $tagihanModel    = new \App\Models\TagihanModel();

    // Ambil data dari form
    $idTagihan = $this->request->getPost('id_tagihan');
    $jumlahPembayaran = $this->request->getPost('jumlah');
    $metodePembayaran = $this->request->getPost('metode_pembayaran');
    $tanggalPembayaran = $this->request->getPost('tanggal_pembayaran');

    // Validasi sederhana
    if (empty($idTagihan) || empty($jumlahPembayaran) || empty($tanggalPembayaran)) {
        return redirect()->back()->with('error', 'Data pembayaran tidak lengkap!');
    }

    // Ambil data tagihan
    $tagihan = $tagihanModel->find($idTagihan);
    if (!$tagihan) {
        return redirect()->back()->with('error', 'Tagihan tidak ditemukan!');
    }

    $totalTagihan = $tagihan['jumlah'];

    // Hitung total pembayaran sebelumnya
    $totalDibayar = $pembayaranModel->where('id_tagihan', $idTagihan)
                                     ->selectSum('jumlah')
                                     ->first()['jumlah'] ?? 0;

    $sisaTagihan = $totalTagihan - $totalDibayar;

    if ($sisaTagihan <= 0) {
        return redirect()->back()->with('error', 'Tagihan sudah lunas, tidak bisa melakukan pembayaran lagi!');
    }

    if ($jumlahPembayaran > $sisaTagihan) {
        return redirect()->back()->with('error', 'Jumlah pembayaran melebihi sisa tagihan!');
    }

    // Siapkan data pembayaran
    $data = [
        'id_tagihan'        => $idTagihan,
        'jumlah'            => $jumlahPembayaran,
        'metode_pembayaran' => $metodePembayaran,
        'tanggal_pembayaran'=> $tanggalPembayaran,
        'dibuat_pada'       => date('Y-m-d H:i:s'),
    ];

    // Upload bukti transfer jika ada
    if ($file = $this->request->getFile('bukti_transfer')) {
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/bukti_transfer/', $newName);
            $data['bukti_transfer'] = $newName;
        }
    }

    // Simpan pembayaran
    $pembayaranModel->insert($data);

    // Update sisa tagihan
    $tagihanModel->update($idTagihan, ['jumlah' => $totalTagihan - ($totalDibayar + $jumlahPembayaran)]);

    return redirect()->to(base_url('admin/pembayaran'))
                     ->with('success', 'Pembayaran berhasil ditambahkan & tagihan diperbarui!');
}


public function updatePembayaran()
{
    $post = $this->request->getPost();
    $pembayaranModel = new \App\Models\PembayaranModel();

    // Validasi ID pembayaran
    if (empty($post['id'])) {
        return redirect()->back()->with('error', 'ID pembayaran tidak ditemukan.');
    }

    $id = $post['id'];

    // Ambil data pembayaran lama
    $oldData = $pembayaranModel->find($id);
    $oldBukti = $oldData['bukti_transfer'] ?? null;

    // Pastikan semua field ada agar tidak error undefined index
    $id_tagihan         = $post['id_tagihan']          ?? null;
    $jumlah             = $post['jumlah']             ?? null;
    $metode_pembayaran  = $post['metode_pembayaran']  ?? null;
    $tanggal_pembayaran = $post['tanggal_pembayaran'] ?? null;

    $updateData = [
        'id_tagihan'         => $id_tagihan,
        'jumlah'             => $jumlah,
        'metode_pembayaran'  => $metode_pembayaran,
        'tanggal_pembayaran' => $tanggal_pembayaran,
    ];

    // Cek apakah ada file bukti_transfer baru
    if($file = $this->request->getFile('bukti_transfer')){
        if($file->isValid() && !$file->hasMoved()){
            // Hapus file lama jika ada
            if($oldBukti && file_exists(FCPATH . 'uploads/bukti_transfer/' . $oldBukti)){
                unlink(FCPATH . 'uploads/bukti_transfer/' . $oldBukti);
            }

            // Pindahkan file baru
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/bukti_transfer', $newName);
            $updateData['bukti_transfer'] = $newName;
        }
    }

    // Jalankan update
    if (!$pembayaranModel->update($id, $updateData)) {
        return redirect()->back()
                         ->with('error', 'Gagal memperbarui pembayaran!')
                         ->withInput();
    }

    return redirect()->to(base_url('admin/pembayaran'))
                     ->with('success', 'Pembayaran berhasil diperbarui!');
}

public function deletePembayaran($id)
{
    $model = new \App\Models\PembayaranModel();

    if(empty($id)) {
        return redirect()->back()->with('error', 'ID pembayaran tidak ditemukan!');
    }

    // Hapus data
    $model->delete($id);

    return redirect()->to(base_url('admin/pembayaran'))->with('success', 'Pembayaran berhasil dihapus!');
}

///////////////////////////
/// LAPORAN KEUANGAN
//////////////////////////
public function laporanKeuangan()
{
    $db = \Config\Database::connect();
    $adminModel = new \App\Models\AdminModel();

    // Admin Data
    $admin = $adminModel->first(); 
    $data['username'] = $admin['username'] ?? 'Admin';
    $data['email']    = $admin['email'] ?? '-';
    $data['peran']    = $admin['peran'] ?? '-';

    // Filter tanggal
    $mulai   = $this->request->getGet('mulai');
    $selesai = $this->request->getGet('selesai');

    // --------- PEMASUKAN ----------
$builderPemasukan = $db->table('tabel_pembayaran');
$builderPemasukan->select("
    tabel_pembayaran.tanggal_pembayaran AS tanggal,
    tabel_pembayaran.jumlah,
    tabel_klien.nama AS nama_klien,
    tabel_tagihan.deskripsi,
    'pemasukan' AS jenis
");
$builderPemasukan->join('tabel_tagihan', 'tabel_tagihan.id = tabel_pembayaran.id_tagihan', 'left');
$builderPemasukan->join('tabel_klien', 'tabel_klien.id = tabel_tagihan.id_klien', 'left');

if ($mulai && $selesai) {
    $builderPemasukan->where("DATE(tabel_pembayaran.tanggal_pembayaran) >=", $mulai);
    $builderPemasukan->where("DATE(tabel_pembayaran.tanggal_pembayaran) <=", $selesai);
}

$pemasukan = $builderPemasukan->get()->getResultArray();

// --------- PENGELUARAN ----------
$builderPengeluaran = $db->table('tabel_pengeluaran_uang');
$builderPengeluaran->select("
    tabel_pengeluaran_uang.tanggal AS tanggal,
    tabel_pengeluaran_uang.jumlah,
    tabel_pengeluaran_uang.kategori AS nama_klien,
    tabel_pengeluaran_uang.keterangan AS deskripsi,
    'pengeluaran' AS jenis
");

if ($mulai && $selesai) {
    $builderPengeluaran->where("DATE(tabel_pengeluaran_uang.tanggal) >=", $mulai);
    $builderPengeluaran->where("DATE(tabel_pengeluaran_uang.tanggal) <=", $selesai);
}

$pengeluaran = $builderPengeluaran->get()->getResultArray();

// --------- GABUNGKAN MUTASI ----------
$mutasi = array_merge($pemasukan, $pengeluaran);

// Sort by tanggal
usort($mutasi, function ($a, $b) {
    return strtotime($a['tanggal']) - strtotime($b['tanggal']);
});


    // SALDO BERJALAN
    $saldo = 0;
    foreach ($mutasi as $key => $row) {
        $saldo += ($row['jenis'] == 'pemasukan') ? $row['jumlah'] : -$row['jumlah'];
        $mutasi[$key]['saldo'] = $saldo;
    }

    // DATA VIEW
    $data['judul']  = "MDS | Laporan Keuangan";
    $data['mutasi'] = $mutasi;
    $data['mulai']  = $mulai;
    $data['selesai'] = $selesai;
    $data['total_pemasukan'] = array_sum(array_column($pemasukan, 'jumlah'));
    $data['total_pengeluaran'] = array_sum(array_column($pengeluaran, 'jumlah'));
    $data['saldo_akhir'] = $saldo;
    $kontakModel = new KontakModel();

        $kontak = $kontakModel
            ->where('is_read', 0)
            ->orderBy('created_at', 'DESC')
            ->findAll();
    $data['kontak'] = $kontak;

    return view('temp_admin/head', $data)
        . view('temp_admin/header', $data)
        . view('temp_admin/nav', $data)
        . view('temp_admin/keuangan/list', $data)
        . view('temp_admin/footer');
}



// ==========================
// KALENDER AKTIVITAS
// ==========================
public function kalender_aktivitas()
{
    $model = new JadwalModel();
    $adminModel = new \App\Models\AdminModel();

        // Ambil semua pengguna (untuk keperluan lain, misal list dropdown)
        $users = $adminModel->findAll();

        // Ambil pengguna pertama
        $admin = $adminModel->first(); 
        $username = $admin['username'] ?? 'Admin';
        $email    = $admin['email'] ?? '-';
        $peran    = $admin['peran'] ?? '-';

        
    // Ambil semua aktivitas untuk kalender
    $aktivitas = $model->select('id, kegiatan AS title, tanggal AS start')
                       ->orderBy('tanggal', 'ASC')
                       ->findAll();
    $kontakModel = new KontakModel();

        $kontak = $kontakModel
            ->where('is_read', 0)
            ->orderBy('created_at', 'DESC')
            ->findAll();

    $data = [
        'judul' => 'Kalender Aktivitas',
        'username' => $username,
        'email'    => $email,
        'peran'    => $peran,
        'events' => $aktivitas,
        'kontak'    => $kontak
    ];

    // Jika akses via AJAX, kirim JSON untuk FullCalendar
    if ($this->request->isAJAX()) {
        return $this->response->setJSON($aktivitas);
    }

    // Jika membuka halaman normal, tampilkan view kalender
    return view('temp_admin/head', $data)
         . view('temp_admin/header', $data)
         . view('temp_admin/nav', $data)
         . view('temp_admin/kalender/list', $data)
         . view('temp_admin/footer');
}

// ==========================
// PENGGUNA / ADMIN
// ==========================
public function listPengguna()
{
    $db = db_connect();

    // Ambil semua pengguna beserta nama peran dari tabel_peran
    $users = $db->table('tabel_pengguna')
                ->select('tabel_pengguna.*, tabel_peran.nama_peran')
                ->join('tabel_peran', 'tabel_peran.id = tabel_pengguna.peran', 'left')
                ->get()
                ->getResultArray();

    // Ambil semua peran (untuk select dropdown)
    $peranList = $db->table('tabel_peran')->get()->getResultArray();

    // Ambil pengguna pertama untuk info header
    $admin = $users[0] ?? null; 
    $username = $admin['username'] ?? 'Admin';
    $email    = $admin['email'] ?? '-';
    $peran    = $admin['nama_peran'] ?? '-'; // ambil nama peran dari join

    $kontakModel = new KontakModel();

    $kontak = $kontakModel
            ->where('is_read', 0)
            ->orderBy('created_at', 'DESC')
            ->findAll(); 

    $data = [
        'username'   => $username,
        'email'      => $email,
        'peran'      => $peran,
        'users'      => $users,
        'admin'      => $admin,
        'peranList'  => $peranList,
        'kontak'     => $kontak
    ];

    return view('temp_admin/head').
           view('temp_admin/header').
           view('temp_admin/nav', $data).
           view('temp_admin/pengguna/list', $data).
           view('temp_admin/footer');
}
public function savepengguna()
{
    $post = $this->request->getPost();

    $adminModel     = new \App\Models\AdminModel();
    $peranModel     = new \App\Models\PeranModel(); 
    $pivotTable     = db_connect()->table('tabel_pengguna_peran'); 
    $pengacaraTable = db_connect()->table('tabel_pengacara'); 

    // Pastikan field penting ada
    $username   = $post['username'] ?? null;
    $kata_sandi = $post['kata_sandi'] ?? null;
    $email      = $post['email'] ?? null;
    $peran      = $post['peran'] ?? null;

    if (!$username || !$kata_sandi || !$email || !$peran) {
        return redirect()->back()->with('error', 'Username, kata sandi, email, dan peran wajib diisi!');
    }

    // Hash kata sandi
    $hashedPassword = password_hash($kata_sandi, PASSWORD_DEFAULT);

    // Session ID otomatis
    if(session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    $session_id = session_id();

    // Simpan pengguna baru
    $adminModel->insert([
        'username'    => $username,
        'kata_sandi'  => $hashedPassword,
        'email'       => $email,
        'peran'       => $peran,
        'session_id'  => $session_id
    ]);

    $id_pengguna = $adminModel->getInsertID();

    // Ambil ID peran dari tabel_peran
    $role = $peranModel->where('nama_peran', $peran)->first();
    if ($role) {
        $pivotTable->insert([
            'id_pengguna' => $id_pengguna,
            'id_peran'    => $role['id']
        ]);
    }

    // Isi tabel_pengacara jika relevan
    $peran_termasuk_pengacara = ['pengacara', 'admin', 'paralegal', 'staff'];
    if (in_array(strtolower($peran), $peran_termasuk_pengacara)) {
        $pengacaraTable->insert([
            'nama'           => $username,
            'email'          => $email,
            'telepon'        => $post['telepon'] ?? null,
            'alamat'         => $post['alamat'] ?? null,
            'pendidikan'     => $post['pendidikan'] ?? null,
            'jurusan'        => $post['jurusan'] ?? null,
            'nama_kampus'    => $post['nama_kampus'] ?? null,
            'foto_pengacara' => $post['foto_pengacara'] ?? null,
            'peran'          => $peran,
            'created_at'     => date('Y-m-d H:i:s')
        ]);
    }

    return redirect()->back()->with('success', 'Pengguna berhasil ditambahkan dan tabel pengacara diperbarui!');
}



    
    public function updatepengguna()
{
    // Ambil POST dengan aman
    $id       = $this->request->getPost('id');
    $username = $this->request->getPost('username');
    $email    = $this->request->getPost('email');
    $peranId  = $this->request->getPost('peran'); // ambil ID peran dari select

    // Validasi: pastikan ID ada
    if (!$id) {
        return redirect()->back()->with('error', 'ID pengguna tidak ditemukan!');
    }

    // Validasi: pastikan semua field terisi
    if (!$username || !$email || !$peranId) {
        return redirect()->back()->with('error', 'Semua field harus diisi!');
    }

    $db = db_connect();

    // Cek apakah ID peran valid di tabel_peran
    $cekPeran = $db->table('tabel_peran')->where('id', $peranId)->get()->getRowArray();
    if (!$cekPeran) {
        return redirect()->back()->with('error', 'Peran tidak valid!');
    }

    $adminModel = new AdminModel();

    // Update data: simpan ID peran, bukan nama peran
    $adminModel->update($id, [
        'username' => $username,
        'email'    => $email,
        'peran'    => $peranId
    ]);

    return redirect()->back()->with('success', 'Pengguna berhasil diupdate!');
}



   public function deletepengguna($id)
    {
        $db = db_connect();

        // Hapus relasi dulu
        $db->table('tabel_pengguna_peran')->where('id_pengguna', $id)->delete();

        // Baru hapus pengguna
        $adminModel = new AdminModel();
        $adminModel->delete($id);

        return redirect()->back()->with('success', 'Pengguna berhasil dihapus!');
    }


    // ==========================
    // KLIEN
    // ==========================
    public function listklien()
    {
        $adminModel = new \App\Models\AdminModel();
        $klienModel = new \App\Models\KlienModel();

        // Ambil semua admin
        $users = $adminModel->findAll();
        $admin = $adminModel->first();

        // Ambil semua pengacara dari tabel_pengacara langsung tanpa model
        $db = db_connect();
        $pengacara = $db->table('tabel_pengacara')->select('id, nama')->get()->getResultArray();

        // Ambil data klien beserta nama pengacara
        $klien = $klienModel
            ->select('tabel_klien.*, tabel_pengacara.nama as nama_pengacara')
            ->join('tabel_pengacara', 'tabel_pengacara.id = tabel_klien.id_pengacara', 'left')
            ->findAll();

        $kontakModel = new KontakModel();

        $kontak = $kontakModel
            ->where('is_read', 0)
            ->orderBy('created_at', 'DESC')
            ->findAll();

        $data = [
            'judul'    => 'Daftar Klien',
            'username' => $admin['username'] ?? 'Admin',
            'email'    => $admin['email'] ?? '-',
            'peran'    => $admin['peran'] ?? '-',
            'kontak'    => $kontak
        ];

        $dataList = [
            'klien'     => $klien,
            'admin'     => $admin,
            'users'     => $users,
            'pengacara' => $pengacara
        ];

        return view('temp_admin/head', $data)
            . view('temp_admin/header', $data)
            . view('temp_admin/nav', $data)
            . view('temp_admin/klien/list', $dataList)
            . view('temp_admin/footer', $data);
    }


    public function saveklien()
    {
        $post = $this->request->getPost();
        $klienModel = new \App\Models\KlienModel();

        // Pastikan jika kosong → set NULL
        $id_pengacara = !empty($post['id_pengacara']) ? $post['id_pengacara'] : null;

        $klienModel->insert([
            'nama'          => $post['nama'],
            'alamat'        => $post['alamat'],
            'telepon'       => $post['telepon'],
            'email'         => $post['email'],
            'catatan'       => $post['catatan'] ?? null,
            'id_pengacara'  => $id_pengacara, // hanya akan diisi bila ada
        ]);

        return redirect()->back()->with('success', 'Klien berhasil ditambahkan!');
    }

//////////////////////
/// Pengeluaran Uang
//////////////////////
public function pengeluaranUang()
{
    $adminModel = new \App\Models\AdminModel();
    $pengeluaranModel = new \App\Models\PengeluaranUangModel();
    $pembayaranModel = new \App\Models\PembayaranModel();

    // Hitung total pemasukan
    $totalPemasukanData = $pembayaranModel->selectSum('jumlah')->first();
    $totalPemasukan = $totalPemasukanData['jumlah'] ?? 0;

    // Hitung total pengeluaran
    $totalPengeluaranData = $pengeluaranModel->selectSum('jumlah')->first();
    $totalPengeluaran = $totalPengeluaranData['jumlah'] ?? 0;

    // Sisa uang = total pemasukan - total pengeluaran
    $sisaUang = $totalPemasukan - $totalPengeluaran;

    // Ambil semua data pengeluaran beserta total pembayaran per pengeluaran
    $listPengeluaran = $pengeluaranModel
        ->select('tabel_pengeluaran_uang.*, SUM(tabel_pembayaran.jumlah) as total_bayar')
        ->join('tabel_pembayaran', 'tabel_pembayaran.jumlah = tabel_pengeluaran_uang.id', 'left')
        ->groupBy('tabel_pengeluaran_uang.id')
        ->findAll();

    // Ambil data admin
    $admin = $adminModel->first(); 
    $username = $admin['username'] ?? 'Admin';
    $email    = $admin['email'] ?? '-';
    $peran    = $admin['peran'] ?? '-';

    $kontakModel = new KontakModel();

        $kontak = $kontakModel
            ->where('is_read', 0)
            ->orderBy('created_at', 'DESC')
            ->findAll();

    // Data untuk view
    $data = [
        'username'          => $username,
        'email'             => $email,
        'totalPemasukan'    => $totalPemasukan,
        'totalPengeluaran'  => $totalPengeluaran,
        'sisaUang'          => $sisaUang,
        'listPengeluaran'   => $listPengeluaran,
        'title'             => 'Pengeluaran Uang',
        'kontak'            => $kontak
    ];

    // Load view (head, header, nav, list, footer)
    return
        view('temp_admin/head', $data)
        . view('temp_admin/header', $data)
        . view('temp_admin/nav', $data)
        . view('temp_admin/pengeluaran/list', $data)
        . view('temp_admin/footer', $data);
}


public function savePengeluaran()
    {
        $pengeluaranModel = new PengeluaranUangModel();
        $request = $this->request;

        // Ambil data dari form
        $data = [
            'tanggal' => $request->getPost('tanggal'),
            'kategori' => $request->getPost('kategori'),
            'keterangan' => $request->getPost('keterangan'),
            'jumlah' => $request->getPost('jumlah'),
        ];

        // Validasi sederhana
        if(empty($data['tanggal']) || empty($data['kategori']) || empty($data['keterangan']) || empty($data['jumlah'])) {
            return redirect()->back()->with('error', 'Semua field harus diisi!');
        }

        // Simpan ke database
        $pengeluaranModel->insert($data);

        return redirect()->back()->with('success', 'Pengeluaran berhasil ditambahkan!');
    }
/////////////////////////
//// Jadwal Pertemuan
////////////////////////    
public function jadwalpertemuan()
{
    $adminModel = new \App\Models\AdminModel();
    $jadwalModel = new \App\Models\JadwalPertemuanModel();
    $klienModel = new \App\Models\KlienModel();
    $pengacaraModel = new \App\Models\PengacaraModel(); // Tambahkan model pengacara

    // Ambil data jadwal pertemuan
    $jadwal = $jadwalModel->select('
                tabel_jadwal_pertemuan.*,
                tabel_klien.nama AS nama_klien,
                tabel_klien.telepon AS telepon_klien,
                tabel_pengguna.username AS username_pengacara,
                tabel_pengacara.nama AS nama_pengacara
            ')
            ->join('tabel_klien', 'tabel_klien.id = tabel_jadwal_pertemuan.id_klien', 'left')
            ->join('tabel_pengguna', 'tabel_pengguna.id = tabel_jadwal_pertemuan.id_pengguna', 'left')
            ->join('tabel_pengacara', 'tabel_pengacara.id = tabel_jadwal_pertemuan.id_pengguna', 'left')
            ->orderBy('tabel_jadwal_pertemuan.tanggal_waktu', 'ASC')
            ->findAll();



    // Ambil semua klien dan pengacara untuk dropdown
    $klien = $klienModel->findAll();
    $pengacara = $pengacaraModel->findAll(); // ✅ Ambil pengacara

    // Ambil data admin
    $admin = $adminModel->first(); 
    $username = $admin['username'] ?? 'Admin';
    $email    = $admin['email'] ?? '-';
    $peran    = $admin['peran'] ?? '-';

    $kontakModel = new KontakModel();

    $kontak = $kontakModel
            ->where('is_read', 0)
            ->orderBy('created_at', 'DESC')
            ->findAll();

    $data = [
        'judul'      => 'Jadwal Pertemuan',
        'username'   => $username,
        'email'      => $email,
        'peran'      => $peran,
        'pertemuan'  => $jadwal,
        'klien'      => $klien,
        'pengacara'  => $pengacara, // ✅ Tambahkan ke data
        'kontak'     => $kontak
    ];

    echo view('temp_admin/head', $data);
    echo view('temp_admin/header', $data);
    echo view('temp_admin/nav', $data);
    echo view('temp_admin/jadwalpertemuan/list', $data);
    echo view('temp_admin/footer', $data);
}

public function savepertemuan()
{
    $jadwalModel = new \App\Models\JadwalPertemuanModel();
    $klienModel  = new \App\Models\KlienModel();
    $adminModel  = new \App\Models\AdminModel();

    // Validasi, cek parent, dsb (seperti versi kamu)...

    $data = [
        'id_klien'      => $this->request->getPost('id_klien'),
        'id_pengguna'   => $this->request->getPost('id_pengguna'),
        'tanggal_waktu' => $this->request->getPost('tanggal_waktu'),
        'waktu'         => $this->request->getPost('waktu'),
        'lokasi'        => $this->request->getPost('lokasi'),
        'catatan'       => $this->request->getPost('catatan'),
    ];

    $inserted = $jadwalModel->insert($data);
    if ($inserted === false) {
        $db = \Config\Database::connect();
        $error = $db->error();
        dd($error, $data);
    }

    return redirect()->to('/admin/jadwalpertemuan')
                     ->with('success', 'Pertemuan berhasil disimpan.');
}


public function updatepertemuan()
{
    $post = $this->request->getPost();
    $jadwalModel = new \App\Models\JadwalPertemuanModel();

    // Validasi ID pertemuan
    if (empty($post['id'])) {
        return redirect()->back()->with('error', 'ID pertemuan tidak ditemukan.');
    }

    // Pastikan semua field ada agar tidak error undefined index
    $id_klien       = $post['id_klien']        ?? null;
    $id_pengguna    = $post['id_pengguna']     ?? null;
    $tanggal_waktu  = $post['tanggal_waktu']   ?? null;
    $waktu          = $post['waktu']           ?? null;
    $lokasi         = $post['lokasi']          ?? null;
    $catatan        = $post['catatan']         ?? null;

    // Data yang akan diupdate
    $updateData = [
        'id_klien'      => $id_klien,
        'id_pengguna'   => !empty($id_pengguna) ? (int)$id_pengguna : null,
        'tanggal_waktu' => $tanggal_waktu,
        'waktu'         => $waktu,
        'lokasi'        => $lokasi,
        'catatan'       => $catatan,
    ];

    // Jalankan update
    if (!$jadwalModel->update($post['id'], $updateData)) {
        return redirect()->back()
                        ->with('error', 'Gagal memperbarui pertemuan!')
                        ->withInput();
    }

    return redirect()->to('/admin/jadwalpertemuan')
                     ->with('success', 'Data pertemuan berhasil diperbarui!');
}

public function deletepertemuan($id = null)
{
    $jadwalModel = new \App\Models\JadwalPertemuanModel();

    // Pastikan ID dikirim
    if (empty($id)) {
        return redirect()->back()->with('error', 'ID pertemuan tidak ditemukan.');
    }

    // Cek apakah data pertemuan ada
    $pertemuan = $jadwalModel->find($id);
    if (!$pertemuan) {
        return redirect()->back()->with('error', 'Data pertemuan tidak ditemukan.');
    }

    // Hapus data
    if ($jadwalModel->delete($id)) {
        return redirect()->to('/admin/jadwalpertemuan')
                         ->with('success', 'Data pertemuan berhasil dihapus!');
    } else {
        return redirect()->back()->with('error', 'Gagal menghapus data pertemuan.');
    }
}


public function updateklien()
    {
        $post = $this->request->getPost();
        $klienModel = new \App\Models\KlienModel();

        // Pastikan id_pengacara dikirim dan valid
        $id_pengacara = isset($post['id_pengacara']) && !empty($post['id_pengacara'])
                        ? (int)$post['id_pengacara']
                        : null; // jika kosong, set null

        $updateData = [
            'nama'         => $post['nama'],
            'alamat'       => $post['alamat'],
            'telepon'      => $post['telepon'],
            'email'        => $post['email'],
            'catatan'      => $post['catatan'],
            'id_pengacara' => $id_pengacara
        ];

        $klienModel->update($post['id'], $updateData);

        return redirect()->back()->with('success', 'Klien berhasil diupdate!');
    }


    public function deleteKlien($id)
{
    $klienModel  = new \App\Models\KlienModel();
    $jadwalModel = new \App\Models\JadwalPertemuanModel();

    $db = \Config\Database::connect();
    $db->transStart();

    // Hapus jadwal terkait
    $jadwalModel->where('id_klien', $id)->delete();

    // Hapus klien
    $klienModel->delete($id);

    $db->transComplete();

    if ($db->transStatus() === false) {
        return redirect()->back()->with('error', 'Gagal menghapus klien. Periksa data terkait perkara.');
    }

    return redirect()->back()->with('success', 'Klien dan jadwal terkait berhasil dihapus!');
}


    // ==========================
    // PERKARA
    // ==========================
public function listPerkara()
{
    $adminModel = new \App\Models\AdminModel();
    $perkaraModel = new \App\Models\PerkaraModel();
    $db = db_connect();

    // Ambil data admin
    $admin = $adminModel->first();
    $users = $adminModel->findAll();

    // Ambil semua pengacara
    $pengacara = $db->table('tabel_pengacara')
                     ->select('id, nama')
                     ->get()
                     ->getResultArray();

    // Ambil semua klien
    $klien = $db->table('tabel_klien')
                ->select('id, nama')
                ->get()
                ->getResultArray();

    // Ambil semua status perkara
    $statusPerkara = $db->table('tabel_status_perkara')
                        ->select('id, nama_status')
                        ->get()
                        ->getResultArray();

    // Ambil semua jenis perkara
    $jenisPerkara = $db->table('tabel_jenis_perkara')
                       ->select('id, nama_jenis')
                       ->get()
                       ->getResultArray();

    // Ambil semua perkara lengkap
    $perkara = $perkaraModel
        ->select('tabel_perkara.*, 
                  tabel_klien.nama as nama_klien, 
                  tabel_pengacara.nama as nama_pengacara, 
                  tabel_status_perkara.nama_status,
                  tabel_jenis_perkara.nama_jenis as nama_jenis_kasus')
        ->join('tabel_klien', 'tabel_klien.id = tabel_perkara.id_klien')
        ->join('tabel_pengacara', 'tabel_pengacara.id = tabel_perkara.id_pengacara', 'left')
        ->join('tabel_status_perkara', 'tabel_status_perkara.id = tabel_perkara.status', 'left')
        ->join('tabel_jenis_perkara', 'tabel_jenis_perkara.id = tabel_perkara.jenis_kasus', 'left')
        ->orderBy('id', 'ASC')
        ->findAll();

    // =========================
    // Bulan ROMAWI + Tahun + nomor_perkara unik
    // =========================
    $romawi = [
        1=>'I',2=>'II',3=>'III',4=>'IV',
        5=>'V',6=>'VI',7=>'VII',8=>'VIII',
        9=>'IX',10=>'X',11=>'XI',12=>'XII'
    ];

    foreach ($perkara as &$p) {
        $tanggal = $p['tanggal_mulai'] ?? $p['created_at'] ?? date('Y-m-d');
        $bulan = date('n', strtotime($tanggal));
        $tahun = date('Y', strtotime($tanggal));

        $p['bulan_romawi'] = $romawi[$bulan];
        $p['tahun'] = $tahun;

        // Jika nomor_perkara kosong, buat otomatis
        if (empty($p['nomor_perkara'])) {
            $last = $db->table('tabel_perkara')
                       ->select('nomor_perkara')
                       ->where('MONTH(tanggal_mulai)', $bulan)
                       ->where('YEAR(tanggal_mulai)', $tahun)
                       ->orderBy('id', 'DESC')
                       ->limit(1)
                       ->get()
                       ->getRowArray();

            if ($last && $last['nomor_perkara']) {
                preg_match('/^(\d+)\//', $last['nomor_perkara'], $matches);
                $nomorUrut = isset($matches[1]) ? intval($matches[1]) + 1 : 1;
            } else {
                $nomorUrut = 1;
            }

            $p['nomor_perkara'] = $nomorUrut . '/MDS/SKK/' . $romawi[$bulan] . '/' . $tahun;
        }
    }

    // =========================
    // Generate nomor_perkara berikutnya untuk modal tambah
    // =========================
    // =========================
// Generate nomor_perkara berikutnya untuk modal tambah
// =========================
$currentMonth = date('n');
$currentYear  = date('Y');

$last = $db->table('tabel_perkara')
           ->select('nomor_perkara')
           ->where('MONTH(tanggal_mulai)', $currentMonth)
           ->where('YEAR(tanggal_mulai)', $currentYear)
           ->orderBy('id', 'DESC')
           ->limit(1)
           ->get()
           ->getRowArray();

if ($last && $last['nomor_perkara']) {
    preg_match('/^(\d+)\//', $last['nomor_perkara'], $matches);
    $nextNomorUrut = isset($matches[1]) ? intval($matches[1]) + 1 : 1;
} else {
    $nextNomorUrut = 1;
}

$romawi = [
    1=>'I',2=>'II',3=>'III',4=>'IV',
    5=>'V',6=>'VI',7=>'VII',8=>'VIII',
    9=>'IX',10=>'X',11=>'XI',12=>'XII'
];

$nextNomorPerkara = $nextNomorUrut . '/MDS/SKK/' . $romawi[$currentMonth] . '/' . $currentYear;

    $kontakModel = new KontakModel();

        $kontak = $kontakModel
            ->where('is_read', 0)
            ->orderBy('created_at', 'DESC')
            ->findAll();

    // =========================
    // Kirim data ke view
    // =========================
    $data = [
        'judul'          => 'Daftar Perkara',
        'perkara'        => $perkara,
        'username'       => $admin['username'] ?? 'Admin',
        'email'          => $admin['email'] ?? '-',
        'users'          => $users,
        'pengacara'      => $pengacara,
        'kontak'         => $kontak,
        'klien'          => $klien,
        'statusPerkara'  => $statusPerkara,
        'jenisPerkara'   => $jenisPerkara,
        'nextNomorPerkara'=> $nextNomorPerkara // <-- ini untuk modal tambah
    ];

    return view('temp_admin/head', $data)
         . view('temp_admin/header', $data)
         . view('temp_admin/nav', $data)
         . view('temp_admin/perkara/list', $data)
         . view('temp_admin/footer');
}





   public function savePerkara()
{
    $post = $this->request->getPost();
    $perkaraModel = new \App\Models\PerkaraModel();
    $db = db_connect();

    // =====================
    // Tentukan Tanggal, Bulan & Tahun
    // =====================
    $tanggal_mulai = $post['tanggal_mulai'] ?? date('Y-m-d');
    $bulan = date('n', strtotime($tanggal_mulai));
    $tahun = date('Y', strtotime($tanggal_mulai));

    $romawi = [
        1=>'I',2=>'II',3=>'III',4=>'IV',
        5=>'V',6=>'VI',7=>'VII',8=>'VIII',
        9=>'IX',10=>'X',11=>'XI',12=>'XII'
    ];

    // =====================
    // Ambil nomor terakhir bulan/tahun ini
    // =====================
    $last = $db->table('tabel_perkara')
               ->select('nomor_perkara')
               ->where('MONTH(tanggal_mulai)', $bulan)
               ->where('YEAR(tanggal_mulai)', $tahun)
               ->orderBy('id', 'DESC')
               ->limit(1)
               ->get()
               ->getRowArray();

    if ($last && $last['nomor_perkara']) {
        preg_match('/^(\d+)\//', $last['nomor_perkara'], $matches);
        $nomorUrut = isset($matches[1]) ? intval($matches[1]) + 1 : 1;
    } else {
        $nomorUrut = 1;
    }

    $nomorPerkara = $nomorUrut . '/MDS/SKK/' . $romawi[$bulan] . '/' . $tahun;

    // =====================
    // Validasi id_pengacara agar sesuai foreign key
    // =====================
    $id_pengacara = $post['id_pengacara'] ?? null;

    if ($id_pengacara) {
        $pengacaraExists = $db->table('tabel_pengguna')
                              ->where('id', $id_pengacara)
                              ->countAllResults();

        if (!$pengacaraExists) {
            // Jika id_pengacara tidak ditemukan, set NULL
            $id_pengacara = null;
        }
    }

    // =====================
    // Simpan data perkara
    // =====================
    $perkaraModel->insert([
        'nomor_perkara'  => $nomorPerkara,
        'judul'          => $post['judul'] ?? null,
        'id_klien'       => $post['id_klien'] ?? null,
        'id_pengacara'   => $id_pengacara,
        'status'         => $post['status'] ?? null,
        'jenis_kasus'    => $post['jenis_kasus'] ?? null,
        'deskripsi'      => $post['deskripsi'] ?? null,
        'tanggal_mulai'  => $tanggal_mulai,
        'tanggal_selesai'=> $post['tanggal_selesai'] ?? null
    ]);

    return redirect()->back()->with('success', 'Perkara berhasil ditambahkan!');
}

public function updatePerkara()
{
    $post = $this->request->getPost();
    $perkaraModel = new \App\Models\PerkaraModel();
    $db = db_connect();

    // 1. Validasi ID Perkara
    if (empty($post['id'])) {
        return redirect()->to('admin/listperkara')->with('error', 'ID perkara tidak ditemukan.');
    }

    $existing = $perkaraModel->find($post['id']);
    if (!$existing) {
        return redirect()->to('admin/listperkara')->with('error', 'Perkara tidak ditemukan.');
    }

    // 2. Validasi ID Pengacara dari tabel_pengacara
    $id_pengacara = $post['id_pengacara'] ?? null;
    if ($id_pengacara === "" || $id_pengacara === null) {
        $id_pengacara = null;
    } else {
        $validPengacara = $db->table('tabel_pengacara')
                             ->where('id', $id_pengacara)
                             ->get()
                             ->getRowArray();

        if (!$validPengacara) {
            return redirect()->to('admin/listperkara')->with('error', 'Pengacara tidak valid.');
        }
    }

    // 3. Siapkan data update
    $dataUpdate = [
        'judul'           => $post['judul'] ?? $existing['judul'],
        'id_klien'        => $post['id_klien'] ?? $existing['id_klien'],
        'id_pengacara'    => $id_pengacara,
        'jenis_kasus'     => $post['id_jenis_perkara'] ?? $existing['jenis_kasus'],
        'status'          => $post['id_status'] ?? $existing['status'],
        'deskripsi'       => $post['deskripsi'] ?? $existing['deskripsi'],
        'tanggal_mulai'   => $post['tanggal_mulai'] ?: $existing['tanggal_mulai'],
        'tanggal_selesai' => $post['tanggal_selesai'] ?: $existing['tanggal_selesai'],
        'nomor_perkara'   => $existing['nomor_perkara'],
    ];

    // 4. Update database
    $perkaraModel->update($post['id'], $dataUpdate);

    return redirect()->to('admin/listperkara')->with('success', 'Perkara berhasil diupdate!');
}


public function deletePerkara($id)
{
    $tagihanModel = new \App\Models\TagihanModel();
    $perkaraModel = new \App\Models\PerkaraModel();

    // hapus semua tagihan terkait perkara
    $tagihanModel->where('id_perkara', $id)->delete();

    // hapus perkara
    $perkaraModel->delete($id);

    return redirect()->back()->with('success', 'Perkara berhasil dihapus!');
}

//

    public function statusKasus()
{
    $perkaraModel = new \App\Models\PerkaraModel();
    $adminModel   = new \App\Models\AdminModel();

    // Ambil semua data perkara beserta nama pengacara & nama klien
    $perkara = $perkaraModel
        ->select('
            tabel_perkara.id, 
            tabel_perkara.nomor_perkara, 
            tabel_perkara.judul, 
            tabel_perkara.tanggal_mulai, 
            tabel_perkara.tanggal_selesai,
            tabel_status_perkara.nama_status as nama_status,
            tabel_pengacara.nama as nama_pengacara,
            tabel_klien.nama as nama_klien
        ')
        ->join('tabel_pengacara', 'tabel_pengacara.id = tabel_perkara.id_pengacara', 'left')
        ->join('tabel_status_perkara', 'tabel_status_perkara.id = tabel_perkara.status', 'left')
        ->join('tabel_klien', 'tabel_klien.id = tabel_perkara.id_klien', 'left')
        ->orderBy('tabel_perkara.id', 'ASC')
        ->findAll();

    // Ambil pengguna pertama (admin)
    $admin = $adminModel->first(); 
    $username = $admin['username'] ?? 'Admin';
    $email    = $admin['email'] ?? '-';
    $peran    = $admin['peran'] ?? '-';

    $kontakModel = new KontakModel();

        $kontak = $kontakModel
            ->where('is_read', 0)
            ->orderBy('created_at', 'DESC')
            ->findAll();

    // Gabungkan data untuk view
    $data = [
        'kontak'   => $kontak,
        'perkara'  => $perkara,
        'username' => $username,
        'email'    => $email,
        'peran'    => $peran
    ];

    // Tampilkan view
    return view('temp_admin/head', $data)
         . view('temp_admin/header', $data)
         . view('temp_admin/nav', $data)
         . view('temp_admin/statuskasus/list', $data) 
         . view('temp_admin/footer');
}





// JADWAL SIDANG
public function jadwalSidang()
{
    $url = 'https://sipp.pn-negara.go.id/list_jadwal_sidang';

    // --- Ambil HTML dari SIPP ---
    $html = @file_get_contents($url);
    if ($html === false) {
        return "Gagal mengambil data dari SIPP PN Negara.";
    }

    // --- Parsing HTML ---
    libxml_use_internal_errors(true);
    $dom = new \DOMDocument();
    $dom->loadHTML($html);
    libxml_clear_errors();

    $xpath = new \DOMXPath($dom);
    $rows  = $xpath->query('//table//tr');

    $jadwals = [];

    foreach ($rows as $i => $tr) {

        // Lewati header tabel
        if ($i === 0) {
            continue;
        }

        $cols = $tr->getElementsByTagName('td');

        // Pastikan jumlah kolom cukup
        if ($cols->length < 6) {
            continue;
        }

        $jadwal = [
            'no'               => trim($cols->item(0)->textContent),
            'tanggal_sidang'   => trim($cols->item(1)->textContent),
            'nomor_perkara'    => trim($cols->item(2)->textContent),
            'sidang_keliling'  => trim($cols->item(3)->textContent),
            'ruangan'          => trim($cols->item(4)->textContent),
            'agenda'           => trim($cols->item(5)->textContent),
            'detil'            => null
        ];

        // Tambahkan link detil jika ada
        if ($cols->length > 6) {
            $aTags = $cols->item(6)->getElementsByTagName('a');
            if ($aTags->length > 0) {
                $jadwal['detil'] = $aTags->item(0)->getAttribute('href');
            }
        }

        $jadwals[] = $jadwal;
    }

    // --- Ambil Data Admin ---
    $adminModel = new \App\Models\AdminModel();
    $admin      = $adminModel->first();

    $kontakModel = new KontakModel();

        $kontak = $kontakModel
            ->where('is_read', 0)
            ->orderBy('created_at', 'DESC')
            ->findAll();

    $data = [
        'kontak'   => $kontak,
        'jadwals'  => $jadwals,
        'username' => $admin['username'] ?? 'Admin',
        'email'    => $admin['email'] ?? '-',
        'peran'    => $admin['peran'] ?? '-',
    ];

    // --- Tampilkan ke view ---
    return 
        view('temp_admin/head', $data)
      . view('temp_admin/header', $data)
      . view('temp_admin/nav', $data)
      . view('temp_admin/jadwalsidang/list', $data)
      . view('temp_admin/footer', $data);
}


public function pengacara()
{
    $db = db_connect();
    $pengacaraModel = new \App\Models\PengacaraModel();
    $peranModel     = new \App\Models\PeranModel();
    $adminModel     = new \App\Models\AdminModel();

    // ============================
    // 1. Ambil semua pengacara beserta nama peran & nama jurusan
    // ============================
    $pengacara = $pengacaraModel
        ->select('
            tabel_pengacara.*, 
            tabel_peran.nama_peran, 
            tabel_jurusan_hukum.nama_jurusan
        ')
        ->join('tabel_peran', 'tabel_peran.id = tabel_pengacara.peran', 'left')
        ->join('tabel_jurusan_hukum', 'tabel_jurusan_hukum.id = tabel_pengacara.jurusan', 'left')
        ->findAll();

    // ============================
    // 2. Ambil semua peran untuk dropdown modal tambah/edit
    // ============================
    $peranList = $peranModel->findAll();

    // ============================
    // 3. Ambil semua jurusan langsung dari tabel (tanpa model)
    // ============================
    $jurusanList = $db->table('tabel_jurusan_hukum')
                      ->select('id, nama_jurusan')
                      ->get()
                      ->getResultArray();

    // ============================
    // 4. Ambil admin pertama untuk header/nav
    // ============================
    $admin = $adminModel->first(); 
    $username = $admin['username'] ?? 'Admin';
    $email    = $admin['email'] ?? '-';
    $peran    = $admin['peran'] ?? '-';

    $kontakModel = new KontakModel();

        $kontak = $kontakModel
            ->where('is_read', 0)
            ->orderBy('created_at', 'DESC')
            ->findAll();
    // ============================
    // 5. Siapkan data untuk view
    // ============================
    $data = [
        'judul'         => 'Pengacara',
        'kontak'       => $kontak,
        'pengacara'   => $pengacara,
        'peranList'   => $peranList,    // dropdown peran
        'jurusanList' => $jurusanList,  // dropdown jurusan langsung dari tabel
        'username'    => $username,
        'email'       => $email,
        'peran'       => $peran
    ];

    // ============================
    // 6. Render view
    // ============================
    return view('temp_admin/head', $data)
         . view('temp_admin/header', $data)
         . view('temp_admin/nav', $data)
         . view('temp_admin/pengacara/list', $data)
         . view('temp_admin/footer');
}


public function savePengacara()
{
    $post = $this->request->getPost();
    $pengacaraModel = new \App\Models\PengacaraModel();
    $db = db_connect();

    // ===============================
    // 1. Upload foto jika ada
    // ===============================
    $fotoFile = $this->request->getFile('foto_pengacara');
    $fotoName = null;

    if ($fotoFile && $fotoFile->isValid() && !$fotoFile->hasMoved()) {
        $fotoName = $fotoFile->getRandomName();
        $fotoFile->move(FCPATH . 'uploads/pengacara', $fotoName);
    }

    // ===============================
    // 2. Validasi id_peran dan id_jurusan
    // ===============================
    $id_peran   = $post['peran'] ?? null;
    $id_jurusan = $post['jurusan'] ?? null;

    // Optional: cek apakah id_peran ada di tabel_peran
    if (!empty($id_peran)) {
        $cekPeran = $db->table('tabel_peran')->where('id', $id_peran)->get()->getRowArray();
        if (!$cekPeran) $id_peran = null;
    }

    // Optional: cek apakah id_jurusan ada di tabel_jurusan_hukum
    if (!empty($id_jurusan)) {
        $cekJurusan = $db->table('tabel_jurusan_hukum')->where('id', $id_jurusan)->get()->getRowArray();
        if (!$cekJurusan) $id_jurusan = null;
    }

    // ===============================
    // 3. Simpan data ke tabel_pengacara
    // ===============================
    $pengacaraModel->insert([
        'nama'           => $post['nama'],
        'email'          => $post['email'],
        'telepon'        => $post['telepon'],
        'alamat'         => $post['alamat'],
        'pendidikan'     => $post['pendidikan'] ?? null,
        'jurusan'        => $id_jurusan,
        'nama_kampus'    => $post['nama_kampus'] ?? null,
        'peran'          => $id_peran,
        'foto_pengacara' => $fotoName,
        'created_at'     => date('Y-m-d H:i:s'),
        'update_at'      => date('Y-m-d H:i:s')
    ]);

    return redirect()->back()->with('success', 'Pengacara berhasil ditambahkan!');
}

public function updatePengacara()
{
    $post = $this->request->getPost();
    $pengacaraModel = new \App\Models\PengacaraModel();
    $db = db_connect();

    // ===============================
    // 1. Pastikan ID pengacara ada
    // ===============================
    if (empty($post['id'])) {
        return redirect()->back()->with('error', 'ID pengacara tidak ditemukan.');
    }

    $existing = $pengacaraModel->find($post['id']);
    if (!$existing) {
        return redirect()->back()->with('error', 'Pengacara tidak ditemukan.');
    }

    // ===============================
    // 2. Upload foto baru jika ada
    // ===============================
    $fotoFile = $this->request->getFile('foto_pengacara');
    $fotoName = $existing['foto_pengacara'];

    if ($fotoFile && $fotoFile->isValid() && !$fotoFile->hasMoved()) {
        // Hapus foto lama
        if ($existing['foto_pengacara'] && file_exists(FCPATH . 'uploads/pengacara/' . $existing['foto_pengacara'])) {
            unlink(FCPATH . 'uploads/pengacara/' . $existing['foto_pengacara']);
        }

        $fotoName = $fotoFile->getRandomName();
        $fotoFile->move(FCPATH . 'uploads/pengacara', $fotoName);
}


    // ===============================
    // 3. Validasi peran & jurusan
    // ===============================
    $id_peran   = $post['peran'] ?? null;
    $id_jurusan = $post['jurusan'] ?? null;

    if (!empty($id_peran)) {
        $cekPeran = $db->table('tabel_peran')->where('id', $id_peran)->get()->getRowArray();
        if (!$cekPeran) $id_peran = null;
    }

    if (!empty($id_jurusan)) {
        $cekJurusan = $db->table('tabel_jurusan_hukum')->where('id', $id_jurusan)->get()->getRowArray();
        if (!$cekJurusan) $id_jurusan = null;
    }

    // ===============================
    // 4. Update data
    // ===============================
    $pengacaraModel->update($post['id'], [
        'nama'           => $post['nama'],
        'email'          => $post['email'],
        'telepon'        => $post['telepon'],
        'alamat'         => $post['alamat'],
        'pendidikan'     => $post['pendidikan'] ?? null,
        'jurusan'        => $id_jurusan,
        'nama_kampus'    => $post['nama_kampus'] ?? null,
        'peran'          => $id_peran,
        'foto_pengacara' => $fotoName,
        'update_at'      => date('Y-m-d H:i:s')
    ]);

    return redirect()->back()->with('success', 'Pengacara berhasil diperbarui!');
}

public function deletePengacara($id)
    {
        $pengacaraModel = new \App\Models\PengacaraModel();

        // ===============================
        // 1. Pastikan data ada
        // ===============================
        $existing = $pengacaraModel->find($id);
        if (!$existing) {
            return redirect()->back()->with('error', 'Pengacara tidak ditemukan.');
        }

        // ===============================
        // 2. Hapus foto jika ada
        // ===============================
        if ($existing['foto_pengacara'] && file_exists(WRITEPATH . 'uploads/pengacara/' . $existing['foto_pengacara'])) {
            unlink(WRITEPATH . 'uploads/pengacara/' . $existing['foto_pengacara']);
        }

        // ===============================
        // 3. Hapus data dari database
        // ===============================
        $pengacaraModel->delete($id);

        return redirect()->back()->with('success', 'Pengacara berhasil dihapus!');
    }




// Account
public function account()
{
    $adminModel = new \App\Models\AdminModel();
    $kontakModel = new \App\Models\KontakModel();

    // Ambil ID user dari session
    $id = session()->get('user_id');
    if (!$id) {
        return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
    }

    // Ambil data user dari tabel_pengguna sesuai ID login
    $user = $adminModel->find($id);
    if (!$user) {
        return redirect()->back()->with('error', 'Data user tidak ditemukan.');
    }

    // Siapkan variabel untuk view
    $username = $user['username'];
    $email    = $user['email'];
    $peran    = $user['peran'];

    // Ambil kontak unread untuk header/nav
    $kontak = $kontakModel
        ->where('is_read', 0)
        ->orderBy('created_at', 'DESC')
        ->findAll();

    // Data yang dikirim ke view
    $data = [
        'judul'      => 'Akun',
        'kontak'     => $kontak,
        'title'      => 'Pengaturan Akun',
        'menuActive' => 'account',
        'username'   => $username,
        'email'      => $email,
        'peran'      => $peran,
        'user'       => $user   // tambahkan $user agar view bisa akses $user['...']
    ];

    // Gabungkan beberapa view menjadi satu string
    return view('temp_admin/head', $data)
        . view('temp_admin/header', $data)
        . view('temp_admin/nav', $data)
        . view('temp_admin/account/profile', $data)
        . view('temp_admin/footer');
}

public function barcodeQr()
{
    // Load model
    $adminModel = new \App\Models\AdminModel();
    $kontakModel = new \App\Models\KontakModel();
    $tabelBarcodeModel = new \App\Models\TabelBarcodeModel();
    $tabelPengacaraModel = new \App\Models\PengacaraModel();

    // Ambil ID user dari session
    $id = session()->get('user_id');
    if (!$id) {
        return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
    }

    // Ambil data user
    $user = $adminModel->find($id);
    if (!$user) {
        return redirect()->back()->with('error', 'Data user tidak ditemukan.');
    }

    // Ambil kontak unread
    $kontak = $kontakModel->where('is_read', 0)->orderBy('created_at', 'DESC')->findAll();

    $barcodeData = $tabelBarcodeModel
    ->select('tabel_barcode.*, tabel_pengacara.nama AS nama_pengacara') // Ambil nama pengacara dari tabel_pengacara
    ->join('tabel_pengacara', 'tabel_pengacara.id = tabel_barcode.nama_pengacara', 'left') // Join berdasarkan foreign key
    ->orderBy('tabel_barcode.id', 'DESC')
    ->findAll();



    // Ambil daftar pengacara untuk dropdown
    $pengacaraData = $tabelPengacaraModel->findAll();

    // Data yang dikirim ke view
    $data = [
        'kontak'        => $kontak,
        'judul'         => 'Barcode',
        'menuActive'    => 'account',
        'username'      => $user['username'],
        'email'         => $user['email'],
        'peran'         => $user['peran'],
        'user'          => $user,
        'barcodeData'   => $barcodeData,
        'pengacaraData' => $pengacaraData,
    ];

    // Load view
    return view('temp_admin/head', $data)
        . view('temp_admin/header', $data)
        . view('temp_admin/nav', $data)
        . view('temp_admin/barcode/list', $data)
        . view('temp_admin/footer');
}

public function prosesBarcode()
{
    $model = new TabelBarcodeModel();

    // Ambil data yang dikirim dari form
    $data = [
        'nama_pengacara' => $this->request->getPost('nama_pengacara'),
        'spesialis' => $this->request->getPost('spesialis'),
        'no_hp' => $this->request->getPost('no_hp'),
        'lokasi_maps' => $this->request->getPost('lokasi_maps'),
        'latitude' => $this->request->getPost('latitude'),
        'longitude' => $this->request->getPost('longitude'),
    ];

    // Cek jika ada foto yang diupload
    if ($foto = $this->request->getFile('foto')) {
        if ($foto->isValid() && !$foto->hasMoved()) {
            $newName = $foto->getRandomName(); // Generate nama acak untuk file
            $foto->move('uploads/profile/', $newName); // Simpan foto di folder 'uploads/profile'
            $data['foto'] = $newName; // Simpan nama foto ke field foto
        }
    }

    // Insert data baru ke database
    $insertSuccess = $model->save($data);

    // Cek apakah insert berhasil
    if ($insertSuccess) {
        // Ambil ID pengacara yang baru saja disimpan
        $pengacaraId = $model->getInsertID();

        // Generate link profile pengacara
        $linkProfile = base_url('profile/' . $pengacaraId);

        // Generate QR Code untuk link profile pengacara
        $qrCodeUrl = "https://api.qrserver.com/v1/create-qr-code/?data=" . urlencode($linkProfile) . "&size=150x150";

        // Update link_profile dan barcode di database
        $model->update($pengacaraId, [
            'link_profile' => $linkProfile,  // Simpan link profile
            'barcode' => $qrCodeUrl         // Simpan barcode (QR code URL)
        ]);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Barcode pengacara berhasil ditambahkan!',
            'barcode' => $qrCodeUrl // Kirimkan URL barcode untuk ditampilkan
        ]);
    } else {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Gagal menambahkan barcode pengacara!'
        ]);
    }
}

// Method untuk proses update barcode pengacara
public function updateBarcode($id)
{
    $model = new TabelBarcodeModel();

    // Ambil data lama dari database
    $existing = $model->find($id);

    // Ambil data yang dikirim dari form
    $data = [
        'nama_pengacara' => $this->request->getPost('nama_pengacara'),
        'spesialis'      => $this->request->getPost('spesialis'),
        'no_hp'          => $this->request->getPost('no_hp'),
        'lokasi_maps'    => $this->request->getPost('lokasi_maps'),
        'latitude'       => $this->request->getPost('latitude'),
        'longitude'      => $this->request->getPost('longitude'),
    ];

    // Cek jika ada foto yang diupload
    if ($foto = $this->request->getFile('foto')) {
        if ($foto->isValid() && !$foto->hasMoved()) {
            // Hapus foto lama jika ada
            if (!empty($existing['foto']) && file_exists('uploads/profile/' . $existing['foto'])) {
                unlink('uploads/profile/' . $existing['foto']);
            }

            // Simpan foto baru
            $newName = $foto->getRandomName(); // Generate nama acak untuk file
            $foto->move('uploads/profile/', $newName); // Simpan foto di folder 'uploads/profile'
            $data['foto'] = $newName; // Simpan nama foto ke field foto
        }
    }

    // Update data ke database
    $updateSuccess = $model->update($id, $data);

    // Cek apakah update berhasil
    if ($updateSuccess) {
        return $this->response->setJSON([
            'success' => true,
            'message' => 'Barcode pengacara berhasil diperbarui!'
        ]);
    } else {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Gagal memperbarui barcode pengacara!'
        ]);
    }
}


public function deleteBarcode($id = null)
{
    $model = new \App\Models\TabelBarcodeModel();

    if (!$id) {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'ID tidak dikirim'
        ]);
    }

    $row = $model->find($id);

    if (!$row) {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Data tidak ditemukan'
        ]);
    }

    // Hapus foto jika ada
    if (!empty($row['foto'])) {
        $filePath = FCPATH . 'uploads/profile/' . basename($row['foto']);
        if (file_exists($filePath)) unlink($filePath);
    }

    // Hapus barcode file jika ada
    if (!empty($row['barcode'])) {
        $barcodePath = FCPATH . 'uploads/qr_codes/' . basename($row['barcode']);
        if (file_exists($barcodePath)) unlink($barcodePath);
    }

    $model->delete($id);

    return $this->response->setJSON([
        'success' => true,
        'message' => 'Data barcode berhasil dihapus beserta foto dan barcode terkait'
    ]);
}

public function updateAccount()
{
    $post = $this->request->getPost();
    $id   = session()->get('user_id'); // update user yang login

    if (!$id) {
        return redirect()->back()->with('error', 'User tidak ditemukan.');
    }

    // Ambil data user lama (untuk backup atau validasi tambahan jika perlu)
    $user = $this->adminModel->find($id);
    if (!$user) {
        return redirect()->back()->with('error', 'User tidak ditemukan.');
    }

    // Siapkan data untuk update
    $data = [
        'username'        => trim($post['username']),
        'email'           => trim($post['email']),
        'tema'            => in_array($post['tema'] ?? '', ['light','dark']) ? $post['tema'] : 'light',
        'notifikasi_email'=> isset($post['notifikasi_email']) && $post['notifikasi_email'] == 'on' ? 1 : 0,
        'pesan'           => $post['pesan'] ?? '',
    ];

    // Jika kata_sandi diisi, hash dulu
    if (!empty($post['kata_sandi'])) {
        $data['kata_sandi'] = password_hash($post['kata_sandi'], PASSWORD_DEFAULT);
    }

    // Update ke database
    $this->adminModel->update($id, $data);

    return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
}


// Pengaturan Sistem kang
public function pengaturanSistem()
{
    $userId = session()->get('user_id');
    $user   = $this->adminModel->find($userId);

    if (!$user) {
        return redirect()->back()->with('error', 'User tidak ditemukan.');
    }

    // Ambil pengaturan sistem (anggap hanya 1 row)
    $pengaturanModel = new \App\Models\PengaturanSistemModel();
    $pengaturan      = $pengaturanModel->first();
    $kontakModel = new KontakModel();

        $kontak = $kontakModel
            ->where('is_read', 0)
            ->orderBy('created_at', 'DESC')
            ->findAll();

    $data = [
        'judul'            => 'Pengaturan Sistem',
        'username'         => $user['username'] ?? 'Admin',
        'email'            => $user['email'] ?? '-',
        'peran'            => $user['peran'] ?? '-',
        'logo'             => $pengaturan['logo'] ?? '',
        'nama_perusahaan'  => $pengaturan['nama_perusahaan'] ?? '',
        'seo'              => $pengaturan['seo'] ?? '',
        'keyword'          => $pengaturan['keyword'] ?? '',
        'copyright'        => $pengaturan['copyright'] ?? '',
        'maintenance'      => $pengaturan['maintenance'] ?? 0,
        'kontak'            => $kontak
    ];

    return view('temp_admin/head', $data)
        . view('temp_admin/header', $data)
        . view('temp_admin/nav', $data)
        . view('temp_admin/pengaturansistem/list', $data)
        . view('temp_admin/footer');
}

public function proses_PengaturanSistem()
{
    $post = $this->request->getPost();
    $fileLogo = $this->request->getFile('logo');

    $model = new \App\Models\PengaturanSistemModel();

    // Ambil data setting pertama (anggap hanya ada 1 row)
    $setting = $model->first();

    $data = [
        'nama_perusahaan' => $post['nama_perusahaan'] ?? '',
        'seo'             => $post['seo'] ?? '',
        'keyword'         => $post['keyword'] ?? '',   // <— ditambahkan
        'copyright'       => $post['copyright'] ?? '',
        'maintenance'     => isset($post['maintenance']) ? 1 : 0
    ];

    // Upload logo jika ada
    if ($fileLogo && $fileLogo->isValid() && !$fileLogo->hasMoved()) {
        $namaFile = $fileLogo->getRandomName();

        // Hapus file lama jika ada
        if ($setting && !empty($setting['logo']) && file_exists(FCPATH . 'uploads/logo/' . $setting['logo'])) {
            unlink(FCPATH . 'uploads/logo/' . $setting['logo']);
        }

        $fileLogo->move(FCPATH . 'uploads/logo/', $namaFile);
        $data['logo'] = $namaFile;
    }

    if ($setting) {
        // Update
        $model->update($setting['id'], $data);
    } else {
        // Insert baru
        $model->insert($data);
    }

    return redirect()->back()->with('success', 'Pengaturan sistem berhasil diperbarui.');
}


    // ==========================
    // FORM LOGIN ADMIN
    // ==========================
    public function login()
    {
        return view('temp_admin/login/head')
            . view('temp_admin/login/login')
            . view('temp_admin/login/footer');
    }


    // ==========================
    // PROSES LOGIN ADMIN SAJA
    // ==========================
public function doLogin()
{
    $username   = $this->request->getPost('username');
    $kata_sandi = $this->request->getPost('kata_sandi');

    $db = db_connect();

    // Ambil user berdasarkan username
    $user = $db->table('tabel_pengguna')
        ->where('username', $username)
        ->get()
        ->getRowArray();

    // Username tidak ditemukan
    if (!$user) {
        return redirect()->back()->with('error', 'Username tidak ditemukan!');
    }

    // Password salah
    if (!password_verify($kata_sandi, $user['kata_sandi'])) {
        return redirect()->back()->with('error', 'Kata sandi salah!');
    }

    // Simpan session (tanpa cek peran)
    session()->set([
        'user_id'   => $user['id'],
        'username'  => $user['username'],
        'is_admin_login'  => true,
    ]);

    // Redirect ke dashboard admin (atau halaman yang sesuai)
    return redirect()->to('/admin/dashboard');
}



    // ==========================
    // LOGOUT ADMIN
    // ==========================
 public function logout()
{
    $session = session();

    // Ambil user ID yang login
    $user_id = $session->get('user_id');

    // Ambil role dari database
    $db = \Config\Database::connect();
    $builder = $db->table('tabel_pengguna');
    $builder->select('tabel_peran.nama_peran');
    $builder->join('tabel_peran', 'tabel_peran.id = tabel_pengguna.peran');
    $builder->where('tabel_pengguna.id', $user_id);
    $row = $builder->get()->getRow();

    $role = $row ? $row->nama_peran : null;

    // Jika bukan pengacara, cegah atau redirect
    if ($role !== 'admin') {
        // Bisa diarahkan ke login umum atau ke halaman lain
        return redirect()->to('/admin/login')->with('error', 'Anda bukan Admin.');
    }

    // Destroy session untuk admin
    $session->destroy();

    // Redirect login admin
    return redirect()->to('/admin/login');
}



}