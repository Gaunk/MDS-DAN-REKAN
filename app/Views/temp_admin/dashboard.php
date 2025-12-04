

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1">Dashboard</h2>
                                    <!-- <button class="au-btn au-btn-icon au-btn--blue">
                                        <i class="zmdi zmdi-plus"></i>add item</button> -->
                                </div>
                            </div>
                        </div>
                        <div class="row m-t-25">
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c1">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-account-o"></i>
                                            </div>
                                            <div class="text">
                                                <h2><?= $totalAkun ?></h2>
                                                <span>members</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            <canvas id="widgetChart1"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c2">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-balance"></i>
                                            </div>
                                            <div class="text">
                                                <h2><?= $jumlahPengacara; ?></h2>
                                                <span>Advokat</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            <canvas id="widgetChart2"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c3">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-calendar-note"></i>
                                            </div>
                                            <div class="text">
                                                <h2><?= $totalPerkara ?></h2>
                                                <span>total kasus</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            <canvas id="widgetChart3"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c4">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-money"></i>
                                            </div>
                                            <div class="text">
                                                <h4><?= number_format($totalNominal, 0, ',', '.') ?></h4>
                                                <span>total pemasukan</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            <canvas id="widgetChart4"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-9">
                                <h2 class="title-1 m-b-25">Daftar Nomor SKK</h2>

                                <!-- Form Pencarian -->
                                <div class="mb-3">
                                    <label for="searchInput">Cari Perkara:</label>
                                    <input type="text" id="searchInput" class="form-control" placeholder="Ketik nama klien, jenis kasus, status, dsb...">
                                </div>
                                <div class="table-responsive table--no-card m-b-40">
                                    <table id="perkaraTable" class="table table-borderless table-striped table-earning">
                                        <thead>
                                            <tr>
                                                <th>No. SKK</th>
                                                <th>Nama</th>
                                                <th>Jenis Kasus</th>
                                                <th class="text-end">Status</th>
                                                <th class="text-end">Pengacara</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($listPerkara as $p): ?>
                                            <tr>
                                                <td><?= esc($p['nomor_perkara']) ?></td>
                                                <td><?= esc($p['nama_klien']) ?></td>
                                                <td><?= esc($p['jenis_kasus']) ?></td>
                                                <td class="text-end"><?= esc($p['status']) ?></td>
                                                <td class="text-end"><?= esc($p['nama_pengacara']) ?></td>
                                            </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <h2 class="title-1 m-b-25">Kantor Cabang</h2>
                                <div class="au-card au-card--bg-blue au-card-top-countries m-b-40">
                                    <div class="au-card-inner">
                                        <div class="table-responsive">
                                            <table class="table table-top-countries">
                                                <tbody>
                                                    <tr>
                                                        <td>Bandung Barat</td>
                                                        <td class="text-end">1</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Cianjur</td>
                                                        <td class="text-end">1</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Bogor</td>
                                                        <td class="text-end">1</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="copyright">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

    