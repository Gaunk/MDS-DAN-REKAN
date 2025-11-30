<?php 


// ==========================
    // LOGIN ADMIN
    // ==========================
    public function login()
    {
        return view('temp_admin/login/head').
        view('temp_admin/login/login').
        view('temp_admin/login/footer');
    }

public function doLogin()
{
    $username   = $this->request->getPost('username');
    $kata_sandi = $this->request->getPost('kata_sandi');

    $db = db_connect();
    // Cari data pengguna + join untuk ambil nama pengacara
    $user = $db->table('tabel_pengguna as u')
        ->select('u.id, u.username, u.kata_sandi, u.peran, p.nama as nama_pengacara')
        // JOIN: asumsi p.id = u.id — sesuaikan dengan struktur relasi di database
        ->join('tabel_pengacara as p', 'p.id = u.id', 'left')
        ->where('u.username', $username)
        ->get()
        ->getRowArray();

    if (!$user) {
        return redirect()->back()->with('error', 'Username tidak ditemukan!');
    }

    if (!password_verify($kata_sandi, $user['kata_sandi'])) {
        return redirect()->back()->with('error', 'Password salah!');
    }

    // Simpan session
    session()->set([
        'user_id'   => $user['id'],
        // Jika ada nama_pengacara hasil join, pakai itu, kalau tidak, pakai username
        'user_nama' => $user['nama_pengacara'] ?? $user['username'],
        'user_role' => $user['peran'],
        'is_admin_login'  => true
    ]);

    // Redirect sesuai role
    switch ($user['peran']) {
        case 'admin':
            return redirect()->to('/admin/dashboard');
        case 'pengacara':
            return redirect()->to('/pengacara/dashboard');
        case 'staff':
            return redirect()->to('/staff/dashboard');
        case 'paralegal':
            return redirect()->to('/paralegal/dashboard');
        default:
            session()->destroy();
            return redirect()->to('/login')->with('error', 'Role tidak valid!');
    }
}




    public function logout()
    {
        session()->destroy();
        return redirect()->to('/admin/login');
    }
}
