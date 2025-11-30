<!-- MAIN CONTENT -->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <!-- HEADER -->
            <div class="row mb-3">
                <div class="col-md-12 d-flex justify-content-between align-items-center">
                    <h2 class="title-1">Jadwal Pertemuan</h2>
                    <button class="au-btn au-btn-icon au-btn--blue" 
                            data-bs-toggle="modal" 
                            data-bs-target="#modalTambahPertemuan">
                        <i class="zmdi zmdi-plus"></i>Tambah Pertemuan
                    </button>
                </div>
            </div>

            <!-- SEARCH FIELD -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <input type="text" id="searchInput" class="form-control" placeholder="Cari pertemuan... (klien, tanggal, pengacara)">
                </div>
            </div>

            <!-- TABLE -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive mt-3">
                        <table class="table table-borderless table-striped table-earning" id="pertemuanTable">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th>No</th>
                                    <th>Klien</th>
                                    <th>Pengacara</th>
                                    <th>Tanggal</th>
                                    <th>Waktu</th>
                                    <th>Lokasi</th>
                                    <th>Catatan</th>
                                    <th class="text-end">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach($pertemuan as $p): ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= esc($p['nama_klien']); ?></td>
                                    <td><?= esc($p['nama_pengacara']); ?></td>
                                    <td><?= esc($p['tanggal_waktu']); ?></td>
                                    <td><?= esc($p['waktu']); ?></td>
                                    <td><?= esc($p['lokasi']); ?></td>
                                    <td><?= esc($p['catatan']); ?></td>
                                    <td class="text-end">
                                        <!-- EDIT -->
                                        <button class="btn btn-warning btn-sm text-white btnEditPertemuan"
                                            data-id="<?= $p['id']; ?>"
                                            data-klien="<?= $p['id_klien']; ?>"
                                            data-pengacara="<?= $p['id_pengguna']; ?>"
                                            data-tanggal_waktu="<?= $p['tanggal_waktu']; ?>"
                                            data-waktu="<?= $p['waktu']; ?>"
                                            data-lokasi="<?= esc($p['lokasi']); ?>"
                                            data-catatan="<?= esc($p['catatan']); ?>"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalEditPertemuan">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>

                                        <!-- DELETE -->
                                        <button class="btn btn-danger btn-sm deletePertemuanBtn"
                                            data-id="<?= $p['id']; ?>"
                                            data-klien="<?= esc($p['nama_klien']); ?>">
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

<!-- Modal Tambah Pertemuan -->
<div class="modal fade" id="modalTambahPertemuan" tabindex="-1" aria-labelledby="modalTambahPertemuanLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <form action="<?= base_url('admin/savepertemuan') ?>" method="POST">
        <?= csrf_field() ?>

        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="modalTambahPertemuanLabel">Tambah Pertemuan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">

          <div class="mb-3">
            <label for="id_klien" class="form-label">Klien</label>
            <select name="id_klien" id="id_klien" class="form-select" required>
              <option value="">-- Pilih Klien --</option>
              <?php foreach($klien as $k): ?>
                <option value="<?= esc($k['id']) ?>"><?= esc($k['nama']) ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="mb-3">
            <label for="id_pengguna" class="form-label">Pengacara</label>
            <select name="id_pengguna" id="id_pengguna" class="form-select" required>
              <option value="">-- Pilih Pengacara --</option>
              <?php foreach($pengacara as $p): ?>
                <option value="<?= esc($p['id']) ?>"><?= esc($p['nama']) ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="mb-3">
            <label for="tanggal_waktu" class="form-label">Tanggal</label>
            <input type="date" name="tanggal_waktu" id="tanggal_waktu" class="form-control" value="<?= old('tanggal_waktu') ?>" required>
          </div>

          <div class="mb-3">
            <label for="waktu" class="form-label">Waktu</label>
            <input type="time" name="waktu" id="waktu" class="form-control" value="<?= old('waktu') ?>" required>
          </div>

          <div class="mb-3">
            <label for="lokasi" class="form-label">Lokasi</label>
            <input type="text" name="lokasi" id="lokasi" class="form-control" value="<?= old('lokasi') ?>" required>
          </div>

          <div class="mb-3">
            <label for="catatan" class="form-label">Catatan</label>
            <textarea name="catatan" id="catatan" class="form-control" rows="3"><?= old('catatan') ?></textarea>
          </div>

        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Simpan</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
        
      </form>
    </div>
  </div>
</div>
<!-- MODAL EDIT PERTEMUAN -->
<div class="modal fade" id="modalEditPertemuan" tabindex="-1">
    <div class="modal-dialog modal-md">
        <form action="/admin/updatepertemuan" method="POST" class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title">Edit Pertemuan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">

                <input type="hidden" name="id" id="edit_id">

                <div class="mb-3">
                    <label>Klien</label>
                    <select name="id_klien" id="edit_klien" class="form-select" required>
                        <option value="">-- Pilih Klien --</option>
                        <?php foreach($klien as $k): ?>
                            <option value="<?= $k['id']; ?>"><?= esc($k['nama']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Pengacara</label>
                    <select name="id_pengguna" id="edit_pengguna" class="form-select" required>
                        <option value="">-- Pilih Pengacara --</option>
                        <?php foreach($pengacara as $p): ?>
                            <option value="<?= $p['id']; ?>"><?= esc($p['nama']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal_waktu" id="edit_tanggal_waktu" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Waktu</label>
                    <input type="time" name="waktu" id="edit_waktu" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Lokasi</label>
                    <input type="text" name="lokasi" id="edit_lokasi" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Catatan</label>
                    <textarea name="catatan" id="edit_catatan" class="form-control" rows="3"></textarea>
                </div>

            </div>
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
// Buat instance Toast sekali saja
  const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',           // posisi di kanan atas
    showConfirmButton: false,
    timer: 2500,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  });

  // Tampilkan toast jika ada flashdata success
  <?php if(session()->getFlashdata('success')): ?>
    Toast.fire({
      icon: 'success',
      title: '<?= session()->getFlashdata('success') ?>'
    });
  <?php endif; ?>

  // Toast untuk error
  <?php if(session()->getFlashdata('error')): ?>
    Toast.fire({
      icon: 'error',
      title: '<?= session()->getFlashdata('error') ?>'
    });
  <?php endif; ?>
/* FILL EDIT MODAL */
document.querySelectorAll('.btnEditPertemuan').forEach(btn => {
    btn.addEventListener('click', function () {
        document.getElementById('edit_id').value = this.dataset.id;
        document.getElementById('edit_klien').value = this.dataset.klien;
        document.getElementById('edit_pengguna').value = this.dataset.pengacara;
        document.getElementById('edit_tanggal_waktu').value = this.dataset.tanggal_waktu;
        document.getElementById('edit_waktu').value = this.dataset.waktu;
        document.getElementById('edit_lokasi').value = this.dataset.lokasi;
        document.getElementById('edit_catatan').value = this.dataset.catatan;
    });
});

/* DELETE PERTEMUAN */
document.querySelectorAll('.deletePertemuanBtn').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        let id = this.dataset.id;
        let klien = this.dataset.klien;

        Swal.fire({
            title: "Hapus pertemuan?",
            html: "Pertemuan dengan klien <b>" + klien + "</b> akan dihapus!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, Hapus",
            cancelButtonText: "Batal"
        }).then((result) => {
            if(result.isConfirmed){
                window.location.href = "/admin/deletepertemuan/" + id;
            }
        });
    });
});

/* SEARCH TABLE */
document.getElementById('searchInput').addEventListener('keyup', function () {
    let keyword = this.value.toLowerCase();
    let rows = document.querySelectorAll('#pertemuanTable tbody tr');

    rows.forEach(row => {
        let rowText = row.innerText.toLowerCase();
        row.style.display = rowText.includes(keyword) ? "" : "none";
    });
});
</script>
