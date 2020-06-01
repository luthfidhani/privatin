<body style="background-image: url('<?= base_url('assets/img/background.png') ?>');background-repeat: repeat;">


    <div class="container mb-5 mt-5">
        <div class="row">
            <div class="col-md-4">
                <?= $this->session->flashdata('message'); ?>
                <div class="d-flex align-items-stretch">
                    <div class="card shadow container" style="width: 100%;">
                        <img class="card-img-top img-card img-center img-fluid rounded-circle img-thumbnail mt-3" style="width:200px; height:200px; background-size: cover;" src="<?= base_url('assets/img/profile/') . $this->session->userdata('profileImg') ?>" alt="sd">
                        <div class="card-body">
                            <h5 class="card-title text-center"><?= $this->session->userdata('name') ?></h5>
                            <hr>
                            <h5 style="font-size:16px">Profile diverifikasi
                                <?php if ($data_user['verify'] == 1) { ?>
                                    <i class="fas fa-check-circle" style="color: #51cf66; float: right;"></i>
                                <?php } else { ?>
                                    <i class="fas fa-times-circle" style="color: #ff6b6b; float: right;" title="Menunggu verifikasi admin"></i>
                                <?php } ?>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title">Special title treatment</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>