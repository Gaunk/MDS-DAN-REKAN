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
                <!-- Pemasukan -->
                <div class="col-sm-6 col-lg-4">
                    <div class="overview-item overview-item--c1">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon text-primary">
                                    <i class="zmdi zmdi-arrow-up"></i>
                                </div>
                                <div class="text">
                                    <h2>
                                        <img width="45" height="45" src="https://img.icons8.com/external-icongeek26-flat-icongeek26/45/external-Indonesian-Rupiah-currency-icongeek26-flat-icongeek26-3.png" alt="external-Indonesian-Rupiah-currency-icongeek26-flat-icongeek26-3"/> <?= number_format($totalPemasukan ?? 0, 2); ?></h2>
                                    <span>Uang masuk</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pengeluaran -->
                <div class="col-sm-6 col-lg-4">
                    <div class="overview-item overview-item--c3">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon text-warning">
                                    <i class="zmdi zmdi-arrow-down"></i>
                                </div>
                                <div class="text">
                                    <h2>
                                        <img width="45" height="45" src="https://img.icons8.com/external-icongeek26-flat-icongeek26/45/external-Indonesian-Rupiah-currency-icongeek26-flat-icongeek26-3.png" alt="external-Indonesian-Rupiah-currency-icongeek26-flat-icongeek26-3"/>
                                     <?= number_format($totalPengeluaran ?? 0, 2); ?></h2>
                                    <span>Pengeluaran</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sisa Uang -->
                <div class="col-sm-6 col-lg-4">
                    <div class="overview-item <?= ($sisaUang < 0) ? 'overview-item--c2' : 'overview-item--c1'; ?>">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon <?= ($sisaUang < 0) ? 'text-danger' : 'text-success'; ?>">
                                    <i class="zmdi <?= ($sisaUang < 0) ? 'zmdi-arrow-down' : 'zmdi-arrow-up'; ?>"></i>
                                </div>
                                <div class="text">
                                    <h2>
                                        <img width="45" height="45" src="https://img.icons8.com/external-icongeek26-flat-icongeek26/45/external-Indonesian-Rupiah-currency-icongeek26-flat-icongeek26-3.png" alt="external-Indonesian-Rupiah-currency-icongeek26-flat-icongeek26-3"/>
                                     <?= number_format($sisaUang ?? 0, 2); ?></h2>
                                    <span>
                                        <?php if($sisaUang < 0): ?>
                                            <strong class="text-white">Minus Uang</strong>
                                        <?php else: ?>
                                            <strong>Sisa saldo</strong>
                                        <?php endif; ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="table-responsive">
                    <table class="table table-borderless table-striped table-earning" id="pembayaranTable">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Klien</th>
                                <th>Nomor Perkara</th>
                                <th>Jumlah Bayar</th>
                                <th>Bukti Transaksi</th>
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
                                <td class="text-center">
                                <?php if(!empty($p['bukti_transaksi'])): ?>
                                    <a href="<?= base_url('uploads/bukti_transfer/' . $p['bukti_transaksi']) ?>" download class="btn btn-sm btn-success" title="Download">
                                        <i class="bi bi-download"></i>
                                    </a>
                                    <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#viewBuktiModal<?= $p['id'] ?>" title="View">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                <?php else: ?>
                                    <span class="text-muted">Tidak ada bukti</span>
                                <?php endif; ?>
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
                                    <button class="btn btn-sm btn-warning" onclick='editPembayaran(<?= json_encode($p) ?>)'>
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalKwitansi<?= $p['id'] ?>">
                                        <i class="bi bi-printer"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <nav class="mt-3">
                        <ul class="pagination justify-content-center" id="pembayaranPagination"></ul>
                    </nav>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php foreach($pembayaran as $p): ?>
<!-- Modal untuk menampilkan bukti transfer -->
<div class="modal fade" id="viewBuktiModal<?= $p['id'] ?>" tabindex="-1" aria-labelledby="viewBuktiLabel<?= $p['id'] ?>" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewBuktiLabel<?= $p['id'] ?>">Bukti Transfer #<?= esc($p['id']) ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style="height:80vh;">
        <?php if(pathinfo($p['bukti_transaksi'], PATHINFO_EXTENSION) == 'pdf'): ?>
            <iframe src="<?= base_url('uploads/bukti_transfer/' . $p['bukti_transaksi']) ?>" style="width:100%; height:100%;" frameborder="0"></iframe>
        <?php else: ?>
            <img src="<?= base_url('uploads/bukti_transfer/' . $p['bukti_transaksi']) ?>" alt="Bukti Transfer" style="width:100%; height:auto;">
        <?php endif; ?>
      </div>
      <div class="modal-footer">
        <a href="<?= base_url('uploads/bukti_transfer/' . $p['bukti_transaksi']) ?>" class="btn btn-primary" download>
            <i class="bi bi-download"></i> Download
        </a>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php endforeach ?>
<!-- =============================================================== -->
<!-- MODAL TAMBAH PEMBAYARAN -->
<!-- =============================================================== -->
<div class="modal fade" id="tambahPembayaranModal" tabindex="-1" aria-labelledby="tambahPembayaranLabel" aria-hidden="true">
  <div class="modal-dialog">
    <!-- enctype="multipart/form-data" penting untuk upload file -->
    <form id="formTambahPembayaran" action="<?= base_url('admin/tambahpembayaran') ?>" method="POST" enctype="multipart/form-data">
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
                        <option value="<?= $t['id'] ?>" data-jumlah="<?= $t['jumlah'] ?>">
                            <?= esc($t['id_perkara']) ?> - <?= esc($t['nama']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Jumlah Tagihan</label>
                <div id="jumlahTagihan" class="fw-bold" style="font-size: 1.1rem; color: #0d6efd;">
                    -- Pilih tagihan --
                </div>
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
            <!-- Upload Bukti Transfer -->
            <div class="mb-3">
                <label for="bukti_transfer" class="form-label">Bukti Transfer (Opsional)</label>
                <input type="file" name="bukti_transfer" id="bukti_transfer" class="form-control" accept="image/*,application/pdf">
                <small class="text-muted">Format: JPG, PNG, PDF. Maks: 2MB</small>
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
    <form id="formUpdatePembayaran" action="<?= base_url('admin/updatepembayaran') ?>" method="POST" enctype="multipart/form-data">
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
            <!-- Bukti Transfer -->
            <div class="mb-3">
                <label for="update_bukti_transfer" class="form-label">Bukti Transfer</label>
                <input type="file" name="bukti_transfer" id="update_bukti_transfer" class="form-control">
                <small class="text-muted">Kosongkan jika tidak ingin mengubah file</small>
                <div id="currentBukti" class="mt-2"></div>
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
<!-- MODAL KWITANSI PEMBAYARAN -->
<!-- =============================================================== -->
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
            Rp. <?= number_format($p['jumlah'],0,',','.') ?>
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
        <?php if($p['bukti_transfer']): ?>
        <a href="<?= base_url('uploads/bukti_transfer/'.$p['bukti_transfer']) ?>" target="_blank" class="btn btn-info">
            <i class="bi bi-eye"></i> View
        </a>
        <a href="<?= base_url('uploads/bukti_transfer/'.$p['bukti_transfer']) ?>" download class="btn btn-success">
            <i class="bi bi-download"></i> Download
        </a>
        <?php endif; ?>
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

    // Tampilkan bukti transfer jika ada
var currentBukti = document.getElementById('currentBukti');

if (data.bukti_transfer) {
    currentBukti.innerHTML = `
        <a href="/uploads/bukti_transfer/${data.bukti_transfer}" 
           target="_blank" 
           rel="noopener noreferrer" 
           class="btn btn-sm btn-info mb-1">
            <i class="bi bi-eye"></i> View
        </a>
        <a href="/uploads/bukti_transfer/${data.bukti_transfer}" 
           download 
           class="btn btn-sm btn-success mb-1">
            <i class="bi bi-download"></i> Download
        </a>
    `;
} else {
    currentBukti.innerHTML = '<span class="text-muted">Belum ada bukti transfer</span>';
}


    var updateModal = new bootstrap.Modal(document.getElementById('updatePembayaranModal'));
    updateModal.show();
}

</script>
<script>
document.getElementById('id_tagihan').addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex];
    const jumlah = selectedOption.getAttribute('data-jumlah') || 0;

    // Format angka menjadi rupiah
    const formattedJumlah = parseFloat(jumlah).toLocaleString('id-ID', { minimumFractionDigits: 2 });

    document.getElementById('jumlahTagihan').textContent = formattedJumlah;
});
</script>
<!-- Pagination -->
<nav class="mt-3">
    <ul class="pagination justify-content-center" id="pembayaranPagination"></ul>
</nav>

<script>
const rowsPerPage = 10;
const table = document.getElementById('pembayaranTable').getElementsByTagName('tbody')[0];
const rows = Array.from(table.getElementsByTagName('tr'));
const pagination = document.getElementById('pembayaranPagination');
let currentPage = 1;
const totalPages = Math.ceil(rows.length / rowsPerPage);

function showPage(page) {
    if(page < 1) page = 1;
    if(page > totalPages) page = totalPages;
    currentPage = page;

    const start = (page - 1) * rowsPerPage;
    const end = start + rowsPerPage;

    rows.forEach((row, index) => {
        row.style.display = (index >= start && index < end) ? '' : 'none';
    });

    renderPagination();
}

function renderPagination() {
    pagination.innerHTML = '';

    // Tombol Previous
    const prevLi = document.createElement('li');
    prevLi.className = 'page-item' + (currentPage === 1 ? ' disabled' : '');
    const prevA = document.createElement('a');
    prevA.className = 'page-link';
    prevA.href = '#';
    prevA.innerHTML = '&laquo;'; // panah kiri
    prevA.addEventListener('click', function(e) {
        e.preventDefault();
        showPage(currentPage - 1);
    });
    prevLi.appendChild(prevA);
    pagination.appendChild(prevLi);

    // Nomor halaman
    for (let i = 1; i <= totalPages; i++) {
        const li = document.createElement('li');
        li.className = 'page-item' + (i === currentPage ? ' active' : '');
        const a = document.createElement('a');
        a.className = 'page-link';
        a.href = '#';
        a.innerText = i;
        a.addEventListener('click', function(e) {
            e.preventDefault();
            showPage(i);
        });
        li.appendChild(a);
        pagination.appendChild(li);
    }

    // Tombol Next
    const nextLi = document.createElement('li');
    nextLi.className = 'page-item' + (currentPage === totalPages ? ' disabled' : '');
    const nextA = document.createElement('a');
    nextA.className = 'page-link';
    nextA.href = '#';
    nextA.innerHTML = '&raquo;'; // panah kanan
    nextA.addEventListener('click', function(e) {
        e.preventDefault();
        showPage(currentPage + 1);
    });
    nextLi.appendChild(nextA);
    pagination.appendChild(nextLi);
}

// Tampilkan halaman pertama saat load
showPage(1);
</script>
