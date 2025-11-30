<!-- MAIN CONTENT -->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <!-- HEADER -->
            <div class="row mb-3">
                <div class="col-md-12 d-flex justify-content-between align-items-center">
                    <h2 class="title-1">Data Perkara</h2>
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
                                    <th>Aksi</th>
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
                                    <td>
                                    <!-- EDIT STATUS -->
                                    <button class="btn btn-warning btn-sm text-white btnEditPerkara"
                                            data-id="<?= esc($pkr['id']); ?>"
                                            data-status="<?= esc($pkr['status']); ?>"
                                            data-tanggal_mulai="<?= esc($pkr['tanggal_mulai']); ?>"
                                            data-tanggal_selesai="<?= esc($pkr['tanggal_selesai']); ?>"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalEditPerkara">
                                        <i class="bi bi-pencil-square"></i>
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
<!-- MODAL EDIT PERKARA -->
<!-- =============================================================== -->
<div class="modal fade" id="modalEditPerkara" tabindex="-1">
    <div class="modal-dialog modal-md">

        <form action="/pengacara/updateperkara" method="POST" class="modal-content">

            <!-- Header -->
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title">Edit Perkara</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Body -->
            <div class="modal-body">

                <input type="hidden" name="id" id="edit_id">
                <!-- Status -->
                <div class="mb-3">
                    <label>Status</label>
                    <select name="id_status" id="edit_status" class="form-select" required>
                        <?php foreach($statusPerkara as $s): ?>
                            <option value="<?= $s['id']; ?>"><?= esc($s['nama_status']); ?></option>
                        <?php endforeach; ?>
                    </select>
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
        document.getElementById('edit_status').value = this.dataset.status;
        document.getElementById('edit_tanggal_mulai').value = this.dataset.tanggal_mulai;
        document.getElementById('edit_tanggal_selesai').value = this.dataset.tanggal_selesai;
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

<script>
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
