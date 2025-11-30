<!-- MAIN CONTENT -->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <!-- HEADER -->
            <div class="row mb-3">
                <div class="col-md-12 d-flex justify-content-between align-items-center">
                    <h2 class="title-1">Daftar Pembayaran</h2>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahPembayaranModal">
                        Tambah Pembayaran
                    </button>
                </div>
            </div>

            <!-- SEARCH FIELD -->
            <div class="row mb-3">
                <div class="col-md-4 d-flex">
                    <input type="text" id="searchInput" class="form-control me-2" placeholder="Cari pembayaran... (klien, nomor tagihan, nomor perkara)">
                    <button id="btnSearch" class="btn btn-info">Cari</button>
                </div>
            </div>

            <!-- TABLE -->
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered" id="pembayaranTable">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Klien</th>
                                <th>Nomor Perkara</th>
                                <th>Jumlah Bayar</th>
                                <th>Metode Pembayaran</th>
                                <th>Tanggal Bayar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach($pembayaran as $p): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= esc($p['nama_klien']) ?></td>
                                <td><?= esc($p['nomor_perkara'] ?? '-') ?></td>
                                <td>
                                    <?= isset($p['jumlah']) 
                                        ? 'Rp ' . number_format($p['jumlah'], 0, ',', '.') 
                                        : '-' 
                                    ?>
                                </td>

                                <td>
                                    <?php if($p['metode_pembayaran'] == 'Tunai'): ?>
                                        <span class="badge bg-success"><?= esc($p['metode_pembayaran']) ?></span>
                                    <?php elseif($p['metode_pembayaran'] == 'Transfer'): ?>
                                        <span class="badge bg-primary"><?= esc($p['metode_pembayaran']) ?></span>
                                    <?php elseif($p['metode_pembayaran'] == 'Kartu Kredit'): ?>
                                        <span class="badge bg-warning text-dark"><?= esc($p['metode_pembayaran']) ?></span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary"><?= esc($p['metode_pembayaran']) ?></span>
                                    <?php endif; ?>
                                </td>
                                <td><?= esc($p['tanggal_pembayaran']) ?></td>
                                <td class="d-flex gap-1">
                                    <button class="btn btn-sm btn-warning" 
                                            onclick='editPembayaran(<?= json_encode($p) ?>)'>
                                        <i class="fa fa-edit"></i>
                                    </button>


                                    <!-- Tombol Print / Preview Modal -->
                                    <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalKwitansi<?= $p['id'] ?>">
                                        <i class="bi bi-printer"></i> <!-- Bootstrap Icons -->
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
<!-- MODAL TAMBAH PEMBAYARAN -->
<!-- =============================================================== -->
<div class="modal fade" id="tambahPembayaranModal" tabindex="-1" aria-labelledby="tambahPembayaranLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="formTambahPembayaran" action="<?= base_url('admin/tambahpembayaran') ?>" method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tambahPembayaranLabel">Tambah Pembayaran</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="id_tagihan" class="form-label">Tagihan</label>
                <select name="id_tagihan" id="id_tagihan" class="form-select" required>
                    <option value="">-- Pilih Tagihan --</option>
                    <?php foreach($tagihan as $t): ?>
                        <option value="<?= $t['id'] ?>">
                            <?= esc($t['id_perkara']) ?> - <?= esc($t['nama']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="jumlah" class="form-label">Jumlah Bayar</label>
                <input type="number" name="jumlah" id="jumlah" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
                <select name="metode_pembayaran" id="metode_pembayaran" class="form-select" required>
                    <option value="">-- Pilih Metode --</option>
                    <option value="Tunai">Tunai</option>
                    <option value="Transfer">Transfer</option>
                    <option value="Kartu Kredit">Kartu Kredit</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="tanggal_pembayaran" class="form-label">Tanggal Bayar</label>
                <input type="date" name="tanggal_pembayaran" id="tanggal_pembayaran" class="form-control" required>
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
<!-- MODAL UPDATE PEMBAYARAN -->
<!-- =============================================================== -->
<div class="modal fade" id="updatePembayaranModal" tabindex="-1" aria-labelledby="updatePembayaranLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="formUpdatePembayaran" action="<?= base_url('admin/updatepembayaran') ?>" method="POST">
      <input type="hidden" name="id" id="update_id">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="updatePembayaranLabel">Update Pembayaran</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="update_id_tagihan" class="form-label">Tagihan</label>
                <select name="id_tagihan" id="update_id_tagihan" class="form-select" required>
                    <option value="">-- Pilih Tagihan --</option>
                    <?php foreach($tagihan as $t): ?>
                        <option value="<?= $t['id'] ?>">
                            <?= esc($t['id_perkara']) ?> - <?= esc($t['nama']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="update_jumlah" class="form-label">Jumlah Bayar</label>
                <input type="number" name="jumlah" id="update_jumlah" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="update_metode_pembayaran" class="form-label">Metode Pembayaran</label>
                <select name="metode_pembayaran" id="update_metode_pembayaran" class="form-select" required>
                    <option value="">-- Pilih Metode --</option>
                    <option value="Tunai">Tunai</option>
                    <option value="Transfer">Transfer</option>
                    <option value="Kartu Kredit">Kartu Kredit</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="update_tanggal_pembayaran" class="form-label">Tanggal Bayar</label>
                <input type="date" name="tanggal_pembayaran" id="update_tanggal_pembayaran" class="form-control" required>
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
<?php foreach($pembayaran as $p): ?>
<div class="modal fade" id="modalKwitansi<?= $p['id'] ?>" tabindex="-1" aria-labelledby="modalLabel<?= $p['id'] ?>" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel<?= $p['id'] ?>">Kwitansi Pembayaran #<?= esc($p['id']) ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body kwitansi-modal" 
           style="
              position: relative;
              background-image: url('<?= base_url('temp_admin/images/kw1.png') ?>');
              background-size: contain;
              background-repeat: no-repeat;
              background-position: center;
              min-height: 500px;
              padding: 0;
              font-size: 16px;
           ">
        
        <div style="position: absolute; top: 150px; left: 290px; font-weight: bold; color: #262460;">
            <?= esc($p['nomor_perkara'] ?? '-') ?>
        </div>

        <div style="position: absolute; top: 190px; left: 290px; font-weight: bold; color: #262460;">
            <?= esc($p['nama_klien']) ?>
        </div>

        <div style="position: absolute; top: 235px; left: 290px; font-weight: bold; color: #262460;">
            Rp. <?= 'Rp. ' . number_format($t['jumlah'],0,',','.') ?>

        </div>


        <div style="position: absolute; top: 285px; left: 290px; font-weight: bold; color: #262460;">
            <?= esc($p['deskripsi']) ?>
        </div>

        <div style="position: absolute; top: 340px; left: 450px; font-weight: bold; color: #262460;">
            <?= esc($p['tanggal_pembayaran']) ?>
        </div>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button class="btn btn-primary print-btn" data-id="<?= $p['id'] ?>">
            <i class="bi bi-printer"></i> Print
        </button>
      </div>

    </div>
  </div>
</div>
<?php endforeach; ?>



<!-- =============================================================== -->
<!-- SWEETALERT2 -->
<!-- =============================================================== -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {

    document.querySelectorAll(".print-btn").forEach(function(btn) {

        btn.addEventListener("click", function() {

            // Cari modal body terdekat (yang asli)
            let modalBody = this.closest(".modal-content").querySelector(".modal-body");

            // Ambil isi HTML modal
            let content = modalBody.innerHTML;

            // Buka window print
            let printWindow = window.open("", "", "width=900,height=600");

            printWindow.document.write(`
                <html>
                <head>
                    <title>Cetak Kwitansi</title>

                    <style>
                        @page { margin: 0; }

                        body {
                            margin: 0;
                            padding: 0;
                            -webkit-print-color-adjust: exact !important;
                            print-color-adjust: exact !important;
                            font-family: Arial;
                        }

                        /* Ukuran harus SAMA dengan modal (500px tinggi) */
                        .kwitansi-wrapper {
                            position: relative;
                            width: 100%;
                            height: 500px;

                            background-image: url('<?= base_url('temp_admin/images/kw1.png') ?>');
                            background-size: contain;
                            background-repeat: no-repeat;
                            background-position: center;
                        }

                        /* Semua posisi absolute tetap */
                        .kwitansi-wrapper * {
                            position: absolute;
                            color: #262460;
                            font-weight: bold;
                        }
                    </style>
                </head>

                <body>
                    <div class="kwitansi-wrapper">
                        ${content}
                    </div>

                    <script>
                        window.onload = function() {
                            window.print();
                            setTimeout(() => window.close(), 500);
                        };
                    <\/script>
                </body>
                </html>
            `);

            printWindow.document.close();
        });
    });
});
</script>

<script>
document.getElementById('btnSearch').addEventListener('click', function() {
    let keyword = document.getElementById('searchInput').value.toLowerCase();
    let rows = document.querySelectorAll('#pembayaranTable tbody tr');
    let results = [];

    rows.forEach(row => {
        let rowText = row.innerText.toLowerCase();
        if(rowText.includes(keyword)) {
            results.push(row.innerHTML);
        }
    });

    if(results.length === 0) {
        Swal.fire({
            icon: 'info',
            title: 'Tidak ditemukan',
            text: 'Data pembayaran dengan kata kunci "' + keyword + '" tidak ditemukan.',
        });
    } else {
        let tableHTML = '<table class="table table-bordered">';
        tableHTML += '<thead class="table-dark"><tr>';
        tableHTML += '<th>No</th><th>Klien</th><th>Nomor Perkara</th><th>Nomor Tagihan</th>';
        tableHTML += '<th>Jumlah Tagihan</th><th>Jumlah Bayar</th><th>Metode Pembayaran</th><th>Tanggal Bayar</th></tr></thead><tbody>';

        results.forEach((rowContent, index) => {
            tableHTML += '<tr><td>' + (index+1) + '</td>' + rowContent + '</tr>';
        });

        tableHTML += '</tbody></table>';

        Swal.fire({
            title: 'Hasil Pencarian',
            html: tableHTML,
            width: '90%',
            showCloseButton: true,
            focusConfirm: false,
            confirmButtonText: 'Tutup'
        });
    }
});

// ===============================================================
// JS Untuk Edit Pembayaran
// ===============================================================
function editPembayaran(data) {
    document.getElementById('update_id').value = data.id;
    document.getElementById('update_id_tagihan').value = data.id_tagihan;
    document.getElementById('update_jumlah').value = data.jumlah;
    document.getElementById('update_metode_pembayaran').value = data.metode_pembayaran;
    document.getElementById('update_tanggal_pembayaran').value = data.tanggal_pembayaran;

    var updateModal = new bootstrap.Modal(document.getElementById('updatePembayaranModal'));
    updateModal.show();
}
</script>
