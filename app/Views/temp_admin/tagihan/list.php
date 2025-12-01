<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <!-- HEADER -->
            <div class="row mb-3">
                <div class="col-md-12 d-flex justify-content-between align-items-center">
                    <h2 class="title-1">Daftar Tagihan PPJH</h2>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahTagihanModal">Tambah Tagihan</button>
                </div>
            </div>

            <!-- SEARCH FIELD -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <input type="text" id="searchInput" class="form-control" placeholder="Cari tagihan... (klien, nomor, status)">
                </div>
            </div>

            <!-- TABLE -->
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered" id="tagihanTable">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Klien</th>
                                <th>Perkara</th>
                                <th>Jumlah</th>
                                <th>Deskripsi</th>
                                <th>Status</th>
                                <th>Tanggal Terbit</th>
                                <th>Tanggal Jatuh Tempo</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach($tagihan as $t): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= esc($t['nama_klien']) ?></td>
                                <td><?= esc($t['nomor_perkara'] ?? '-') ?></td>
                                <td>Rp <?= number_format($t['jumlah'], 0, ',', '.') ?></td>
                                <td><?= esc($t['deskripsi']) ?></td>
                                <td>
                                    <?php if($t['status'] == 'Lunas'): ?>
                                        <span class="badge bg-success">Lunas</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Belum Lunas</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= esc($t['tanggal_terbit']) ?></td>
                                <td><?= esc($t['tanggal_jatuh_tempo']) ?></td>
                                <td>
                                    <button class="btn btn-warning btn-sm" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#updateTagihanModal"
                                        data-id="<?= $t['id'] ?>"
                                        data-id-klien="<?= $t['id_klien'] ?>"
                                        data-id-perkara="<?= $t['id_perkara'] ?>"
                                        data-jumlah="<?= $t['jumlah'] ?>"
                                        data-deskripsi="<?= esc($t['deskripsi']) ?>"
                                        data-status="<?= $t['status'] ?>"
                                        data-tanggal-terbit="<?= $t['tanggal_terbit'] ?>"
                                        data-tanggal-jatuh-tempo="<?= $t['tanggal_jatuh_tempo'] ?>">
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

<!-- ================= MODAL TAMBAH TAGIHAN ================= -->
<div class="modal fade" id="tambahTagihanModal" tabindex="-1" aria-labelledby="tambahTagihanLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="<?= base_url('admin/tambahtagihan') ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahTagihanLabel">Tambah Tagihan PPJH</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="id_klien" class="form-label">Klien</label>
                            <select class="form-control" name="id_klien" id="id_klien" required>
                                <option value="">Pilih Klien</option>
                                <?php foreach($klien as $k): ?>
                                    <option value="<?= $k['id'] ?>"><?= esc($k['nama']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="id_perkara" class="form-label">Perkara</label>
                            <select class="form-control" name="id_perkara" id="id_perkara" required>
                                <option value="">Pilih Perkara</option>
                                <?php foreach($perkara as $p): ?>
                                    <option value="<?= $p['id'] ?>"><?= esc($p['nomor_perkara']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="jumlah" class="form-label">Jumlah</label>
                            <input type="number" class="form-control" name="jumlah" id="jumlah" required>
                        </div>
                        <div class="col-md-6">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-control" name="status" id="status">
                                <option value="Belum Lunas">Belum Lunas</option>
                                <option value="Lunas">Lunas</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" id="deskripsi" rows="2"></textarea>
                        </div>

                        <div class="col-md-6">
                            <label for="tanggal_terbit" class="form-label">Tanggal Terbit</label>
                            <input type="date" class="form-control" name="tanggal_terbit" id="tanggal_terbit" required>
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal_jatuh_tempo" class="form-label">Tanggal Jatuh Tempo</label>
                            <input type="date" class="form-control" name="tanggal_jatuh_tempo" id="tanggal_jatuh_tempo" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer mt-3">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah Tagihan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- ================= MODAL UPDATE TAGIHAN ================= -->
<div class="modal fade" id="updateTagihanModal" tabindex="-1" aria-labelledby="updateTagihanLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="<?= base_url('admin/updatetagihan') ?>" method="post">
                <input type="hidden" name="id" id="updateId">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateTagihanLabel">Update Tagihan PPJH</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="updateIdKlien" class="form-label">Klien</label>
                            <select class="form-control" name="id_klien" id="updateIdKlien" required>
                                <?php foreach($klien as $k): ?>
                                    <option value="<?= $k['id'] ?>"><?= esc($k['nama']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="updateIdPerkara" class="form-label">Perkara</label>
                            <select class="form-control" name="id_perkara" id="updateIdPerkara" required>
                                <?php foreach($perkara as $p): ?>
                                    <option value="<?= $p['id'] ?>"><?= esc($p['nomor_perkara']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="updateJumlah" class="form-label">Jumlah</label>
                            <input type="number" class="form-control" name="jumlah" id="updateJumlah" required>
                        </div>
                        <div class="col-md-6">
                            <label for="updateStatus" class="form-label">Status</label>
                            <select class="form-control" name="status" id="updateStatus">
                                <option value="Belum Lunas">Belum Lunas</option>
                                <option value="Lunas">Lunas</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label for="updateDeskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" id="updateDeskripsi" rows="2"></textarea>
                        </div>

                        <div class="col-md-6">
                            <label for="updateTanggalTerbit" class="form-label">Tanggal Terbit</label>
                            <input type="date" class="form-control" name="tanggal_terbit" id="updateTanggalTerbit" required>
                        </div>
                        <div class="col-md-6">
                            <label for="updateTanggalJatuhTempo" class="form-label">Tanggal Jatuh Tempo</label>
                            <input type="date" class="form-control" name="tanggal_jatuh_tempo" id="updateTanggalJatuhTempo" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer mt-3">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning">Update Tagihan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- =============================================================== -->
<!-- JAVASCRIPT SEARCH TABLE, MODAL, SWEETALERT -->
<!-- =============================================================== -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
// Live search
document.getElementById('searchInput').addEventListener('keyup', function () {
    let keyword = this.value.toLowerCase();
    let rows = document.querySelectorAll('#tagihanTable tbody tr');
    rows.forEach(row => {
        row.style.display = row.innerText.toLowerCase().includes(keyword) ? "" : "none";
    });
});

// Isi modal update saat tombol diklik
var updateModal = document.getElementById('updateTagihanModal')
updateModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget
    document.getElementById('updateId').value = button.getAttribute('data-id')
    document.getElementById('updateIdKlien').value = button.getAttribute('data-id-klien')
    document.getElementById('updateIdPerkara').value = button.getAttribute('data-id-perkara')
    document.getElementById('updateJumlah').value = button.getAttribute('data-jumlah')
    document.getElementById('updateDeskripsi').value = button.getAttribute('data-deskripsi')
    document.getElementById('updateStatus').value = button.getAttribute('status')
    document.getElementById('updateTanggalTerbit').value = button.getAttribute('data-tanggal-terbit')
    document.getElementById('updateTanggalJatuhTempo').value = button.getAttribute('data-tanggal-jatuh-tempo')
});

// SweetAlert notifikasi
<?php if(session()->getFlashdata('success')): ?>
Swal.fire({ icon: 'success', title: 'Berhasil!', text: '<?= session()->getFlashdata('success') ?>' });
<?php elseif(session()->getFlashdata('error')): ?>
Swal.fire({ icon: 'error', title: 'Gagal!', text: '<?= session()->getFlashdata('error') ?>' });
<?php endif; ?>
</script>
