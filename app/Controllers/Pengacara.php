<?php

namespace App\Controllers;

use App\Models\KlienModel;
use App\Models\PerkaraModel;
use App\Models\PengacaraModel;
use App\Models\AdminModel;
use App\Models\JadwalPertemuanModel;

class Pengacara extends BaseController
{
    private $db;
    private $session;
    private $username;
    private $email;
    private $peran;
    private $id_pengacara;

    public function __construct()  
{
    $this->db = db_connect();
    $this->session = session();

    // Ambil dari session sesuai yang diset di doLogin()
    $this->id_pengguna  = $this->session->get('id_pengguna');
    $this->id_pengacara = $this->session->get('id_pengacara');
    $this->username     = $this->session->get('username');
    $this->email        = $this->session->get('email');
    $this->peran        = $this->session->get('peran');
}

    public function dashboard()
{
    // Ambil data session sekali saja
    $session = session();

    $data = [
        'judul'    => 'Dashboard Pengacara',
        'username' => session()->get('username'),
        'email'    => session()->get('email')
    ];

    return view('temp_pengacara/head', $data)
        . view('temp_pengacara/header', $data)
        . view('temp_pengacara/nav', $data)
        . view('temp_pengacara/dashboard', $data)
        . view('temp_pengacara/footer');
}



    // ============================================
    // KLIEN
    // ============================================
    public function listklien()
    {
        $klienModel = new KlienModel();

        $klien = $klienModel
            ->select('tabel_klien.*, tabel_pengacara.nama as nama_pengacara')
            ->join('tabel_pengacara', 'tabel_pengacara.id = tabel_klien.id_pengacara', 'left')
            ->where('tabel_klien.id_pengacara', $this->id_pengacara)
            ->findAll();

        $data = [
            'judul'    => 'Daftar Klien',
            'klien'    => $klien,
            'username' => $this->username,
            'email'    => $this->email,
            'peran'    => $this->peran
        ];

        return view('temp_pengacara/head', $data)
            . view('temp_pengacara/header', $data)
            . view('temp_pengacara/nav', $data)
            . view('temp_pengacara/klien/list', $data)
            . view('temp_pengacara/footer');
    }

    public function saveklien()
    {
        $post = $this->request->getPost();
        $klienModel = new KlienModel();

        $klienModel->insert([
            'nama'         => $post['nama'],
            'alamat'       => $post['alamat'],
            'telepon'      => $post['telepon'],
            'email'        => $post['email'],
            'catatan'      => $post['catatan'] ?? null,
            'id_pengacara' => $this->id_pengacara
        ]);

        return redirect()->back()->with('success', 'Klien berhasil ditambahkan!');
    }

    public function updateklien()
    {
        $post = $this->request->getPost();
        $klienModel = new KlienModel();

        $klienModel->update($post['id'], [
            'nama'    => $post['nama'],
            'alamat'  => $post['alamat'],
            'telepon' => $post['telepon'],
            'email'   => $post['email'],
            'catatan' => $post['catatan']
        ]);

        return redirect()->back()->with('success', 'Klien berhasil diupdate!');
    }

    // ============================================
    // JADWAL PERTEMUAN
    // ============================================
   public function jadwalpertemuan()
{
    $jadwalModelPertemuan = new JadwalPertemuanModel();
    $klienModel  = new KlienModel();
    $pengacaraModel = new PengacaraModel();


    // Ambil data jadwal pertemuan
    $jadwal = $jadwalModelPertemuan
    ->select('
        tabel_jadwal_pertemuan.*, 
        tabel_klien.nama AS nama_klien, 
        tabel_pengacara.nama AS nama_pengacara
    ')
    ->join('tabel_klien', 'tabel_klien.id = tabel_jadwal_pertemuan.id_klien', 'left')
    ->join('tabel_pengacara', 'tabel_pengacara.id = tabel_jadwal_pertemuan.id_pengguna', 'left')
    ->orderBy('tanggal_waktu', 'ASC')
    ->findAll();


    // Siapkan data yang dikirim ke view
    $data = [
        'jadwal'    => $jadwal,
        'klien'     => $klienModel->where('id_pengacara', $this->id_pengacara)->findAll(),
        'pengacara' => [$this->id_pengacara],
        'username'  => $this->username,
        'email'     => $this->email,
        'peran'     => $this->peran,
        'pengacara' => $pengacaraModel->findAll(),
    ];

    return view('temp_pengacara/head', $data)
        . view('temp_pengacara/header', $data)
        . view('temp_pengacara/nav', $data)
        . view('temp_pengacara/jadwalpertemuan/list', $data)
        . view('temp_pengacara/footer');
}


 public function savepertemuan()
{
    $post = $this->request->getPost();
    $jadwalModel = new JadwalPertemuanModel();

    // Validasi input
    if (empty($post['id_klien'])) {
        return redirect()->back()->with('error', 'Klien harus dipilih.');
    }

    if (empty($post['id_pengguna'])) {
        return redirect()->back()->with('error', 'Pengacara harus dipilih.');
    }

    if (empty($post['tanggal_waktu'])) {
        return redirect()->back()->with('error', 'Tanggal dan waktu wajib diisi.');
    }

    // Insert ke database
    $jadwalModel->insert([
        'id_klien'      => $post['id_klien'],
        'id_pengguna'   => $post['id_pengguna'], // ambil dari form
        'tanggal_waktu' => $post['tanggal_waktu'],
        'waktu'         => $post['waktu'] ?? null,
        'lokasi'        => $post['lokasi'] ?? null,
        'catatan'       => $post['catatan'] ?? null,
    ]);

    return redirect()->to('/pengacara/jadwalpertemuan')->with('success', 'Pertemuan berhasil disimpan.');
}





    public function updatepertemuan()
    {
        $post = $this->request->getPost();
        $jadwalModelPertemuan = new JadwalPertemuanModel();

        $jadwalModelPertemuan->update($post['id'], [
            'id_klien'      => $post['id_klien'],
            'tanggal_waktu' => $post['tanggal_waktu'],
            'waktu'         => $post['waktu'],
            'lokasi'        => $post['lokasi'],
            'catatan'       => $post['catatan']
        ]);

        return redirect()->to('/pengacara/jadwalpertemuan')->with('success', 'Pertemuan berhasil diperbarui!');
    }

    public function deletepertemuan($id)
    {
        $jadwalModelPertemuan = new JadwalPertemuanModel();
        $jadwalModelPertemuan->delete($id);

        return redirect()->to('/pengacara/jadwalpertemuan')->with('success', 'Pertemuan berhasil dihapus!');
    }

    // ============================================
    // STATUS KASUS
    // ============================================
    public function statusKasus()
    {
        $perkaraModel = new PerkaraModel();

        $perkara = $perkaraModel
            ->select('tabel_perkara.*, tabel_status_perkara.nama_status, tabel_klien.nama AS nama_klien')
            ->join('tabel_status_perkara', 'tabel_status_perkara.id = tabel_perkara.status', 'left')
            ->join('tabel_klien', 'tabel_klien.id = tabel_perkara.id_klien', 'left')
            ->where('tabel_perkara.id_pengacara', $this->id_pengacara)
            ->orderBy('tabel_perkara.id', 'ASC')
            ->findAll();

        $data = [
            'perkara'  => $perkara,
            'username' => $this->username,
            'email'    => $this->email,
            'peran'    => $this->peran
        ];

        return view('temp_pengacara/head', $data)
            . view('temp_pengacara/header', $data)
            . view('temp_pengacara/nav', $data)
            . view('temp_pengacara/statuskasus/list', $data)
            . view('temp_pengacara/footer');
    }

    // ============================================
    // PERKARA
    // ============================================
    public function listPerkara()
    {
        $perkaraModel = new PerkaraModel();

        $perkara = $perkaraModel
            ->select('tabel_perkara.*, tabel_klien.nama as nama_klien, tabel_status_perkara.nama_status')
            ->join('tabel_klien', 'tabel_klien.id = tabel_perkara.id_klien')
            ->join('tabel_status_perkara', 'tabel_status_perkara.id = tabel_perkara.status', 'left')
            ->where('tabel_perkara.id_pengacara', $this->id_pengacara)
            ->findAll();

        $data = [
            'judul'    => 'Daftar Perkara',
            'perkara'  => $perkara,
            'klien'    => $this->db->table('tabel_klien')->where('id_pengacara', $this->id_pengacara)->get()->getResultArray(),
            'statusPerkara' => $this->db->table('tabel_status_perkara')->get()->getResultArray(),
            'jenisPerkara'  => $this->db->table('tabel_jenis_perkara')->get()->getResultArray(),
            'username' => $this->username,
            'email'    => $this->email,
            'peran'    => $this->peran
        ];

        return view('temp_pengacara/head', $data)
            . view('temp_pengacara/header', $data)
            . view('temp_pengacara/nav', $data)
            . view('temp_pengacara/perkara/list', $data)
            . view('temp_pengacara/footer');
    }

    public function savePerkara()
    {
        $post = $this->request->getPost();
        $perkaraModel = new PerkaraModel();

        $tanggal_mulai = $post['tanggal_mulai'];
        $bulan = date('n', strtotime($tanggal_mulai));
        $tahun = date('Y', strtotime($tanggal_mulai));

        $romawi = [
            1=>'I',2=>'II',3=>'III',4=>'IV',
            5=>'V',6=>'VI',7=>'VII',8=>'VIII',
            9=>'IX',10=>'X',11=>'XI',12=>'XII'
        ];

        $last = $this->db->table('tabel_perkara')
            ->select('nomor_perkara')
            ->where('MONTH(tanggal_mulai)', $bulan)
            ->where('YEAR(tanggal_mulai)', $tahun)
            ->orderBy('id', 'DESC')
            ->get()->getRowArray();

        $urut = 1;
        if ($last) {
            preg_match('/^(\d+)\//', $last['nomor_perkara'], $m);
            if(isset($m[1])) $urut = $m[1] + 1;
        }

        $nomor = $urut . '/MDS/SKK/' . $romawi[$bulan] . '/' . $tahun;

        $perkaraModel->insert([
            'nomor_perkara'  => $nomor,
            'judul'          => $post['judul'],
            'id_klien'       => $post['id_klien'],
            'id_pengacara'   => $this->id_pengacara,
            'status'         => $post['status'],
            'jenis_kasus'    => $post['jenis_kasus'],
            'deskripsi'      => $post['deskripsi'],
            'tanggal_mulai'  => $tanggal_mulai,
            'tanggal_selesai'=> $post['tanggal_selesai']
        ]);

        return redirect()->back()->with('success', 'Perkara berhasil ditambahkan!');
    }

    public function updatePerkara()
    {
        $post = $this->request->getPost();
        $perkaraModel = new PerkaraModel();

        $perkaraModel->update($post['id'], [
            'status'         => $post['id_status'],
            'tanggal_mulai'  => $post['tanggal_mulai'],
            'tanggal_selesai'=> $post['tanggal_selesai']
        ]);

        return redirect()->back()->with('success', 'Perkara berhasil diperbarui!');
    }

    public function deletePerkara($id)
    {
        $perkaraModel = new PerkaraModel();
        $perkaraModel->delete($id);

        return redirect()->back()->with('success', 'Perkara berhasil dihapus!');
    }

    // ============================================
    // LOGIN
    // ============================================
    public function login()
    {
        return view('temp_pengacara/login/head')
            . view('temp_pengacara/login/login')
            . view('temp_pengacara/login/footer');
    }

public function doLogin()
{
    $username = $this->request->getPost('username');
    $password = $this->request->getPost('kata_sandi');

    // Ambil data pengguna berdasarkan username
    $user = $this->db->table('tabel_pengguna')
        ->where('username', $username)
        ->get()
        ->getRowArray();

    // Cek username
    if (!$user) {
        return redirect()->back()->with('error', 'Username tidak ditemukan!');
    }

    // Cek password
    if (!password_verify($password, $user['kata_sandi'])) {
        return redirect()->back()->with('error', 'Kata sandi salah!');
    }

    // Simpan session minimal
    session()->set([
        'username' => $user['username'],
        'is_pengacara_login' => true   // flag sederhana untuk cek login
    ]);

    return redirect()->to('/pengacara/dashboard');
}



    // ============================================
    // LOGOUT
    // ============================================
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/pengacara/login');
    }
}
