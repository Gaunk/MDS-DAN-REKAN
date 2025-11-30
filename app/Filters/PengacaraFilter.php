<?php
namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class PengacaraFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        // Cek login berdasarkan flag is_pengacara_login
        if (!$session->get('is_pengacara_login')) {
            return redirect()->to('/pengacara/login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        // Tambahan: cek username di session
        if (!$session->get('username')) {
            return redirect()->to('/pengacara/login')
                ->with('error', 'Username tidak ditemukan, silakan login kembali.');
        }

        // Semua valid → lanjut
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // opsional
    }
}
