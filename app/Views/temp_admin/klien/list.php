<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <!-- HEADER -->
            <div class="row mb-3">
                <div class="col-md-12 d-flex justify-content-between align-items-center">
                    <h2 class="title-1">Data Klien</h2>

                    <button class="au-btn au-btn-icon au-btn--blue" 
                            data-bs-toggle="modal" 
                            data-bs-target="#modalTambahKlien">
                        <i class="zmdi zmdi-plus"></i>Tambah Klien
                    </button>
                </div>
            </div>

            <!-- SEARCH FIELD -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <input type="text" id="searchInput" class="form-control" placeholder="Cari klien... (nama, telepon, email)">
                </div>
            </div>

            <!-- TABLE -->
            <div class="row">
                <div class="col-lg-12">

                    <div class="table-responsive mt-3">
                        <table class="table table-borderless table-striped table-earning" id="klienTable">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>No.Telepon</th>
                                    <th>Email</th>
                                    <th>Catatan</th>
                                    <th>Pengacara</th>
                                    <th class="text-end">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach($klien as $kli): ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= esc($kli['nama']); ?></td>
                                    <td><?= esc($kli['alamat']); ?></td>
                                    <td><?= esc($kli['telepon']); ?></td>
                                    <td><?= esc($kli['email']); ?></td>
                                    <td><?= esc($kli['catatan']); ?></td>
                                    <td><?= esc($kli['nama_pengacara']); ?></td>

                                    <td class="text-end">
                                        <!-- EDIT -->
                                        <button class="btn btn-warning btn-sm text-white btnEditKlien"
                                            data-id="<?= $kli['id']; ?>"
                                            data-nama="<?= esc($kli['nama']); ?>"
                                            data-alamat="<?= esc($kli['alamat']); ?>"
                                            data-telepon="<?= esc($kli['telepon']); ?>"
                                            data-email="<?= esc($kli['email']); ?>"
                                            data-catatan="<?= esc($kli['catatan']); ?>"
                                            data-id_pengacara="<?= $kli['id_pengacara']; ?>"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalEditKlien">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>

                                        <!-- DELETE -->
                                        <button class="btn btn-danger btn-sm deleteKlienBtn"
                                            data-id="<?= $kli['id']; ?>"
                                            data-nama="<?= esc($kli['nama']); ?>">
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
<!-- MODAL TAMBAH KLIEN -->
<!-- =============================================================== -->
<div class="modal fade" id="modalTambahKlien" tabindex="-1">
    <div class="modal-dialog modal-md">

        <form action="/admin/saveklien" method="POST" class="modal-content">

            <!-- Header -->
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Tambah Klien</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Body -->
            <div class="modal-body">

                <div class="mb-3">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Alamat</label>
                    <input type="text" name="alamat" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Telepon</label>
                    <input type="text" name="telepon" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Catatan</label>
                    <textarea name="catatan" class="form-control"></textarea>
                </div>

                <div class="mb-3">
                    <label>Pengacara</label>
                    <select name="id_pengacara" class="form-select">
                        <option value="">-- Pilih Pengacara --</option>
                        <?php foreach($pengacara as $p): ?>
                            <option value="<?= $p['id']; ?>">
                                <?= esc($p['nama']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

            </div>

            <!-- Footer -->
            <div class="modal-footer">
                <button class="btn btn-primary">Simpan</button>
            </div>

        </form>

    </div>
</div>



<!-- =============================================================== -->
<!-- MODAL EDIT KLIEN -->
<!-- =============================================================== -->
<div class="modal fade" id="modalEditKlien" tabindex="-1" aria-labelledby="editKlienLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <form action="/admin/updateklien" method="POST" class="modal-content">

            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title" id="editKlienLabel">Edit Klien</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <input type="hidden" name="id" id="edit_id">

                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="nama" id="edit_nama" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <input type="text" name="alamat" id="edit_alamat" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Telepon</label>
                    <input type="number" name="telepon" id="edit_telepon" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" id="edit_email" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Catatan</label>
                    <textarea name="catatan" id="edit_catatan" class="form-control" rows="3"></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pengacara</label>
                    <select name="id_pengacara" id="edit_id_pengacara" class="form-select">
                        <option value="">-- Pilih Pengacara --</option>
                        <?php foreach ($pengacara as $p): ?>
                            <option value="<?= $p['id']; ?>"><?= esc($p['nama']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-warning">Perbarui</button>
            </div>

        </form>
    </div>
</div>




<!-- =============================================================== -->
<!-- JAVASCRIPT -->
<!-- =============================================================== -->

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

/* ========================================================= */
/* FILL EDIT MODAL                                           */
/* ========================================================= */
document.querySelectorAll('.btnEditKlien').forEach(btn => {
    btn.addEventListener('click', function () {
        document.getElementById('edit_id').value = this.dataset.id;
        document.getElementById('edit_nama').value = this.dataset.nama;
        document.getElementById('edit_alamat').value = this.dataset.alamat;
        document.getElementById('edit_telepon').value = this.dataset.telepon;
        document.getElementById('edit_email').value = this.dataset.email;
        document.getElementById('edit_catatan').value = this.dataset.catatan;
        document.getElementById('edit_id_pengacara').value = this.dataset.id_pengacara; // baru
    });
});


/* ========================================================= */
/* DELETE KLIEN                                              */
/* ========================================================= */
document.querySelectorAll('.deleteKlienBtn').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();

        let id = this.dataset.id;
        let nama = this.dataset.nama;

        Swal.fire({
            title: "Hapus klien?",
            html: "Klien <b>" + nama + "</b> akan dihapus!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, Hapus",
            cancelButtonText: "Batal"
        }).then((result) => {
            if(result.isConfirmed){
                window.location.href = "/admin/deleteklien/" + id;
            }
        });
    });
});


/* ========================================================= */
/* SEARCH TABLE (LIVE FILTER)                                */
/* ========================================================= */
document.getElementById('searchInput').addEventListener('keyup', function () {

    let keyword = this.value.toLowerCase();
    let rows = document.querySelectorAll('#klienTable tbody tr');

    rows.forEach(row => {

        let rowText = row.innerText.toLowerCase();

        if(rowText.includes(keyword)){
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });
});
</script>
