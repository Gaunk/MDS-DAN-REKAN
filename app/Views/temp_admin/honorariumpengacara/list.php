<!-- MAIN CONTENT -->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <!-- HEADER -->
            <div class="row mb-3">
                <div class="col-md-12 d-flex justify-content-between align-items-center">
                    <h2 class="title-1">Honorarium Pengacara</h2>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahHonorModal">
                        Tambah Honorarium
                    </button>
                </div>
            </div>

            <!-- TABLE -->
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                    <table class="table table-borderless table-striped table-earning" id="honorTable">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama Pengacara</th>
                                <th>Jumlah Honor</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                                <th>Tanggal Input</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $no=1; foreach($honorarium as $h): ?>
                            <tr>
                                <td><?= $no++ ?></td>

                                <td><?= esc($h['nama_pengacara']) ?></td>

                                <td>Rp <?= number_format($h['jumlah'],0,',','.') ?></td>

                                <td>
                                    <?php if($h['status'] == "Lunas"): ?>
                                        <span class="badge bg-success">Lunas</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Belum Lunas</span>
                                    <?php endif; ?>
                                </td>

                                <td><?= esc($h['keterangan'] ?? '-') ?></td>

                                <td><?= esc($h['created_at']) ?></td>

                                <td>
                                    <button class="btn btn-sm btn-warning"
                                            onclick='editHonor(<?= json_encode($h) ?>)'>
                                        <i class="fa fa-edit"></i>
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
<!-- MODAL TAMBAH HONORARIUM -->
<!-- =============================================================== -->
<div class="modal fade" id="tambahHonorModal" tabindex="-1">
  <div class="modal-dialog">
    <form action="<?= base_url('admin/proses_honorariumpengacara') ?>" method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Honorarium</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">

            <div class="mb-3">
                <label>Nama Pengacara</label>
                <select name="id_pengacara" class="form-select" required>
                    <option value="">-- Pilih Pengacara --</option>
                    <?php foreach($pengacara as $pg): ?>
                        <option value="<?= $pg['id'] ?>"><?= esc($pg['nama']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label>Jumlah Honor</label>
                <input type="number" name="jumlah" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Status</label>
                <select name="status" class="form-select" required>
                    <option value="Belum Lunas">Belum Lunas</option>
                    <option value="Lunas">Lunas</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Keterangan</label>
                <textarea name="keterangan" class="form-control"></textarea>
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
<!-- MODAL UPDATE HONORARIUM -->
<!-- =============================================================== -->
<div class="modal fade" id="updateHonorModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form action="<?= base_url('admin/updatehonorariumpengacara') ?>" method="POST">
      <input type="hidden" name="id" id="update_id">

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Update Honorarium</h5>
          <!-- Tombol Close -->
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">

            <div class="mb-3">
                <label>Nama Pengacara</label>
                <select name="id_pengacara" id="update_pengacara" class="form-select" required>
                    <?php foreach($pengacara as $pg): ?>
                        <option value="<?= $pg['id'] ?>">
                            <?= esc($pg['nama']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label>Jumlah Honor</label>
                <input type="number" name="jumlah" id="update_jumlah" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Status</label>
                <select name="status" id="update_status" class="form-select" required>
                    <option value="Belum Lunas">Belum Lunas</option>
                    <option value="Lunas">Lunas</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Keterangan</label>
                <textarea name="keterangan" id="update_keterangan" class="form-control"></textarea>
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
<!-- JS EDIT HONOR -->
<!-- =============================================================== -->
<script>
function editHonor(h) {
    document.getElementById('update_id').value = h.id;
    document.getElementById('update_pengacara').value = h.id_pengacara;
    document.getElementById('update_jumlah').value = h.jumlah;
    document.getElementById('update_status').value = h.status;
    document.getElementById('update_keterangan').value = h.keterangan;

    new bootstrap.Modal(document.getElementById('updateHonorModal')).show();
}
</script>
