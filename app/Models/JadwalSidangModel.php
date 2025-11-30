<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalSidangModel extends Model
{
    private $sourceUrl = 'https://sipp.pn-negara.go.id/list_jadwal_sidang';

    public function getJadwalSidang()
    {
        // Ambil HTML dari website SIPP
        $html = @file_get_contents($this->sourceUrl);
        if ($html === false) {
            return []; // Jika gagal ambil data, kembalikan array kosong
        }

        libxml_use_internal_errors(true);

        // DOM parsing
        $dom = new \DOMDocument();
        $dom->loadHTML($html);
        libxml_clear_errors();

        $xpath = new \DOMXPath($dom);

        // Ambil semua <tr> dalam tabel
        $rows = $xpath->query('//table//tr');

        $jadwals = [];

        foreach ($rows as $i => $tr) {

            // Baris pertama biasanya header => skip
            if ($i === 0) {
                continue;
            }

            $cols = $tr->getElementsByTagName('td');

            // Pastikan jumlah kolom cukup
            if ($cols->length < 6) {
                continue;
            }

            $item = [
                'no'               => trim($cols->item(0)->textContent),
                'tanggal_sidang'   => trim($cols->item(1)->textContent),
                'nomor_perkara'    => trim($cols->item(2)->textContent),
                'sidang_keliling'  => trim($cols->item(3)->textContent),
                'ruangan'          => trim($cols->item(4)->textContent),
                'agenda'           => trim($cols->item(5)->textContent),
                'detil'            => null
            ];

            // Kolom link detil (jika ada)
            if ($cols->length > 6) {
                $aTags = $cols->item(6)->getElementsByTagName('a');
                if ($aTags->length > 0) {
                    $item['detil'] = $aTags->item(0)->getAttribute('href');
                }
            }

            $jadwals[] = $item;
        }

        return $jadwals;
    }
}
