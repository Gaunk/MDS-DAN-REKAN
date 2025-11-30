<style>
.tag {
    display: inline-block;
    background: #007bff;
    color: #fff;
    padding: 5px 10px;
    border-radius: 15px;
    margin: 3px;
    font-size: 14px;
}
.tag .remove {
    margin-left: 8px;
    cursor: pointer;
    font-weight: bold;
}
</style>
    
<!-- MAIN CONTENT -->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <!-- HEADER -->
            <div class="row mb-3">
                <div class="col-md-12">
                    <h2 class="title-1">Pengaturan Sistem</h2>
                </div>
            </div>

            <div class="row">
                <!-- KIRI: Form Pengaturan -->
                <div class="col-lg-6 col-md-12 mb-4">
                    <section class="card">
                        <div class="card-header bg-primary text-light">
                            Form Pengaturan
                        </div>
                        <div class="card-body">
                           <form action="<?= base_url('admin/proses_pengaturansistem') ?>" method="POST" enctype="multipart/form-data">

                        <!-- Logo Perusahaan -->
                        <div class="mb-3">
                            <label>Logo Perusahaan</label>
                            <input type="file" name="logo" class="form-control" accept="image/*">
                        </div>

                        <!-- Nama Perusahaan -->
                        <div class="mb-3">
                            <label>Nama Perusahaan</label>
                            <input type="text" name="nama_perusahaan" class="form-control" 
                                   value="<?= esc($nama_perusahaan ?? '') ?>" required>
                        </div>

                        <!-- SEO -->
                        <div class="mb-3">
                            <label>SEO (Meta Description)</label>
                            <textarea name="seo" class="form-control"><?= esc($seo ?? '') ?></textarea>
                        </div>

                        <!-- KEYWORD -->
<div class="mb-3">
    <label>Keyword (Meta Keywords)</label>
    <input type="text" id="keywordInput" name="keyword" class="form-control" 
           value="<?= esc($keyword ?? '') ?>" 
           placeholder="Tekan ENTER untuk menambah keyword">
    <div id="keywordTags" class="mt-2"></div>
</div>


                        <!-- Copyright -->
                        <div class="mb-3">
                            <label>Copyright</label>
                            <input type="text" name="copyright" class="form-control" 
                                   value="<?= esc($copyright ?? '') ?>">
                        </div>

                        <!-- Maintenance -->
                        <div class="mb-3 form-check">
                            <input type="checkbox" name="maintenance" class="form-check-input" id="maintenance"
                                   <?= !empty($maintenance) ? 'checked' : '' ?>>
                            <label class="form-check-label" for="maintenance">Mode Maintenance</label>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>

                    </form>


                        </div>
                    </section>
                </div>

                <!-- KANAN: Preview / Info -->
                <div class="col-lg-6 col-md-12 mb-4">
                    <section class="card">
                        <div class="card-header bg-secondary text-light">
                            Preview Pengaturan
                        </div>
                        <div class="card-body">
                            <div class="card" style="display: flex; justify-content: center; align-items: center; padding: 20px; height: 200px;">
                                <img class="card-img-top" 
                                     src="<?= base_url('uploads/logo/' . ($logo ?? 'default-logo.png')) ?>" 
                                     alt="Logo Perusahaan"
                                     style="max-height: 100%; max-width: 100%; object-fit: contain;">
                            </div>

                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><strong>Nama Perusahaan:</strong> <span id="previewNama"><?= esc($nama_perusahaan ?? '-') ?></span></li>
                                <li class="list-group-item"><strong>SEO:</strong> <span id="previewSEO"><?= esc($seo ?? '-') ?></span></li>
                                <li class="list-group-item"><strong>Keyword:</strong> <span id="previewKEYword"><?= esc($keyword ?? '-') ?></span></li>
                                <li class="list-group-item"><strong>Copyright:</strong> <span id="previewCopyright"><?= esc($copyright ?? '-') ?></span></li>
                                <li class="list-group-item"><strong>Maintenance:</strong> <span id="previewMaintenance"><?= !empty($maintenance) ? 'Aktif' : 'Nonaktif' ?></span></li>
                            </ul>
                        </div>
                    </section>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- SWEETALERT2 FLASHDATA -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
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

<!-- UPDATE PREVIEW REALTIME -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const namaInput = document.querySelector('input[name="nama_perusahaan"]');
    const seoInput  = document.querySelector('textarea[name="seo"]');
    const keywordInput  = document.querySelector('input[name="keyword"]'); // ← PERBAIKAN
    const copyrightInput = document.querySelector('input[name="copyright"]');
    const maintenanceCheckbox = document.querySelector('input[name="maintenance"]');

    const previewNama = document.getElementById('previewNama');
    const previewSEO  = document.getElementById('previewSEO');
    const previewKEYword  = document.getElementById('previewKEYword');
    const previewCopyright = document.getElementById('previewCopyright');
    const previewMaintenance = document.getElementById('previewMaintenance');

    namaInput.addEventListener('input', () => previewNama.innerText = namaInput.value);
    seoInput.addEventListener('input', () => previewSEO.innerText = seoInput.value);
    keywordInput.addEventListener('input', () => previewKEYword.innerText = keywordInput.value); // ← FIXED
    copyrightInput.addEventListener('input', () => previewCopyright.innerText = copyrightInput.value);
    maintenanceCheckbox.addEventListener('change', () => previewMaintenance.innerText = maintenanceCheckbox.checked ? 'Aktif' : 'Nonaktif');
});

</script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const logoInput = document.querySelector('input[name="logo"]');
    const logoPreview = document.querySelector('.card-img-top');

    logoInput.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                logoPreview.src = event.target.result;
                // Sesuaikan ukuran logo
                logoPreview.style.width = '100%'; // penuh lebar card
                logoPreview.style.height = 'auto'; // proporsional
                logoPreview.style.objectFit = 'contain';
            };
            reader.readAsDataURL(file);
        }
    });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const input = document.getElementById('keywordInput');
    const tagContainer = document.getElementById('keywordTags');

    let tags = [];

    // Jika ada data lama (edit mode)
    <?php if (!empty($keyword)): ?>
        tags = "<?= esc($keyword) ?>".split(',').map(t => t.trim());
    <?php endif; ?>

    function renderTags() {
        tagContainer.innerHTML = "";
        tags.forEach((tag, index) => {
            let tagElem = document.createElement("span");
            tagElem.classList.add("tag");
            tagElem.innerHTML = `${tag} <span class="remove" data-index="${index}">&times;</span>`;
            tagContainer.appendChild(tagElem);
        });

        // Update input (yang dikirim ke server)
        input.value = tags.join(", ");
    }

    // Tambah keyword ketika ENTER ditekan
    input.addEventListener('keydown', function(e) {
        if (e.key === "Enter") {
            e.preventDefault();
            let value = input.value.trim();
            if (value !== "" && !tags.includes(value)) {
                tags.push(value);
                renderTags();
                input.value = "";
            }
        }
    });

    // Hapus keyword ketika tombol X diklik
    tagContainer.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove')) {
            let index = e.target.dataset.index;
            tags.splice(index, 1);
            renderTags();
        }
    });

    // Render awal jika ada data
    renderTags();
});
</script>
