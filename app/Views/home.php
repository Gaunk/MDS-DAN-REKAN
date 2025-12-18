
  <main class="main">
<!-- Pengumuman / Breaking News -->
<section class="announcement py-2" style="background-color: #f8f9fa;"> <!-- samakan dengan light-background -->
  <div class="container d-flex align-items-center">
    <i class="bi bi-megaphone-fill me-2 text-dark"></i> <!-- icon warna sama -->
    <div class="announcement-text overflow-hidden position-relative w-100">
      <div class="scrolling-text text-dark">
        <strong>Pengumuman:</strong> Layanan konsultasi <strong>gratis setiap Jumat</strong>! &nbsp;|&nbsp; 
        Dapatkan informasi terbaru terkait <strong>hukum, peraturan terbaru, dan regulasi terkini</strong>!
        <strong>Firma Hukum MDS & Rekan</strong> – aman, terpercaya, profesional, berpengalaman, berdedikasi, responsif, solusi hukum tuntas, integritas tinggi, fokus pada kepentingan klien, dan partner hukum yang dapat diandalkan.
        Kami hadir untuk mendampingi Anda dengan layanan hukum berkualitas, memberikan nasihat tepat, strategi efektif, dan perlindungan hukum maksimal. Percayakan kebutuhan hukum Anda pada <strong>MDS & Rekan</strong>, firma hukum yang solid, handal, dan berkomitmen penuh terhadap kepuasan klien.
      </div>
    </div>
  </div>
</section>

<style>
.announcement-text {
  height: 1.5em; /* sesuaikan tinggi teks */
}

.scrolling-text {
  display: inline-block;
  white-space: nowrap;
  position: relative;
  animation: scrollText 60s linear infinite; /* durasi lama = scroll lebih lambat */
}

@keyframes scrollText {
  0% {
    transform: translateX(100%);
  }
  100% {
    transform: translateX(-100%);
  }
}

/* Optional: samakan font dengan Hero Section */
.announcement-text, .scrolling-text {
  font-family: inherit;
  font-size: 1rem;
}
</style>

  <!-- Hero Section -->
  <section id="hero" class="section hero light-background">

    <div class="container">
      <div class="row gy-4">
        
        <!-- Hero Text -->
        <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center" data-aos="fade-up">
          <h1>MDS DAN REKAN</h1>
          <p>Advokat - Konsultan Hukum - Arbiter - Mediator</p>
          <div class="d-flex">
            <a href="https://wa.me/+6282211922701?text=Halo%2C%20saya%20ingin%20bertanya." class="btn-get-started"><i class="bi bi-whatsapp"></i> Hubungi</a>
            <a href="#" class="glightbox btn-watch-video d-flex align-items-center">
              <i class="bi bi-play-circle"></i><span>Watch Video</span>
            </a>
          </div>
        </div>

  <!-- Hero Slider -->
<div class="col-lg-6 order-4 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="200">
  <div id="heroCarousel" class="carousel slide rounded-4 overflow-hidden" data-bs-ride="carousel">

    <div class="carousel-inner">

      <!-- Slide 1 -->
      <div class="carousel-item active">
        <img 
          src="<?= base_url('temp_home/') ?>assets/img/popup-1.png" 
          class="d-block w-100 img-fluid animated hero-slider-img" 
          alt="Slider Image 1"
        >
      </div>

      <!-- Slide 2 -->
      <div class="carousel-item">
        <img 
          src="<?= base_url('temp_home/') ?>assets/img/s-2.jpeg" 
          class="d-block w-100 img-fluid animated hero-slider-img" 
          alt="Slider Image 2"
        >
      </div>

    </div>

    <!-- Controls -->
    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>

    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>

  </div>
</div>

      </div>
    </div>

  </section><!-- /Hero Section -->

</main>


    <!-- About Section -->
    <section id="about" class="section about">

      <div class="container">

        <div class="row gy-3">

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <img src="<?= base_url('temp_home/') ?>assets/img/about-img.svg" alt="" class="img-fluid">
          </div>

          <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
          <div class="about-content ps-0 ps-lg-3">
            <h3>Firma Hukum MDS Dan Rekan: Profesionalisme dan Kepercayaan</h3>
            <p class="fst-italic">
            Firma Hukum MDS Dan Rekan menyediakan layanan hukum profesional untuk berbagai bidang, mulai dari hukum pidana, perdata, hingga hukum perusahaan dan kesehatan.  
            MDS adalah singkatan dari <strong>Muhammad Darrell Saefaturahman</strong>, diambil dari nama anak dan digabungkan dengan nama pemimpin dan pendiri firma hukum ini, yang berkomitmen memberikan solusi hukum terbaik bagi individu maupun perusahaan.
          </p>
            <ul>
              <li>
                <i class="bi bi-diagram-3"></i>
                <div>
                  <h4>Pengacara Berpengalaman</h4>
                  <p>Tim kami terdiri dari pengacara berpengalaman yang siap menangani kasus Anda dengan dedikasi dan profesionalisme.</p>
                </div>
              </li>
              <li>
                <i class="bi bi-file-text"></i>
                <div>
                  <h4>Layanan Hukum Lengkap</h4>
                  <p>Kami menangani berbagai masalah hukum, mulai dari sengketa perdata, pidana, hingga hukum perusahaan dan kesehatan.</p>
                </div>
              </li>
              <li>
              <i class="bi bi-person-badge"></i>
              <div>
                <h4>Konsultasi Profesional</h4>
                <p>Menyediakan konsultasi hukum yang jelas dan terpercaya untuk individu maupun perusahaan.</p>
              </div>
            </li>
            </ul>
            <p>
              Firma Hukum MDS Dan Rekan berkomitmen memberikan solusi hukum terbaik untuk individu maupun perusahaan, dengan integritas, transparansi, dan pelayanan prima. Kami memastikan setiap kasus ditangani dengan cermat dan profesional.
            </p>
          </div>
        </div>
          </div>
        </div>

      </div>

    </section><!-- /About Section -->

    <!-- Layanan Section -->
    <section id="layanan" class="layanan section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Layanan Firma Hukum MDS Dan Rekan</h2>
        <p>Firma Hukum MDS dan Rekan adalah firma hukum profesional yang berfokus pada penyelesaian perkara secara efektif dan berorientasi pada hasil. Kami menyediakan layanan litigasi maupun non-litigasi, termasuk hukum bisnis, perdata, pidana, properti, ketenagakerjaan, serta berbagai kebutuhan hukum lainnya. Dengan pengalaman mendalam dan analisis strategis, kami berkomitmen memberikan solusi komprehensif bagi individu maupun perusahaan yang membutuhkan pendampingan hukum terpercaya.</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
            <div class="service-item position-relative">
              <div class="icon"><img width="94" height="94" src="https://img.icons8.com/3d-fluency/94/law.png" alt="law"/></div>
              <h4><a href="service-details.html" class="stretched-link">Hukum Pidana</a></h4>
              <p>Layanan hukum pidana menangani semua kasus yang berkaitan dengan pelanggaran hukum kriminal, baik untuk individu maupun perusahaan.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="200">
            <div class="service-item position-relative">
              <div class="icon"><img width="94" height="94" src="https://img.icons8.com/external-wanicon-flat-wanicon/94/external-law-university-courses-wanicon-flat-wanicon.png" alt="external-law-university-courses-wanicon-flat-wanicon"/></div>
              <h4><a href="service-details.html" class="stretched-link">Hukum Perdata</a></h4>
              <p>Layanan ini menangani sengketa perdata antara individu atau perusahaan</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="300">
            <div class="service-item position-relative">
              <div class="icon"><img width="94" height="94" src="https://img.icons8.com/glyph-neue/94/courthouse.png" alt="courthouse"/></div>
              <h4><a href="service-details.html" class="stretched-link">Hukum Kesehatan</a></h4>
              <p>Layanan hukum ini khusus menangani isu hukum di bidang kesehatan dan rumah sakit</p>
            </div>
          </div><!-- End Service Item -->

           <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
            <div class="service-item position-relative">
              <div class="icon"><img width="94" height="94" src="https://img.icons8.com/external-becris-flat-becris/94/external-law-franchise-business-becris-flat-becris.png" alt="external-law-franchise-business-becris-flat-becris"/></div>
              <h4><a href="service-details.html" class="stretched-link">Hukum Perusahaan</a></h4>
              <p>Layanan hukum perusahaan mencakup seluruh aspek legal bisnis, hingga penyelesaian sengketa dan litigasi dan non litigasi.
              </p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="400">
            <div class="service-item position-relative">
              <div class="icon"><img width="64" height="64" src="https://img.icons8.com/external-bearicons-outline-color-bearicons/64/external-Law-file-and-document-bearicons-outline-color-bearicons.png" alt="external-Law-file-and-document-bearicons-outline-color-bearicons"/></div>
              <h4><a href="service-details.html" class="stretched-link">Hukum Ketenagakerjaan</a></h4>
              <p>Layanan ini menangani hubungan antara pekerja dan perusahaan</p>
            </div>
          </div><!-- End Service Item -->

        </div>

      </div>

    </section><!-- /Services Section -->

    <!-- Portfolio Section -->
    <section id="portfolio" class="portfolio section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Portfolio</h2>
        <p>Beberapa proyek dan kasus hukum yang telah kami tangani sebagai bukti pengalaman dan keahlian Firma Hukum MDS Dan Rekan.  
        Kami selalu berkomitmen memberikan layanan hukum yang profesional dan terpercaya bagi setiap klien.
        </p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

          <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
            <li data-filter="*" class="filter-active">All</li>
            <li data-filter=".filter-kegiatan">Kegiatan</li>
            <li data-filter=".filter-sosialisasi">Sosialisasi</li>
            <li data-filter=".filter-branding">Penyuluhan</li>
            <li data-filter=".filter-books">Konsultasi</li>
          </ul><!-- End Portfolio Filters -->

          <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-kegiatan">
              <div class="portfolio-content h-100">
                <img src="assets/img/portfolio/app-1.jpg" class="img-fluid" alt="">
                <div class="portfolio-info">
                  <h4>App 1</h4>
                  <p>Lorem ipsum, dolor sit amet consectetur</p>
                  <a href="assets/img/portfolio/app-1.jpg" title="App 1" data-gallery="portfolio-gallery-kegiatan" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                  <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-sosialisasi">
              <div class="portfolio-content h-100">
                <img src="assets/img/portfolio/product-1.jpg" class="img-fluid" alt="">
                <div class="portfolio-info">
                  <h4>Sosialisasi 1</h4>
                  <p>Lorem ipsum, dolor sit amet consectetur</p>
                  <a href="assets/img/portfolio/product-1.jpg" title="Sosialisasi 1" data-gallery="portfolio-gallery-sosialisasi" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                  <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-penyuluhan">
              <div class="portfolio-content h-100">
                <img src="assets/img/portfolio/branding-1.jpg" class="img-fluid" alt="">
                <div class="portfolio-info">
                  <h4>Penyuluhan 1</h4>
                  <p>Lorem ipsum, dolor sit amet consectetur</p>
                  <a href="assets/img/portfolio/branding-1.jpg" title="Penyuluhan 1" data-gallery="portfolio-gallery-penyuluhan" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                  <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-konsultasi">
              <div class="portfolio-content h-100">
                <img src="assets/img/portfolio/books-1.jpg" class="img-fluid" alt="">
                <div class="portfolio-info">
                  <h4>Konsultasi 1</h4>
                  <p>Lorem ipsum, dolor sit amet consectetur</p>
                  <a href="assets/img/portfolio/books-1.jpg" title="Konsultasi 1" data-gallery="portfolio-gallery-konsultasi" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                  <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
              <div class="portfolio-content h-100">
                <img src="assets/img/portfolio/app-2.jpg" class="img-fluid" alt="">
                <div class="portfolio-info">
                  <h4>App 2</h4>
                  <p>Lorem ipsum, dolor sit amet consectetur</p>
                  <a href="assets/img/portfolio/app-2.jpg" title="App 2" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                  <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-product">
              <div class="portfolio-content h-100">
                <img src="assets/img/portfolio/product-2.jpg" class="img-fluid" alt="">
                <div class="portfolio-info">
                  <h4>Product 2</h4>
                  <p>Lorem ipsum, dolor sit amet consectetur</p>
                  <a href="assets/img/portfolio/product-2.jpg" title="Product 2" data-gallery="portfolio-gallery-product" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                  <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-branding">
              <div class="portfolio-content h-100">
                <img src="assets/img/portfolio/branding-2.jpg" class="img-fluid" alt="">
                <div class="portfolio-info">
                  <h4>Branding 2</h4>
                  <p>Lorem ipsum, dolor sit amet consectetur</p>
                  <a href="assets/img/portfolio/branding-2.jpg" title="Branding 2" data-gallery="portfolio-gallery-branding" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                  <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-books">
              <div class="portfolio-content h-100">
                <img src="assets/img/portfolio/books-2.jpg" class="img-fluid" alt="">
                <div class="portfolio-info">
                  <h4>Books 2</h4>
                  <p>Lorem ipsum, dolor sit amet consectetur</p>
                  <a href="assets/img/portfolio/books-2.jpg" title="Branding 2" data-gallery="portfolio-gallery-book" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                  <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
              <div class="portfolio-content h-100">
                <img src="assets/img/portfolio/app-3.jpg" class="img-fluid" alt="">
                <div class="portfolio-info">
                  <h4>App 3</h4>
                  <p>Lorem ipsum, dolor sit amet consectetur</p>
                  <a href="assets/img/portfolio/app-3.jpg" title="App 3" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                  <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-product">
              <div class="portfolio-content h-100">
                <img src="assets/img/portfolio/product-3.jpg" class="img-fluid" alt="">
                <div class="portfolio-info">
                  <h4>Product 3</h4>
                  <p>Lorem ipsum, dolor sit amet consectetur</p>
                  <a href="assets/img/portfolio/product-3.jpg" title="Product 3" data-gallery="portfolio-gallery-product" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                  <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-branding">
              <div class="portfolio-content h-100">
                <img src="assets/img/portfolio/branding-3.jpg" class="img-fluid" alt="">
                <div class="portfolio-info">
                  <h4>Branding 3</h4>
                  <p>Lorem ipsum, dolor sit amet consectetur</p>
                  <a href="assets/img/portfolio/branding-3.jpg" title="Branding 2" data-gallery="portfolio-gallery-branding" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                  <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
              </div>
            </div><!-- End Portfolio Item -->

            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-books">
              <div class="portfolio-content h-100">
                <img src="assets/img/portfolio/books-3.jpg" class="img-fluid" alt="">
                <div class="portfolio-info">
                  <h4>Books 3</h4>
                  <p>Lorem ipsum, dolor sit amet consectetur</p>
                  <a href="assets/img/portfolio/books-3.jpg" title="Branding 3" data-gallery="portfolio-gallery-book" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                  <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
              </div>
            </div><!-- End Portfolio Item -->

          </div><!-- End Portfolio Container -->

        </div>

      </div>

    </section><!-- /Portfolio Section -->

    <!-- Faq Section -->
    <section id="faq" class="faq section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Frequently Asked Questions</h2>
        <p>Pertanyaan yang sering diajukan tentang layanan hukum kami</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row">

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">

            <div class="faq-container">

              <div class="faq-item">
                <h3>Apa saja layanan hukum yang ditawarkan oleh firma ini?</h3>
                <div class="faq-content">
                  <p>Kami menyediakan layanan hukum di berbagai bidang, termasuk Hukum Perusahaan, Hukum Pidana, Hukum Perdata, Hukum Kesehatan, dan Hukum Ketenagakerjaan.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <h3>Bagaimana cara menghubungi pengacara untuk konsultasi?</h3>
                <div class="faq-content">
                  <p>Anda bisa menghubungi kami melalui telepon, email, atau form kontak di website untuk membuat janji konsultasi dengan pengacara yang sesuai bidangnya.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <h3>Apakah firma ini menangani kasus individu maupun perusahaan?</h3>
                <div class="faq-content">
                  <p>Ya, kami menangani kasus baik untuk individu maupun perusahaan, tergantung bidang hukum yang dibutuhkan.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

            </div>

          </div><!-- End Faq Column-->

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">

            <div class="faq-container">

              <div class="faq-item">
                <h3>Berapa biaya konsultasi hukum di firma ini?</h3>
                <div class="faq-content">
                  <p>iaya konsultasi bervariasi tergantung jenis kasus dan kompleksitasnya. Untuk informasi lebih detail, silakan hubungi bagian administrasi atau gunakan form kontak.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <h3>Apakah bisa mendapatkan layanan hukum secara online?</h3>
                <div class="faq-content">
                  <p>Ya, kami menyediakan konsultasi awal secara online melalui telepon atau video call, terutama untuk klien yang berada di luar kota.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <h3>Berapa lama proses penyelesaian kasus biasanya?</h3>
                <div class="faq-content">
                  <p>Waktu penyelesaian tergantung jenis kasus dan proses hukum yang berlaku. Tim kami akan memberikan estimasi waktu setelah menganalisis kasus Anda.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

            </div>

          </div><!-- End Faq Column-->

        </div>

      </div>

    </section><!-- /Faq Section -->

    <!-- Team Section -->
    <section id="team" class="team section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Team</h2>
        <p>Pertemuan tim profesional pengacara kami yang berpengalaman</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">
<!-- Tambahkan style langsung di HTML -->
<style>
.member img {
    width: 100%;
    height: 250px; /* tinggi sama untuk semua */
    object-fit: cover; /* agar gambar terpotong sesuai kotak tanpa merusak rasio */
    border-radius: 8px; /* opsional, agar sedikit rounded */
}
</style>

<!-- Grid Pengacara -->
<div class="row">
    <?php foreach($pengacara as $p): ?>
    <div class="col-xl-3 col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
        <div class="member">
            <img src="<?= base_url('uploads/pengacara/' . ($p['foto_pengacara'] ?? 'default.png')) ?>" 
                 class="img-fluid" alt="<?= esc($p['nama']) ?>">
            <div class="member-info">
                <div class="member-info-content">
                    <h4><?= esc($p['nama']) ?></h4>
                </div>
                <div class="social">
                    <?php if(!empty($p['twitter'])): ?>
                        <a href="<?= esc($p['twitter']) ?>"><i class="bi bi-twitter"></i></a>
                    <?php endif; ?>
                    <?php if(!empty($p['facebook'])): ?>
                        <a href="<?= esc($p['facebook']) ?>"><i class="bi bi-facebook"></i></a>
                    <?php endif; ?>
                    <?php if(!empty($p['instagram'])): ?>
                        <a href="<?= esc($p['instagram']) ?>"><i class="bi bi-instagram"></i></a>
                    <?php endif; ?>
                    <?php if(!empty($p['linkedin'])): ?>
                        <a href="<?= esc($p['linkedin']) ?>"><i class="bi bi-linkedin"></i></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>



          <!-- End Team Member -->

        </div>

      </div>

    </section><!-- /Team Section -->

    <!-- Clients Section -->
    <section id="clients" class="clients section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Clients</h2>
        <p>
        Kami telah bekerja sama dengan berbagai klien, mulai dari individu hingga perusahaan, memberikan layanan hukum yang andal dan profesional.  
        Kepercayaan klien adalah prioritas utama kami dalam setiap kasus dan konsultasi.
        </p>

      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="swiper init-swiper">
          <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": "auto",
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              },
              "breakpoints": {
                "320": {
                  "slidesPerView": 2,
                  "spaceBetween": 40
                },
                "480": {
                  "slidesPerView": 3,
                  "spaceBetween": 60
                },
                "640": {
                  "slidesPerView": 4,
                  "spaceBetween": 80
                },
                "992": {
                  "slidesPerView": 6,
                  "spaceBetween": 120
                }
              }
            }
          </script>
          <div class="swiper-wrapper align-items-center">
            <div class="swiper-slide"><img src="<?= base_url('temp_home/') ?>assets/img/clients/client-1.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="<?= base_url('temp_home/') ?>assets/img/clients/client-2.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="<?= base_url('temp_home/') ?>assets/img/clients/client-3.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="<?= base_url('temp_home/') ?>assets/img/clients/client-4.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="<?= base_url('temp_home/') ?>assets/img/clients/client-5.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="<?= base_url('temp_home/') ?>assets/img/clients/client-6.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="<?= base_url('temp_home/') ?>assets/img/clients/client-7.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="<?= base_url('temp_home/') ?>assets/img/clients/client-8.png" class="img-fluid" alt=""></div>
          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>

    </section><!-- /Clients Section -->
    <!-- Visitors Section -->
<section id="visitors" class="visitors section light-background">

  <!-- Section Title -->
  <div class="container section-title text-center" data-aos="fade-up">
    <h2>Pengunjung</h2>
    <p>
      Temukan informasi dan layanan yang tersedia untuk pengunjung kami. 
      Kami menyediakan berbagai bantuan agar pengalaman Anda lebih mudah dan nyaman.
    </p>
  </div><!-- End Section Title -->

  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="row g-4 justify-content-center">

      <!-- Card 1 -->
      <div class="col-md-4">
        <div class="card h-100 text-center p-4 shadow-sm border-0 rounded-4 visitor-card">
          <div class="icon-wrapper mb-3">
            <i class="bi bi-info-circle animated-icon" style="font-size: 60px; color: #4e73df;"></i>
          </div>
          <div class="card-body">
            <h5 class="card-title">Informasi Layanan</h5>
            <p class="card-text">Dapatkan informasi lengkap tentang layanan yang kami sediakan untuk pengunjung.</p>
          </div>
        </div>
      </div>

      <!-- Card 2 -->
      <div class="col-md-4">
        <div class="card h-100 text-center p-4 shadow-sm border-0 rounded-4 visitor-card">
          <div class="icon-wrapper mb-3">
            <i class="bi bi-life-preserver animated-icon" style="font-size: 60px; color: #1cc88a;"></i>
          </div>
          <div class="card-body">
            <h5 class="card-title">Bantuan & Panduan</h5>
            <p class="card-text">Butuh bantuan? Ikuti panduan kami atau hubungi tim untuk mendapatkan solusi cepat.</p>
          </div>
        </div>
      </div>

      <!-- Card 3 -->
      <div class="col-md-4">
        <div class="card h-100 text-center p-4 shadow-sm border-0 rounded-4 visitor-card">
          <div class="icon-wrapper mb-3">
            <i class="bi bi-envelope animated-icon" style="font-size: 60px; color: #f6c23e;"></i>
          </div>
          <div class="card-body">
            <h5 class="card-title">Kontak Kami</h5>
            <p class="card-text">Ada pertanyaan? Hubungi kami melalui telepon, email, atau media sosial yang tersedia.</p>
          </div>
        </div>
      </div>

    </div>
  </div>

</section><!-- /Visitors Section -->

<!-- CSS untuk efek hover animasi -->
<style>
.visitor-card {
  transition: transform 0.3s, box-shadow 0.3s;
  cursor: pointer;
}

.visitor-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 15px 25px rgba(0,0,0,0.2);
}

.animated-icon {
  transition: transform 0.3s;
}

.visitor-card:hover .animated-icon {
  transform: scale(1.3) rotate(-10deg);
}
</style>

<!-- News Article Section -->
<section id="news" class="news section light-background">

  <!-- Section Title -->
  <div class="container section-title text-center" data-aos="fade-up">
    <h2>Berita Terbaru</h2>
    <p>
      Ikuti perkembangan terbaru dan informasi penting dari kami.
    </p>
  </div><!-- End Section Title -->

  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="row g-4">

      <!-- Article 1 -->
      <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0 rounded-4 news-card">
          <img src="https://storage.googleapis.com/danacita-website-v3-prd/website_v3/images/lawyer.original.jpg" class="card-img-top rounded-top-4" alt="Berita 1">
          <div class="card-body">
            <h5 class="card-title">Peningkatan Layanan Hukum</h5>
            <p class="card-text">
              Kami terus meningkatkan layanan hukum untuk masyarakat. Panduan interaktif dan konsultasi profesional siap membantu Anda.
            </p>
            <a href="#" class="btn btn-primary btn-sm">Baca Selengkapnya</a>
          </div>
        </div>
      </div>

      <!-- Article 2 -->
      <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0 rounded-4 news-card">
          <img src="https://i2.wp.com/asiatimes.com/wp-content/uploads/2020/07/Indonesia-Court-Room-Law-Justice.jpg" class="card-img-top rounded-top-4" alt="Berita 2">
          <div class="card-body">
            <h5 class="card-title">Panduan Digital untuk Pengunjung</h5>
            <p class="card-text">
              Panduan digital terbaru memungkinkan pengunjung mengakses informasi hukum dengan mudah melalui website maupun aplikasi.
            </p>
            <a href="#" class="btn btn-primary btn-sm">Baca Selengkapnya</a>
          </div>
        </div>
      </div>

      <!-- Article 3 -->
      <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0 rounded-4 news-card">
          <img src="https://www.acslaw.org/wp-content/uploads/2025/05/laws.jpg" class="card-img-top rounded-top-4" alt="Berita 3">
          <div class="card-body">
            <h5 class="card-title">Kegiatan Edukasi Hukum</h5>
            <p class="card-text">
              Program edukasi hukum terbaru membantu pengunjung memahami hak dan prosedur hukum secara praktis.
            </p>
            <a href="#" class="btn btn-primary btn-sm">Baca Selengkapnya</a>
          </div>
        </div>
      </div>

    </div>
  </div>

</section><!-- /News Section -->

<!-- CSS tambahan untuk animasi hover pada card berita -->
<style>
.news-card {
  transition: transform 0.3s, box-shadow 0.3s;
}

.news-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 15px 25px rgba(0,0,0,0.2);
}
</style>


    <!-- Contact Section -->
    <section id="contact" class="contact section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Kontak</h2>
        <p>Hubungi Firma Hukum MDS Dan Rekan untuk konsultasi hukum atau pertanyaan terkait layanan kami.  
        Tim kami siap memberikan solusi hukum yang cepat, tepat, dan profesional sesuai kebutuhan Anda.</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-5">

            <div class="info-wrap">
              <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="200">
                <i class="bi bi-geo-alt flex-shrink-0"></i>
                <div>
                  <h3>Address</h3>
                  <p>Pajeleran Gunung Sukahati, Kabupaten Bogor, 16931</p>
                </div>
              </div><!-- End Info Item -->

              <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
                <i class="bi bi-telephone flex-shrink-0"></i>
                <div>
                  <h3>Call Us</h3>
                  <p>+62 822 1192 2701</p>
                </div>
              </div><!-- End Info Item -->

              <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                <i class="bi bi-envelope flex-shrink-0"></i>
                <div>
                  <h3>Email Us</h3>
                  <p>mdsdanrekan@gmail.com</p>
                </div>
              </div><!-- End Info Item -->

              <iframe src="https://www.google.com/maps/embed?pb=!1m12!1m8!1m3!1d7928.384669670903!2d106.8155837!3d-6.4973174!3m2!1i1024!2i768!4f13.1!2m1!1sperumahan%20sukahati%20pajeleran%20kabupaten%20bogor!5e0!3m2!1sid!2sid!4v1764496306606!5m2!1sid!2sid" frameborder="0" style="border:0; width: 100%; height: 270px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
          </div>

          <div class="col-lg-7">
            <form id="contact-form" action="<?= base_url('contact/submit') ?>" method="post" class="form-contact" data-aos="fade-up" data-aos-delay="200">
            <div class="row gy-4">

              <div class="col-md-6">
                <label for="name-field">Your Name</label>
                <input type="text" name="name" id="name-field" class="form-control" required>
              </div>

              <div class="col-md-6">
                <label for="email-field">Your Email</label>
                <input type="email" name="email" id="email-field" class="form-control" required>
              </div>

              <div class="col-md-12">
                <label for="subject-field">Subject</label>
                <input type="text" name="subject" id="subject-field" class="form-control" required>
              </div>

              <div class="col-md-12">
                <label for="message-field">Message</label>
                <textarea name="message" id="message-field" class="form-control" rows="6" required></textarea>
              </div>

              <div class="col-md-12 text-center">
                <div class="loading" style="display:none;">Loading...</div>
                <button type="submit">Send Message</button>
              </div>

            </div>
          </form>

          </div><!-- End Contact Form -->

        </div>

      </div>

    </section><!-- /Contact Section -->

  </main>

  <footer id="footer" class="footer position-relative">

    <div class="footer-newsletter">
      <div class="container">
        <div class="row justify-content-center text-center">
          <div class="col-lg-6">
            <h4>Bergabunglah dengan Newsletter Kami</h4>
            <p>Berlangganan newsletter kami dan dapatkan berita terbaru tentang produk dan layanan kami!</p>
            <form action="forms/newsletter.php" method="post" class="php-email-form">
              <div class="newsletter-form"><input type="email" name="email"><input type="submit" value="Subscribe"></div>
              <div class="loading">Loading</div>
              <div class="error-message"></div>
              <div class="sent-message">Your subscription request has been sent. Thank you!</div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="index.html" class="d-flex align-items-center">
            <span class="sitename">Firma Hukum MDS Dan Rekan</span>
          </a>
          <div class="footer-contact pt-3">
            <p>Kabupaten Bogor</p>
            <p>Pajeleran Gunung, 16931</p>
            <p class="mt-3"><strong>Phone:</strong> <span>+62 822 1192 2701</span></p>
            <p><strong>Email:</strong> <span>mdsdanrekan@gmail.com</span></p>
          </div>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Link Berguna</h4>
          <ul>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Beranda</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Tentang Kami</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Layanan</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Syarat Layanan</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Layanan Kami</h4>
          <ul>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Hukum Pidana</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Hukum Perdata</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Hukum Kesehatan</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="#">Hukum Ketenagakerjaan</a></li>
          </ul>
        </div>


        <div class="col-lg-4 col-md-12">
          <h4>Ikuti kami</h4>
          <p>Tetap terhubung dengan kami untuk mendapatkan informasi, berita, dan konten terbaru dari berbagai platform kami.
          </p>
          <div class="social-links d-flex">
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p><span><?= esc($pengaturan['copyright'] ?? '') ?></span><strong class="px-1 sitename"></strong><span>All Rights Reserved</span></p>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
        Designed by <a href="https://mdsdanrekan.com/">FIRMA HUKUM MDS DAN REKAN</a>
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>
<!-- Popup HTML -->
<div class="popup-overlay" id="popup">
    <div class="popup-content">
        <img src="<?= base_url('temp_home/') ?>assets/img/popup-1.png" alt="Popup Gambar">
    </div>
</div>

<script>
// Tampilkan popup otomatis dengan animasi lembut
window.onload = function() {
    const popup = document.getElementById('popup');
    popup.style.display = 'flex';
    
    // Animasi masuk
    setTimeout(() => {
        popup.classList.add('show');
    }, 100); // delay kecil agar transition terlihat

    // Klik di mana saja (termasuk gambar) menutup popup
    popup.addEventListener('click', function() {
        closePopup();
    });

    // Tutup otomatis setelah 5 detik
    setTimeout(() => {
        closePopup();
    }, 5000);
}

// Fungsi tutup popup
function closePopup() {
    const popup = document.getElementById('popup');
    popup.classList.remove('show'); // animasi keluar
    setTimeout(() => {
        popup.style.display = 'none';
    }, 600); // sesuai durasi transition
}
</script>
