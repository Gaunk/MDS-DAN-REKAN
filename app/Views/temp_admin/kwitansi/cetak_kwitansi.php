<!-- MAIN CONTENT-->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet">

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <!-- HEADER -->
            <div class="row mb-3">
                <div class="col-md-12 d-flex justify-content-between align-items-center">
                    <h2 class="title-1">Kwitansi Pembayaran</h2>
                </div>
            </div>

            <!-- Tabel Kwitansi -->
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nomor Kwitansi</th>
                        <th>Nama Klien</th>
                        <th>Nomor Perkara</th>
                        <th>Nomor Tagihan</th>
                        <th>Jumlah Bayar</th>
                        <th>Tanggal Bayar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach($kwitansi as $k): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= esc($k['nomor_kwitansi']) ?></td>
                        <td><?= esc($k['nama_klien']) ?></td>
                        <td><?= esc($k['nomor_perkara']) ?></td>
                        <td><?= esc($k['nomor_tagihan']) ?></td>
                        <td>Rp <?= number_format($k['jumlah_bayar'], 0, ',', '.') ?></td>
                        <td><?= esc($k['tanggal_pembayaran']) ?></td>
                        <td>
                            <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalKwitansi<?= $k['id'] ?>">
                                Preview / Print
                            </button>
                        </td>
                    </tr>

                    <!-- Modal Kwitansi -->
                    <div class="modal fade" id="modalKwitansi<?= $k['id'] ?>" tabindex="-1" aria-labelledby="modalLabel<?= $k['id'] ?>" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel<?= $k['id'] ?>">Kwitansi #<?= esc($k['nomor_kwitansi']) ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <p><strong>Nama Klien:</strong> <?= esc($k['nama_klien']) ?></p>
                            <p><strong>Nomor Perkara:</strong> <?= esc($k['nomor_perkara']) ?></p>
                            <p><strong>Nomor Tagihan:</strong> <?= esc($k['nomor_tagihan']) ?></p>
                            <p><strong>Jumlah Bayar:</strong> Rp <?= number_format($k['jumlah_bayar'],0,',','.') ?></p>
                            <p><strong>Tanggal Bayar:</strong> <?= esc($k['tanggal_pembayaran']) ?></p>
                            <hr>
                            <p>Terima kasih atas pembayaran Anda.</p>
                          </div>
                          <div class="modal-footer">
                            <a href="<?= base_url('admin/kwitansi_print/'.$k['id']) ?>" target="_blank" class="btn btn-primary">Print</a>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Calendar -->
            <div id="calendar" class="mt-5"></div>

        </div>
    </div>
</div>

<!-- FULLCALENDAR JS -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    let calendarEl = document.getElementById('calendar');

    let calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        selectable: true,
        events: "<?= base_url('admin/kalender_kwitansi'); ?>",
        eventClick: function(info) {
            info.jsEvent.preventDefault();
            if(info.event.url){
                window.open(info.event.url, '_blank');
            }
        }
    });

    calendar.render();
});
</script>
