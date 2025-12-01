<?php

namespace App\Controllers;

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

class Word extends BaseController
{
    public function create()
    {
        // Inisialisasi PhpWord
        $phpWord = new PhpWord();

        // Tambah section
        $section = $phpWord->addSection();

        // Tambah teks
        $section->addText("Halo, ini contoh dokumen Word di CI4");

        // Simpan dokumen Word
        $fileName = 'ContohWord.docx';
        $filePath = WRITEPATH . $fileName; // folder writable CI4 biasanya WRITEPATH

        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($filePath);

        return $this->response->download($filePath, null)->setFileName($fileName);
    }
}
