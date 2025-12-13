<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class CorsFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Tidak perlu menambahkan apa pun di sini
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Menambahkan header CORS
        $response->setHeader('Access-Control-Allow-Origin', '*');
        $response->setHeader('Access-Control-Allow-Methods', 'GET, POST, DELETE, PUT');
        $response->setHeader('Access-Control-Allow-Headers', 'Content-Type, X-Requested-With');

        return $response;
    }
}
