<div class="container mt-4">
    <h2>Jadwal Sidang (Realtime dari SIPP PN Negara)</h2>

    <?php if (empty($jadwals)): ?>
        <div class="alert alert-warning">
            Tidak ada data jadwal sidang (atau gagal scrape).
        </div>
    <?php else: ?>
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Tanggal Sidang</th>
                    <th>Nomor Perkara</th>
                    <th>Sidang Keliling</th>
                    <th>Ruangan</th>
                    <th>Agenda</th>
                    <th>Detil</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($jadwals as $jadwal): ?>
                    <tr>
                        <td><?= esc($jadwal['no']) ?></td>
                        <td><?= esc($jadwal['tanggal_sidang']) ?></td>
                        <td><?= esc($jadwal['nomor_perkara']) ?></td>
                        <td><?= esc($jadwal['sidang_keliling']) ?></td>
                        <td><?= esc($jadwal['ruangan']) ?></td>
                        <td><?= esc($jadwal['agenda']) ?></td>
                        <td>
                            <?php if (!empty($jadwal['detil'])): ?>
                                <a href="<?= esc($jadwal['detil']) ?>" target="_blank">Lihat Detil</a>
                            <?php else: ?>
                                -
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
