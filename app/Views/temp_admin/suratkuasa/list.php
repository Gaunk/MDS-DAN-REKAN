<!-- MAIN CONTENT -->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <!-- HEADER -->
            <div class="row mb-3">
                <div class="col-md-12 d-flex justify-content-between align-items-center">
                    <h2 class="title-1">Daftar Surat Kuasa</h2>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahSuratModal">
                        Tambah Surat Kuasa
                    </button>
                </div>
            </div>

            <!-- TABLE -->
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered" id="suratTable">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama Klien</th>
                                <th>Nomor Perkara</th>
                                <th>Deskripsi</th>
                                <th>Tanggal Surat</th>
                                <th>Tanggal Input</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $no=1; foreach($suratKuasa as $s): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= esc($s['nama_klien']) ?></td>
                                <td><?= esc($s['nomor_perkara'] ?? '-') ?></td>
                                <td><?= esc($s['deskripsi']) ?></td>
                                <td><?= esc($s['tanggal']) ?></td>
                                <td><?= esc($s['created_at']) ?></td>
                                <td>
                                    <button class="btn btn-sm btn-warning"
                                            onclick='editSurat(<?= json_encode($s) ?>)'>
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger" 
                                            onclick="hapusSurat(<?= $s['id'] ?>)">
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

<!-- =============================================================== -->
<!-- MODAL TAMBAH SURAT KUASA -->
<!-- =============================================================== -->
<div class="modal fade" id="tambahSuratModal" tabindex="-1">
  <div class="modal-dialog">
    <form action="<?= base_url('admin/proses_suratkuasa') ?>" method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Surat Kuasa</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">

            <div class="mb-3">
                <label>Nama Klien</label>
                <select name="id_klien" class="form-select" required>
                    <option value="">-- Pilih Klien --</option>
                    <?php foreach($klien as $k): ?>
                        <option value="<?= $k['id'] ?>"><?= esc($k['nama']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label>Nomor Perkara</label>
                <select name="id_perkara" class="form-select" required>
                    <option value="">-- Pilih Perkara --</option>
                    <?php foreach($perkara as $p): ?>
                        <option value="<?= $p['id'] ?>"><?= esc($p['nomor_perkara']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control" required></textarea>
            </div>

            <div class="mb-3">
                <label>Tanggal Surat</label>
                <input type="date" name="tanggal" class="form-control" required>
            </div>

        </div>

        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button class="btn btn-primary">Simpan</button>
        </div>

      </div>
    </form>
  </div>
</div>

<!-- =============================================================== -->
<!-- MODAL UPDATE SURAT KUASA -->
<!-- =============================================================== -->
<div class="modal fade" id="updateSuratModal" tabindex="-1">
  <div class="modal-dialog">
    <form action="<?= base_url('admin/updatesuratkuasa') ?>" method="POST">
      <input type="hidden" name="id" id="update_id">

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Update Surat Kuasa</h5>
          <button class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">

            <div class="mb-3">
                <label>Nama Klien</label>
                <select name="id_klien" id="update_klien" class="form-select" required>
                    <?php foreach($klien as $k): ?>
                        <option value="<?= $k['id'] ?>"><?= esc($k['nama']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label>Nomor Perkara</label>
                <select name="id_perkara" id="update_perkara" class="form-select" required>
                    <?php foreach($perkara as $p): ?>
                        <option value="<?= $p['id'] ?>"><?= esc($p['nomor_perkara']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="deskripsi" id="update_deskripsi" class="form-control" required></textarea>
            </div>

            <div class="mb-3">
                <label>Tanggal Surat</label>
                <input type="date" name="tanggal" id="update_tanggal" class="form-control" required>
            </div>

        </div>

        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button class="btn btn-success">Update</button>
        </div>

      </div>
    </form>
  </div>
</div>

<!-- =============================================================== -->
<!-- SWEETALERT2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function editSurat(s) {
    document.getElementById('update_id').value = s.id;
    document.getElementById('update_klien').value = s.id_klien;
    document.getElementById('update_perkara').value = s.id_perkara;
    document.getElementById('update_deskripsi').value = s.deskripsi;
    document.getElementById('update_tanggal').value = s.tanggal;

    new bootstrap.Modal(document.getElementById('updateSuratModal')).show();
}

// Hapus dengan konfirmasi
function hapusSurat(id) {
    Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: "Data surat kuasa akan dihapus!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "<?= base_url('admin/deletesuratkuasa/') ?>" + id;
        }
    });
}

// SweetAlert2 Toast untuk flashdata
<?php if(session()->getFlashdata('success')): ?>
Swal.fire({
    toast: true,
    position: 'top-end',
    icon: 'success',
    title: '<?= session()->getFlashdata('success') ?>',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true
});
<?php endif; ?>

<?php if(session()->getFlashdata('error')): ?>
Swal.fire({
    toast: true,
    position: 'top-end',
    icon: 'error',
    title: '<?= session()->getFlashdata('error') ?>',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true
});
<?php endif; ?>
</script>
