<?php

namespace App\Controllers;

use App\Models\TabelBarcodeModel;
use App\Models\PengacaraModel;

class Profile extends BaseController
{
    public function view($id)
    {
        // Load the model
        $model = new TabelBarcodeModel();
        $pengacaraModel = new PengacaraModel();  // Load Pengacara model to join

        // Get the data for the profile based on the $id and join with tabel_pengacara
        $profileData = $model
            ->join('tabel_pengacara', 'tabel_pengacara.id = tabel_barcode.nama_pengacara', 'left')  // Join tabel_barcode with tabel_pengacara on nama_pengacara
            ->where('tabel_barcode.id', $id)  // Filter by the profile ID
            ->first();  // Get the first matching result

        // If the profile does not exist, show an error
        if (!$profileData) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Profile with ID $id not found.");
        }

        // You can add any additional data you want to pass to the view here, e.g., the lawyer's name
        // Pass the profile data to the view
        return view('profile/view', ['profile' => $profileData]);
    }
}
