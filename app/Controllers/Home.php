<?php

namespace App\Controllers;

use App\Models\PengaturanSistemModel;
use App\Models\PengacaraModel;
use App\Models\KontakModel;
class Home extends BaseController
{
    public function index(): string
    {
        // Ambil pengaturan sistem (baris pertama)
        $pengaturan = (new PengaturanSistemModel())->first() ?? [];

        // Ambil semua pengacara
        $pengacara = (new PengacaraModel())->findAll();

        // Siapkan data global untuk view
        $data = [
            'judul'      => $pengaturan['nama_perusahaan'] ?? 'Nama Perusahaan',
            'pengaturan' => $pengaturan,
            'pengacara'  => $pengacara
        ];

        // Load view
        return 
            view('temp_home/head', $data) .
            view('temp_home/nav', $data) .
            view('home', $data) .
            view('temp_home/footer', $data);
    }

    public function submit()
{
    if (!$this->request->isAJAX()) {
        return redirect()->back();
    }

    $kontakModel = new \App\Models\KontakModel();

    $validation = \Config\Services::validation();
    $validation->setRules([
        'name'    => 'required',
        'email'   => 'required|valid_email',
        'subject' => 'required',
        'message' => 'required',
    ]);

    if (!$validation->withRequest($this->request)->run()) {
        return $this->response->setJSON(['errors' => $validation->getErrors()]);
    }

    $kontakModel->save([
        'name'    => $this->request->getPost('name'),
        'email'   => $this->request->getPost('email'),
        'subject' => $this->request->getPost('subject'),
        'message' => $this->request->getPost('message'),
    ]);

    return $this->response->setJSON(['success' => 'Your message has been sent. Thank you!']);
}

}
