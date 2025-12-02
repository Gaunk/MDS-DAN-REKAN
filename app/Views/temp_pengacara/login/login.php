<body>
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img class="w-25" src="<?= base_url('temp_admin/')?>images/hero-1.png" alt="MDS Dan Rekan">
                            </a>
                        </div>
                        <div class="login-form">
                            <form action="<?= base_url('pengacara/doLogin')?>" method="post">
                                <div class="form-group">
                                    <label>Usrename</label>
                                    <input class="au-input au-input--full" type="text" name="username" id="kata_sandi" placeholder="Username">
                                </div>
                               <div class="form-group">
                                    <label>Password</label>
                                    <div style="position: relative;">
                                        <input id="password" class="au-input au-input--full" type="password" name="kata_sandi" placeholder="Password">
                                        <span id="togglePassword" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
                                            👁️
                                        </span>
                                    </div>
                                </div>
                                <div class="login-checkbox mt-3">
                                    <label>
                                        <a href="#">Lupa Password?</a>
                                    </label>
                                </div>
                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">Masuk</button>
                                <div class="social-login-content">
                                    
                                </div>
                            </form>
                            <div class="register-link">
                                <p>
                                    Tidak punya akun?
                                    <a href="#">Daftar</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ========================================= -->
    <!-- Tambahkan SweetAlert2 Toast di bagian ini -->
    <!-- ========================================= -->

    <!-- Library SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2500,
            timerProgressBar: true,
        });

        <?php if (session()->getFlashdata('success')): ?>
            Toast.fire({
                icon: 'success',
                title: '<?= session()->getFlashdata('success'); ?>'
            });
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            Toast.fire({
                icon: 'error',
                title: '<?= session()->getFlashdata('error'); ?>'
            });
        <?php endif; ?>
    </script>
                                <script>
                                    const password = document.getElementById('password');
                                    const togglePassword = document.getElementById('togglePassword');

                                    togglePassword.addEventListener('click', function () {
                                        // Toggle type password/text
                                        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                                        password.setAttribute('type', type);

                                        // Ubah icon
                                        this.textContent = type === 'password' ? '👁️' : '🙈';
                                    });
                                </script>

</body>
