<?php
namespace App\Libraries;

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

class SuratWordService
{
    public function generate(array $surat)
{
    $phpWord = new \PhpOffice\PhpWord\PhpWord();
    $section = $phpWord->addSection();

    // ========= HEADER DENGAN LOGO =========
    $header = $section->addHeader();

    // Tabel untuk menyejajarkan logo dan teks kop surat
    $table = $header->addTable();
    $row   = $table->addRow();

    // ==== CELL 1: LOGO ====
    $cellLogo = $row->addCell(2000);
    $logoPath = dirname(__DIR__, 2) . '/public/images/icon-1.png';

	$cellLogo->addImage(
	    $logoPath,   // ← gunakan path absolut yang sudah dibuat
	    [
	        'width'     => 70,
	        'height'    => 70,
	        'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER
	    ]
	);


    // ==== CELL 2: TEKS KOP SURAT ====
    $cellText = $row->addCell(8000);

    $cellText->addText(
        'KANTOR HUKUM MDS & REKAN',
        ['bold' => true, 'size' => 16],
        ['alignment' => 'center']
    );

    $cellText->addText(
        'ADVOKAT - KONSULTAN HUKUM - ARBITER - MEDIATOR',
        ['bold' => true, 'size' => 11],
        ['alignment' => 'center']
    );

    // Garis horizontal kop surat
    $header->addLine([
        'weight'     => 2,
        'width'      => 900,
        'height'     => 0,
        'color'      => '000000',
        'alignment'  => 'center'
    ]);

    // ========= ISI SURAT SESUAI TEKS ANDA =========
    $section->addTextBreak(1);

    $section->addText(
    'SURAT KUASA KHUSUS',
    ['bold' => true, 'size' => 16],
    ['alignment' => 'center']
	);

	$surat['nomor_perkara'];
	$section->addText(
	    'Nomor: ' . $surat['nomor_perkara'],   // ← DIAMBIL DARI DATA
	    ['bold' => true, 'size' => 12],
	    ['alignment' => 'center']
	);



    $section->addTextBreak(1);

    // Pemberi Kuasa
    $section->addText("Yang bertanda tangan dibawah ini:\n");

	$fontStyle = ['name' => 'Times New Roman', 'size' => 12];

	$labels = [
	    'Nama' => $surat['nama_klien'] ?? '-',
	    'NIK' => $surat['nik'] ?? '-',
	    'TTL' => $surat['ttl'] ?? '-',
	    'Jenis Kelamin' => $surat['jenis_kelamin'] ?? '-',
	    'Pekerjaan' => $surat['pekerjaan'] ?? '-',
	    'Alamat' => $surat['alamat'] ?? '-',
	];

	// Tambahkan extra padding, misal 3 spasi setelah label
	$extraSpace = 3;
	$maxLength = max(array_map('strlen', array_keys($labels))) + $extraSpace;

	$section->addText("Yang bertanda tangan dibawah ini:", $fontStyle);
	$section->addTextBreak(1);

	foreach ($labels as $label => $value) {
	    $line = str_pad($label, $maxLength) . ": " . $value;
	    $section->addText($line, $fontStyle);
	}


    $section->addTextBreak(1);
    $section->addText("Selanjutnya disebut sebagai PEMBERI KUASA.\n");

    // Penerima Kuasa
    $section->addText("Dalam hal ini memilih domisili hukum kuasanya, memberikan kuasa kepada:");

    $section->addTextBreak(1);

    $penerima = [
        "MUHAMMAD IDRIS SAEFATURAHMAN, S.H., CPM., CPCLE., CPArb.",
        "ADITYA KHARISMA, S.H.",
        "MUHAMAD DARUSSALAM, S.H., CPM",
        "HENDRI PRATAMA, S.H.",
        "RIDUAN SANUR, S.H.",
        "H. PARLINDUNGAN SIMORANGKIR"
    ];

    foreach ($penerima as $p) {
        $section->addText($p);
    }

    $section->addTextBreak(1);
    $section->addText(
        "Advokat dan Asisten Advokat pada Kantor Hukum MDS & REKAN yang beralamat di Perumahan Sukahati Residence Blok E RT 003 RW 005 Pajeleran, Sukahati, Kabupaten Bogor, Jawa Barat 16931, bertindak secara bersama-sama atau sendiri-sendiri, selanjutnya disebut sebagai PENERIMA KUASA."
    );

    $section->addTextBreak(1);
    $section->addText(
        "——————————————— KHUSUS ———————————————",
        ['bold' => true, 'size' => 12],
        ['alignment' => 'center']
    );

    $section->addTextBreak(1);
    $section->addText(
        "Untuk dan atas nama Pemberi Kuasa, mewakili, mendampingi, menghadap, serta membela hak dan kepentingan hukum pemberi kuasa..."
    );

    $section->addTextBreak(2);
    $section->addText("Bogor, 05 November 2025");

    // Tanda tangan 2 kolom
    $table = $section->addTable();
    $row   = $table->addRow();

    $row->addCell(5000)->addText("Penerima Kuasa");
    $row->addCell(5000)->addText("Pemberi Kuasa");

    $section->addTextBreak(3);
    $section->addText("Muhidin");

    // =========== GENERATE FILE ===========
    $filename = "Surat_Kuasa_Khusus_Muhidin.docx";

    header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
    header("Content-Disposition: attachment; filename=\"$filename\"");
    header('Cache-Control: max-age=0');

    $writer = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
    $writer->save('php://output');
    exit;
}

}
