<!-- MAIN CONTENT -->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <!-- HEADER -->
            <div class="row mb-3">
                <div class="col-md-12 d-flex justify-content-between align-items-center">
                    <h2 class="title-1">Daftar Dokumen Perkara</h2>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahDokumenModal">
                        Tambah Dokumen
                    </button>
                </div>
            </div>

            <!-- TABLE -->
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered" id="dokumenTable">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Nomor Perkara</th>
                                <th>Nama File</th>
                                <th>Kategori</th>
                                <th>Dokumen</th>
                                <th>Diunggah Oleh</th>
                                <th>Diunggah Pada</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $no=1; foreach($dokumen as $d): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= esc($d['nomor_perkara'] ?? '-') ?></td>
                                <td><?= esc($d['nama_file']) ?></td>
                                <td><?= esc($d['kategori']) ?></td>
                                <td>
                                <a href="<?= base_url($d['path_file']) ?>" download class="btn btn-sm btn-primary">
                                    <i class="fa fa-download"></i> Download
                                </a>

                                </td>
                                <td><?= esc($d['diunggah_oleh_username']) ?></td>
                                <td><?= esc($d['diunggah_pada']) ?></td>
                                <td>
                                    <button class="btn btn-sm btn-warning"
                                            onclick='editDokumen(<?= json_encode($d) ?>)'>
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger" 
                                            onclick="hapusDokumen(<?= $d['id'] ?>)">
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
<!-- MODAL TAMBAH DOKUMEN -->
<!-- =============================================================== -->
<div class="modal fade" id="tambahDokumenModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form action="<?= base_url('admin/proses_dokumenperkara') ?>" method="POST" enctype="multipart/form-data">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title">Tambah Dokumen Perkara</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">

          <!-- Nomor Perkara -->
          <div class="mb-3">
            <label for="id_perkara" class="form-label">Nomor Perkara</label>
            <select name="id_perkara" id="id_perkara" class="form-select" required>
              <option value="">-- Pilih Perkara --</option>
              <?php foreach($perkara as $p): ?>
                <option value="<?= esc($p['id']) ?>"><?= esc($p['nomor_perkara']) ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <!-- Nama File (Tampilan) -->
          <div class="mb-3">
            <label for="nama_file" class="form-label">Nama File (Tampilan)</label>
            <input type="text" name="nama_file" id="nama_file" class="form-control" placeholder="Masukkan nama file" required>
          </div>

          <!-- Upload File -->
          <div class="mb-3">
            <label for="file" class="form-label">Upload File (PDF/Word)</label>
            <input type="file" name="file" id="file" class="form-control" accept=".pdf,.doc,.docx" required>
          </div>

          <!-- Kategori -->
          <div class="mb-3">
            <label for="kategori" class="form-label">Kategori</label>
            <select name="kategori" id="kategori" class="form-select" required>
              <option value="">-- Pilih Kategori --</option>
              <option value="gugatan">Gugatan</option>
              <option value="jawaban">Jawaban</option>
              <option value="pembuktian">Pembuktian</option>
              <option value="surat_kuasa">Surat Kuasa</option>
              <option value="pjh">PJH</option>
              <option value="lainnya">Lainnya</option>
            </select>
          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>

      </div>
    </form>
  </div>
</div>
<!-- =============================================================== -->
<!-- MODAL UPDATE DOKUMEN -->
<!-- =============================================================== -->
<div class="modal fade" id="updateDokumenModal" tabindex="-1">
  <div class="modal-dialog">
    <form action="<?= base_url('admin/updatedokumenperkara') ?>" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="id" id="update_id">

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Update Dokumen Perkara</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">

            <!-- Nomor Perkara -->
            <div class="mb-3">
                <label>Nomor Perkara</label>
                <select name="id_perkara" id="update_perkara" class="form-select" required>
                    <?php foreach($perkara as $p): ?>
                        <option value="<?= esc($p['id']) ?>"><?= esc($p['nomor_perkara']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Nama File -->
            <div class="mb-3">
                <label>Nama File</label>
                <input type="text" name="nama_file" id="update_nama_file" class="form-control" required>
            </div>

            <!-- Upload File -->
            <div class="mb-3">
                <label>Upload File (PDF/Word)</label>
                <input type="file" name="file" id="update_path_file" class="form-control" accept=".pdf,.doc,.docx">
            </div>

            <!-- Kategori -->
            <div class="mb-3">
                <label>Kategori</label>
                <select name="kategori" id="update_kategori" class="form-select" required>
                    <option value="">-- Pilih Kategori --</option>
                    <option value="gugatan">Gugatan</option>
                    <option value="jawaban">Jawaban</option>
                    <option value="pembuktian">Pembuktian</option>
                    <option value="surat_kuasa">Surat Kuasa</option>
                    <option value="pjh">PJH</option>
                    <option value="lainnya">Lainnya</option>
                </select>
            </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-success">Update</button>
        </div>

      </div>
    </form>
  </div>
</div>


<!-- =============================================================== -->
<!-- SWEETALERT2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function editDokumen(d) {
    document.getElementById('update_id').value = d.id;
    document.getElementById('update_perkara').value = d.id_perkara;
    document.getElementById('update_nama_file').value = d.nama_file;
    document.getElementById('update_kategori').value = d.kategori;

    new bootstrap.Modal(document.getElementById('updateDokumenModal')).show();
}

// Hapus dengan konfirmasi
function hapusDokumen(id) {
    Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: "Data dokumen perkara akan dihapus!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "<?= base_url('admin/deletedokumenperkara/') ?>" + id;
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
