<body class="auth">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card shadow mt-5">
                    <div class="card-body text-center p-5">
                        <div class="font-nunito">
                            <?= $this->session->flashdata('message'); ?>
                            <h5 class="card-title mb-4" style="font-size: 24px">Masuk aja dulu</h5>
                            <form action="auth/login" method="post">
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="email" name="email" style="font-size: 13px" placeholder="Masukkan email..." value="">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user" id="password" name="password" style="font-size: 13px" placeholder="Masukkan password...">
                                </div>
                                <button type="submit" style="font-size: 13px" class="btn btn-primary btn-user btn-block">Masuk</button>
                            </form>
                            <hr>
                            <a class="small" href="<?= base_url('auth/forgot') ?>">Lupa Password?</a><br>
                            <a class="small" href="<?= base_url('auth/register') ?>">Buat Akun!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>