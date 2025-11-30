
<!-- Toast container -->
<div class="position-fixed top-0 end-0 p-3" style="z-index: 1100">
    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="me-auto" id="toast-title"></strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body" id="toast-body"></div>
    </div>
</div>

  <!-- Vendor JS Files -->
  <script src="<?= base_url('temp_home/') ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url('temp_home/') ?>assets/vendor/php-email-form/validate.js"></script>
  <script src="<?= base_url('temp_home/') ?>assets/vendor/aos/aos.js"></script>
  <script src="<?= base_url('temp_home/') ?>assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="<?= base_url('temp_home/') ?>assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="<?= base_url('temp_home/') ?>assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="<?= base_url('temp_home/') ?>assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="<?= base_url('temp_home/') ?>assets/js/main.js"></script>
  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php if(session()->getFlashdata('success')): ?>
<script>
    const toastEl = document.getElementById('liveToast');
    document.getElementById('toast-title').innerText = "Success";
    document.getElementById('toast-body').innerText = "<?= session()->getFlashdata('success') ?>";
    const toast = new bootstrap.Toast(toastEl);
    toast.show();
</script>
<?php endif; ?>

<?php if(session()->getFlashdata('errors')): ?>
<script>
    const toastEl = document.getElementById('liveToast');
    document.getElementById('toast-title').innerText = "Error";
    let errors = "<?php foreach(session()->getFlashdata('errors') as $e){ echo $e.'\\n'; } ?>";
    document.getElementById('toast-body').innerText = errors;
    const toast = new bootstrap.Toast(toastEl);
    toast.show();
</script>
<?php endif; ?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('contact-form');
    const loading = form.querySelector('.loading');
    const submitBtn = form.querySelector('button[type="submit"]');

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        loading.style.display = 'block';
        submitBtn.disabled = true;

        const formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            loading.style.display = 'none';
            submitBtn.disabled = false;

            if(data.success) {
                form.reset();
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: data.success,
                    timer: 2000,
                    showConfirmButton: false
                });
            } else if(data.errors) {
                let messages = Object.values(data.errors).join("\n");
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: messages,
                });
            }
        })
        .catch(err => {
            loading.style.display = 'none';
            submitBtn.disabled = false;
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Terjadi kesalahan. Silakan coba lagi.',
            });
        });
    });
});
</script>

</body>

</html>