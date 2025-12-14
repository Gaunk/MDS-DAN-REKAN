<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <!-- HEADER -->
            <div class="row mb-3">
                <div class="col-md-12 d-flex justify-content-between align-items-center">
                    <h2 class="title-1">Daftar Barcode Pengacara</h2>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahBarcodeModal">
                        <i class="fa fa-plus"></i>Tambah Barcode
                    </button>
                </div>
            </div>

            <!-- TABLE -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive mt-3">
                        <table class="table table-borderless table-striped table-earning" id="barcodeTable">
                            <thead class="table-dark text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pengacara</th>
                                    <th>Spesialis</th>
                                    <th>No. Handphone</th>
                                    <th>Maps</th>
                                    <th>Foto</th>
                                    <th>Link Profil</th>
                                    <th>QR Code</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=1; foreach($barcodeData as $d): ?>
                                <tr class="align-middle">
                                    <td class="text-center"><?= $no++ ?></td>
                                    <td><?= esc($d['nama_pengacara']) ?></td>
                                    <td><?= esc($d['spesialis']) ?></td>
                                    <td class="text-center"><?= esc($d['no_hp']) ?></td>
                                    <td class="text-wrap text-center">
                                        <?php if (!empty($d['lokasi_maps'])): ?>
                                            <a class="text-info" href="<?= esc($d['lokasi_maps']); ?>" target="_blank">
                                                <i class="bi bi-geo-alt-fill text-danger"></i> Maps
                                            </a>
                                        <?php else: ?>
                                            -
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($d['foto']): ?>
                                            <img src="<?= base_url('uploads/profile/'.$d['foto']) ?>" alt="Foto Pengacara" width="50" height="50">
                                        <?php else: ?>
                                            No Foto
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-sm btn-primary" 
                                                onclick="window.open('<?= esc($d['link_profile']) ?>', '_blank')"
                                                title="Lihat Detail">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                    </td>
                                    <td class="text-center">
                                        <img src="https://api.qrserver.com/v1/create-qr-code/?data=<?= urlencode($d['link_profile']) ?>&size=100x100" alt="QR Code">
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-warning btn-sm" 
                                            onclick='editBarcodeModal(<?= json_encode([
                                                'id' => $d['id'] ?? null,
                                                'nama_pengacara' => $d['nama_pengacara'] ?? '',
                                                'spesialis' => $d['spesialis'] ?? '',
                                                'no_hp' => $d['no_hp'] ?? '',
                                                'lokasi_maps' => $d['lokasi_maps'] ?? '',
                                                'latitude' => $d['latitude'] ?? '',
                                                'longitude' => $d['longitude'] ?? '',
                                                'foto' => $d['foto'] ?? ''
                                            ], JSON_HEX_APOS | JSON_HEX_QUOT) ?>)'>
                                            <i class="fa fa-edit"></i>
                                        </button>



                                        <button class="btn btn-sm btn-danger" 
                                                onclick="deleteBarcode(<?= $d['id'] ?>)">
                                            <i class="fa fa-trash"></i>
                                        </button>

                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
<!-- Modal Tambah Barcode -->
<div class="modal fade" id="tambahBarcodeModal" tabindex="-1" aria-labelledby="tambahBarcodeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Barcode Pengacara</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="tambahBarcodeForm" enctype="multipart/form-data">
                    <div class="row">
                        <!-- Kolom 1 -->
                        <div class="col-md-6 mb-3">
                            <label for="nama_pengacara" class="form-label">Nama Pengacara</label>
                            <select class="form-control" id="nama_pengacara" name="nama_pengacara" required>
                                <option value="" disabled selected>Pilih Nama Pengacara</option>
                                <?php foreach ($pengacaraData as $pengacara): ?>
                                    <option value="<?= $pengacara['id']; ?>" data-id="<?= $pengacara['id']; ?>"><?= esc($pengacara['nama']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="spesialis" class="form-label">Spesialis</label>
                            <input type="text" class="form-control" id="spesialis" name="spesialis" required>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Kolom 2 -->
                        <div class="col-md-6 mb-3">
                            <label for="no_hp" class="form-label">No. Handphone</label>
                            <input type="number" class="form-control" id="no_hp" name="no_hp" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="lokasi_maps" class="form-label">Lokasi Maps</label>
                            <input type="text" class="form-control" id="lokasi_maps" name="lokasi_maps" placeholder="Cari lokasi..." required>
                            <div id="suggestions"></div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Kolom 3 -->
                        <div class="col-md-6 mb-3">
                            <input type="hidden" id="latitude" name="latitude">
                            <input type="hidden" id="longitude" name="longitude">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="foto" class="form-label">Foto</label>
                            <input type="file" class="form-control" id="foto" name="foto">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="barcode" class="form-label"></label>
                            <div id="barcodePreview" style="text-align:center;">
                                <!-- QR Code Image will appear here -->
                            </div>
                        </div>
                    </div>
                    
                    <!-- Tombol Simpan -->
                    <div class="d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Barcode -->
<div class="modal fade" id="editBarcodeModal" tabindex="-1" aria-labelledby="editBarcodeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- modal lebih lebar -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editBarcodeModalLabel">Edit Barcode Pengacara</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editBarcodeForm" enctype="multipart/form-data">
                    <input type="hidden" id="editBarcodeId" name="id">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_nama_pengacara" class="form-label">Nama Pengacara</label>
                            <select class="form-control" id="edit_nama_pengacara" name="nama_pengacara" required>
                                <option value="" disabled selected>Pilih Nama Pengacara</option>
                                <?php foreach ($pengacaraData as $pengacara): ?>
                                    <option value="<?= $pengacara['id']; ?>"><?= esc($pengacara['nama']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_spesialis" class="form-label">Spesialis</label>
                            <input type="text" class="form-control" id="edit_spesialis" name="spesialis" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_no_hp" class="form-label">No. Handphone</label>
                            <input type="number" class="form-control" id="edit_no_hp" name="no_hp" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_lokasi_maps" class="form-label">Lokasi Maps</label>
                            <input type="text" class="form-control" id="edit_lokasi_maps" name="lokasi_maps" placeholder="Cari lokasi..." required>
                            <div id="edit_suggestions"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <input type="hidden" id="edit_latitude" name="latitude">
                            <input type="hidden" id="edit_longitude" name="longitude">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_foto" class="form-label">Foto</label>
                            <input type="file" class="form-control" id="edit_foto" name="foto">
                            <div id="edit_fotoPreview" style="text-align:center; margin-top:10px;"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_barcode" class="form-label"></label>
                            <div id="edit_barcodePreview" style="text-align:center;"></div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>// Fungsi untuk menampilkan modal dan mengisi data dari tabel_barcode
function editBarcodeModal(data) {
    // Isi form
    document.getElementById('editBarcodeId').value = data.id || '';
    document.getElementById('edit_nama_pengacara').value = data.nama_pengacara || '';
    document.getElementById('edit_spesialis').value = data.spesialis || '';
    document.getElementById('edit_no_hp').value = data.no_hp || '';
    document.getElementById('edit_lokasi_maps').value = data.lokasi_maps || '';
    document.getElementById('edit_latitude').value = data.latitude || '';
    document.getElementById('edit_longitude').value = data.longitude || '';

    // Foto preview
    const fotoPreview = document.getElementById('edit_fotoPreview');
    if (data.foto) {
        fotoPreview.innerHTML = `<img src="<?= base_url('uploads/profile/') ?>${data.foto}" alt="Foto Pengacara" width="120" class="img-thumbnail">`;
    } else {
        fotoPreview.innerHTML = 'No Foto';
    }

    // QR Code preview
    const profileUrl = `<?= base_url('profile') ?>/${data.id}`;
    const qrCodeUrl = `https://api.qrserver.com/v1/create-qr-code/?data=${encodeURIComponent(profileUrl)}&size=150x150`;
    document.getElementById('edit_barcodePreview').innerHTML = `<img src="${qrCodeUrl}" alt="QR Code">`;

    // Tampilkan modal (Bootstrap 5)
    const editModal = new bootstrap.Modal(document.getElementById('editBarcodeModal'));
    editModal.show();
}

// Submit form edit ke tabel_barcode
document.getElementById('editBarcodeForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    const id = formData.get('id');

    fetch(`<?= base_url('admin/updatebarcode') ?>/${id}`, {
        method: 'POST',  // POST sesuai route CI4
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if(data.success) Swal.fire('Berhasil', data.message, 'success').then(() => location.reload());
        else Swal.fire('Gagal', data.message, 'error');
    })
    .catch(() => Swal.fire('Error', 'Terjadi kesalahan server.', 'error'));
});

function deleteBarcode(id) {
    if (!id) return alert('ID tidak valid');

    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Data ini akan dihapus secara permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`<?= base_url('admin/deletebarcode') ?>/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    Swal.fire('Berhasil!', data.message, 'success')
                        .then(() => location.reload());
                } else {
                    Swal.fire('Gagal!', data.message ?? 'Gagal menghapus data.', 'error');
                }
            })
            .catch(() => {
                Swal.fire('Error!', 'Terjadi kesalahan server.', 'error');
            });
        }
    });
}

// Fungsi untuk form tambah barcode
document.getElementById('tambahBarcodeForm').addEventListener('submit', function(e) {
    e.preventDefault();  // Mencegah reload halaman

    let formData = new FormData(this);  // Ambil data form

    // Kirim data menggunakan Fetch API untuk tambah barcode
    fetch('<?= base_url('admin/prosesbarcode') ?>', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())  // Response dalam format JSON
    .then(data => {
        if (data.success) {
            // Menampilkan SweetAlert jika berhasil
            Swal.fire({
                title: 'Berhasil!',
                text: 'Barcode pengacara berhasil ditambahkan.',
                icon: 'success'
            }).then(() => {
                location.reload();  // Reload halaman untuk memperbarui data
            });
        } else {
            // Menampilkan SweetAlert jika gagal
            Swal.fire({
                title: 'Gagal!',
                text: data.message || 'Terjadi kesalahan.',
                icon: 'error'
            });
        }
    })
    .catch(error => {
        // Menampilkan pesan error jika terjadi kesalahan pada fetch request
        Swal.fire({
            title: 'Error!',
            text: 'Terjadi kesalahan saat mengirim data.',
            icon: 'error'
        });
    });
});

// Mendengarkan perubahan di select nama_pengacara saat memilih nama pengacara
document.getElementById('nama_pengacara').addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex];
    const pengacaraId = selectedOption.getAttribute('data-id');
    const profileUrl = `http://localhost:8080/profile/${pengacaraId}`;
    const qrCodeUrl = `https://api.qrserver.com/v1/create-qr-code/?data=${encodeURIComponent(profileUrl)}&size=150x150`;

    // Menampilkan QR code di modal
    document.getElementById('barcodePreview').innerHTML = `<img src="${qrCodeUrl}" alt="QR Code">`;
});

// Autocomplete lokasi untuk form tambah barcode
document.getElementById('lokasi_maps').addEventListener('input', function() {
    const query = this.value;
    if(query.length > 2) {
        fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${query}&addressdetails=1&countrycodes=id&limit=5`)
        .then(r => r.json())
        .then(data => {
            let suggestions = '';
            data.forEach(loc => {
                suggestions += `<p onclick="selectLocation('${loc.display_name}',${loc.lat},${loc.lon})">${loc.display_name}</p>`;
            });
            document.getElementById('suggestions').innerHTML = suggestions;
        });
    } else {
        document.getElementById('suggestions').innerHTML = '';
    }
});

// Menangani pilihan lokasi dari autocomplete
function selectLocation(location, lat, lon) {
    document.getElementById('lokasi_maps').value = location;
    document.getElementById('latitude').value = lat;
    document.getElementById('longitude').value = lon;
    document.getElementById('suggestions').innerHTML = '';
}
</script>