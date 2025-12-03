<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class LanguageFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        // Jika user pilih bahasa
        if ($request->getGet('lang')) {
            $session->set('lang', $request->getGet('lang'));
        }

        // Default bahasa Indonesia
        $lang = $session->get('lang') ?? 'id';

        // Set bahasa aktif
        service('request')->setLocale($lang);
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
