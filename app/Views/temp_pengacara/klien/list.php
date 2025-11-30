<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <!-- HEADER -->
            <div class="row mb-3">
                <div class="col-md-12 d-flex justify-content-between align-items-center">
                    <h2 class="title-1">Data Klien</h2>
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
