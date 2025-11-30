<!-- MAIN CONTENT -->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <!-- HEADER -->
            <div class="row mb-3">
                <div class="col-md-12 d-flex justify-content-between align-items-center">
                    <h2 class="title-1">Data Perkara</h2>
                    <button class="au-btn au-btn-icon au-btn--blue" 
                            data-bs-toggle="modal" 
                            data-bs-target="#modalTambahPerkara">
                        <i class="zmdi zmdi-plus"></i>Tambah Perkara
                    </button>
                </div>
            </div>

            <!-- SEARCH FIELD -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <input type="text" id="searchInput" class="form-control" placeholder="Cari perkara... (nomor, klien, status)">
                </div>
            </div>

            <!-- TABLE -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive mt-3">
                        <table class="table table-borderless table-striped table-earning" id="perkaraTable">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th>No</th>
                                    <th>Nomor Perkara</th>
                                    <th>Nama Klien</th>
                                    <th>Jenis Kasus</th>
                                    <th>Deskripsi</th>
                                    <th>Status</th>
                                    <th>Pengacara</th>
                                    <th class="text-end">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach($perkara as $pkr): ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td>
                                        <?= esc($pkr['nomor_perkara']); ?>
                                    </td>

                                    <!-- Nama Klien readonly dropdown -->
                                    <td>
                                     <span class="text-success font-weight-bold">
                                        <?php 
                                            foreach ($klien as $k) {
                                                if ($k['id'] == $pkr['id_klien']) {
                                                    echo esc($k['nama']);
                                                    break;
                                                }
                                            }
                                        ?>
                                    </span>

                                    </td>
                                    <td><?= esc($pkr['nama_jenis_kasus']); ?></td>
                                    <td><?= esc($pkr['deskripsi']); ?></td>
                                    <td><?= esc($pkr['nama_status']); ?></td>

                                    <!-- Pengacara readonly dropdown -->
                                    <td>
                                        <select class="form-select form-select-sm" disabled>
                                            <?php foreach($pengacara as $p): ?>
                                                <option value="<?= $p['id']; ?>" <?= ($p['id'] == $pkr['id_pengacara']) ? 'selected' : '' ?>>
                                                    <?= esc($p['nama']); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>

                                    <td class="text-end">
                                        <!-- EDIT -->
                                        <button class="btn btn-warning btn-sm text-white btnEditPerkara"
                                            data-id="<?= $pkr['id']; ?>"
                                            data-nomor="<?= esc($pkr['nomor_perkara']); ?>"
                                            data-judul="<?= esc($pkr['judul']); ?>"
                                            data-id_klien="<?= $pkr['id_klien']; ?>"
                                            data-status="<?= esc($pkr['status']); ?>"
                                            data-id_pengacara="<?= $pkr['id_pengacara']; ?>"
                                            data-tanggal_mulai="<?= $pkr['tanggal_mulai']; ?>"
                                            data-tanggal_selesai="<?= $pkr['tanggal_selesai']; ?>"
                                            data-deskripsi="<?= esc($pkr['deskripsi']); ?>"
                                            data-jenis_kasus="<?= esc($pkr['jenis_kasus']); ?>"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalEditPerkara">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>


                                        <!-- DELETE -->
                                        <button class="btn btn-danger btn-sm deletePerkaraBtn"
                                            data-id="<?= $pkr['id']; ?>"
                                            data-nomor="<?= esc($pkr['nomor_perkara']); ?>">
                                            <i class="bi bi-trash"></i>
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

<!-- =============================================================== -->
<!-- MODAL TAMBAH PERKARA -->
<!-- =============================================================== -->
<div class="modal fade" id="modalTambahPerkara" tabindex="-1" role="dialog" aria-labelledby="modalTambahPerkaraLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalTambahPerkaraLabel">Tambah Perkara</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form action="/admin/saveperkara" method="POST">
                <div class="modal-body">
                    <!-- Nomor Perkara -->
                    <div class="mb-3">
                        <label for="nomor_perkara" class="form-label">Nomor Perkara</label>
                        <input type="text" name="nomor_perkara" id="nomor_perkara" class="form-control" 
                               value="<?= esc($nextNomorPerkara); ?>" readonly>
                    </div>

                    <!-- Judul -->
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" name="judul" id="judul" class="form-control" required>
                    </div>

                    <!-- Container select dengan flex -->
                    <div class="row-selects">
                        <div class="form-select-wrapper">
                            <label for="id_klien" class="form-label">Nama Klien</label>
                            <select name="id_klien" id="id_klien" class="form-select" required>
                                <option value="">-- Pilih Klien --</option>
                                <?php foreach($klien as $k): ?>
                                    <option value="<?= $k['id']; ?>"><?= esc($k['nama']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-select-wrapper">
                            <label for="jenis_kasus" class="form-label">Jenis Kasus</label>
                            <select name="jenis_kasus" id="jenis_kasus" class="form-select" required>
                                <option value="">-- Pilih Jenis Kasus --</option>
                                <?php foreach ($jenisPerkara as $jenis): ?>
                                    <option value="<?= esc($jenis['id']); ?>"><?= esc($jenis['nama_jenis']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-select-wrapper">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="">-- Pilih Status --</option>
                                <?php foreach($statusPerkara as $s): ?>
                                    <option value="<?= $s['id']; ?>"><?= esc($s['nama_status']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-select-wrapper">
                            <label for="id_pengacara" class="form-label">Pengacara</label>
                            <select name="id_pengacara" id="id_pengacara" class="form-select" required>
                                <option value="">-- Pilih Pengacara --</option>
                                <?php foreach($pengacara as $p): ?>
                                    <option value="<?= $p['id']; ?>"><?= esc($p['nama']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-3 mt-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3"></textarea>
                    </div>

                    <!-- Tanggal Mulai -->
                    <div class="mb-3">
                        <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control">
                    </div>

                    <!-- Tanggal Selesai -->
                    <div class="mb-3">
                        <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                        <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- CSS untuk merapikan select -->
<style>
/* Container row select */
.row-selects {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem; /* jarak antar select */
    margin-top: 0.5rem;
}

/* Set lebar tiap select agar sejajar 4 per baris */
.form-select-wrapper {
    flex: 1 1 calc(25% - 0.75rem);
}

/* Responsive: full width di layar kecil */
@media (max-width: 992px) {
    .form-select-wrapper {
        flex: 1 1 50%; /* 2 per baris di tablet */
    }
}

@media (max-width: 576px) {
    .form-select-wrapper {
        flex: 1 1 100%; /* 1 per baris di mobile */
    }
}
</style>
<!-- end modal medium tambah perkara -->

<!-- =============================================================== -->
<!-- MODAL EDIT PERKARA -->
<!-- =============================================================== -->
<div class="modal fade" id="modalEditPerkara" tabindex="-1">
    <div class="modal-dialog modal-md">

        <form action="/admin/updateperkara" method="POST" class="modal-content">

            <!-- Header -->
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title">Edit Perkara</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Body -->
            <div class="modal-body">

                <input type="hidden" name="id" id="edit_id">

                <!-- Nomor Perkara -->
                <div class="mb-3">
                    <label>Nomor Perkara</label>
                    <input type="text" name="nomor_perkara" id="edit_nomor" class="form-control" readonly>
                </div>

                <!-- Judul -->
                <div class="mb-3">
                    <label>Judul</label>
                    <input type="text" name="judul" id="edit_judul" class="form-control">
                </div>

                <!-- Klien -->
                <div class="mb-3">
                    <label>Nama Klien</label>
                    <select name="id_klien" id="edit_id_klien" class="form-select">
                        <?php foreach($klien as $k): ?>
                            <option value="<?= $k['id']; ?>"><?= esc($k['nama']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Jenis Kasus -->
                <div class="mb-3">
                    <label>Jenis Kasus</label>
                    <select name="id_jenis_perkara" id="edit_jenis_perkara" class="form-select" required>
                        <?php foreach($jenisPerkara as $jenis): ?>
                            <option value="<?= $jenis['id']; ?>"><?= esc($jenis['nama_jenis']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Status -->
                <div class="mb-3">
                    <label>Status</label>
                    <select name="id_status" id="edit_status" class="form-select" required>
                        <?php foreach($statusPerkara as $s): ?>
                            <option value="<?= $s['id']; ?>"><?= esc($s['nama_status']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Pengacara -->
                <div class="mb-3">
                    <label>Pengacara</label>
                    <select name="id_pengacara" id="edit_id_pengacara" class="form-select">
                        <?php foreach($pengacara as $p): ?>
                            <option value="<?= $p['id']; ?>"><?= esc($p['nama']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Deskripsi -->
                <div class="mb-3">
                    <label for="edit_deskripsi">Deskripsi</label>
                    <textarea name="deskripsi" id="edit_deskripsi" class="form-control" rows="3"></textarea>
                </div>

                <!-- Tanggal Mulai -->
                <div class="mb-3">
                    <label>Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" id="edit_tanggal_mulai" class="form-control">
                </div>

                <!-- Tanggal Selesai -->
                <div class="mb-3">
                    <label>Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" id="edit_tanggal_selesai" class="form-control">
                </div>

            </div>

            <!-- Footer -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-warning">Perbarui</button>
            </div>

        </form>

    </div>
</div>

<!-- JAVASCRIPT -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
/* SWEETALERT TOAST */
<?php if(session()->getFlashdata('success')): ?>
Swal.fire({
    toast: true,
    icon: 'success',
    title: '<?= session()->getFlashdata('success') ?>',
    position: 'top-end',
    showConfirmButton: false,
    timer: 2500
});
<?php endif; ?>

<?php if(session()->getFlashdata('error')): ?>
Swal.fire({
    toast: true,
    icon: 'error',
    title: '<?= session()->getFlashdata('error') ?>',
    position: 'top-end',
    showConfirmButton: false,
    timer: 2500
});
<?php endif; ?>

/* FILL EDIT MODAL */

   document.querySelectorAll('.btnEditPerkara').forEach(btn => {
    btn.addEventListener('click', function () {
        document.getElementById('edit_id').value = this.dataset.id;
        document.getElementById('edit_nomor').value = this.dataset.nomor;
        document.getElementById('edit_judul').value = this.dataset.judul;
        document.getElementById('edit_id_klien').value = this.dataset.id_klien;
        document.getElementById('edit_jenis_perkara').value = this.dataset.jenis_kasus;
        document.getElementById('edit_deskripsi').value = this.dataset.deskripsi || '';
        document.getElementById('edit_status').value = this.dataset.status;
        document.getElementById('edit_id_pengacara').value = this.dataset.id_pengacara;
        document.getElementById('edit_deskripsi').value = this.dataset.deskripsi;
        document.getElementById('edit_tanggal_mulai').value = this.dataset.tanggal_mulai;
        document.getElementById('edit_tanggal_selesai').value = this.dataset.tanggal_selesai;
    });
});

/* DELETE PERKARA */
document.querySelectorAll('.deletePerkaraBtn').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        let id = this.dataset.id;
        let nomor = this.dataset.nomor;
        Swal.fire({
            title: "Hapus perkara?",
            html: "Perkara <b>" + nomor + "</b> akan dihapus!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, Hapus",
            cancelButtonText: "Batal"
        }).then((result) => {
            if(result.isConfirmed){
                window.location.href = "/admin/deleteperkara/" + id;
            }
        });
    });
});

/* SEARCH TABLE (LIVE FILTER) */
document.getElementById('searchInput').addEventListener('keyup', function () {
    let keyword = this.value.toLowerCase();
    let rows = document.querySelectorAll('#perkaraTable tbody tr');
    rows.forEach(row => {
        let rowText = row.innerText.toLowerCase();
        row.style.display = rowText.includes(keyword) ? "" : "none";
    });
});
</script>
