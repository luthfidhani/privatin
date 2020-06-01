<body class="auth">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card shadow mt-5">
                    <div class="card-body text-center p-5">
                        <div class="font-nunito">
                            <?= $this->session->flashdata('message'); ?>

                            <h5 class="card-title mb-4" style="font-size: 24px">Lupa Password</h5>
                            <form action="<?= base_url('auth/forgot') ?>" method="POST">
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="email" name="email" style="font-size: 13px" placeholder="Masukkan email..." value="">
                                    <?= form_error('email', '<small class="text-danger pl-3">', '</small>') ?>
                                </div>
                                <button type="submit" style="font-size: 13px" class="btn btn-primary btn-user btn-block">Reset</button>
                            </form>
                            <hr>
                            <a class="small" href="<?= base_url('auth/register') ?>">Buat Akun!</a><br>
                            <a class="small" href="<?= base_url('auth') ?>">Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>