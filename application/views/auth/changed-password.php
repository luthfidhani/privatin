<body class="auth">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card shadow mt-5">
                    <div class="card-body text-center p-5">
                        <div class="font-nunito">
                            <?= $this->session->flashdata('message'); ?>

                            <h3 class="card-title mb-4">Reset Password</h3>
                            <h5 class="card-title mb-4"><?= $this->session->userdata('reset_mail') ?></h5>
                            <form action="<?= base_url('auth/changedPassword') ?>" method="POST">
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user" id="password1" name="password1" style="font-size: 13px" placeholder="Password baru..." value="">
                                    <?= form_error('password1', '<small class="text-danger pl-3">', '</small>') ?>
                                    <br>
                                    <input type="password" class="form-control form-control-user" id="password2" name="password2" style="font-size: 13px" placeholder="Ketik ulnag password..." value="">
                                </div>
                                <button type="submit" style="font-size: 13px" class="btn btn-primary btn-user btn-block">Ubah</button>
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