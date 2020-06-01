<!-- navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light smart-scroll">
    <div class="container">
        <a class="navbar-brand" href="<?= base_url() ?>">
            <img src="<?= base_url('assets/img') ?>/logo.png" width="100" alt="Privat In">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            </ul>
            <ul class="navbar-nav my-2 my-lg-0">
                <li class="nav-item <?php if ($title == 'Tentang Kami') {
                                        echo 'active';
                                    } ?>">
                    <a class="nav-link" href="<?= base_url('about') ?>">Tentang Kami</a>
                </li>

                <li class="nav-item <?php if ($title == 'Fitur') {
                                        echo 'active';
                                    } ?>">
                    <a class="nav-link" href="<?= base_url('fiture') ?>">Fitur</a>
                </li>
                <?php if (!$this->session->userdata('email')) { ?>
                    <li class="nav-item ml-3">
                        <a type="button" href="<?= base_url('auth/register') ?>" class="btn btn-outline-primary btn-radius btn-landingpage <?php if ($title == 'Register') {
                                                                                                                                                echo 'active';
                                                                                                                                            } ?>">Daftar</a>
                    </li>
                    <br>
                    <li class="nav-item ml-3">
                        <a type="button" href="<?= base_url('auth') ?>" class="btn btn-outline-success btn-radius btn-landingpage <?php if ($title == 'Masuk') {
                                                                                                                                        echo 'active';
                                                                                                                                    } ?>">Masuk</a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item ml-3">
                        <!-- <img class="w-25 img-fluid rounded-circle img-thumbnail shadow" src="<?= base_url('assets/img/') . $this->session->userdata('profileImg') ?>" alt=""> -->
                        <div class="dropdown">
                            <a href="" class="dropdown-toggle" style="text-decoration:none" id="dropdownMenuLink" data-toggle="dropdown">
                                <img class="img-fluid rounded-circle img-thumbnail" src="<?= base_url('assets/img/profile/') . $this->session->userdata('profileImg') ?>" width="50" alt="Privat In">
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg-right">
                                <a class="dropdown-item disabled">Hi <?= $this->session->userdata('name') ?>!</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= base_url('user') ?>"><i class="fas fa-fw fa-house-user"></i> Dashboard</a>
                                <?php if ($this->session->userdata('status_id') == 2) { ?>
                                    <a class="dropdown-item" href="<?= base_url('user/registrationTentor') ?>"><i class="fas fa-fw fa-user-graduate"></i> Menjadi tentor</a>
                                <?php } else { ?>
                                    <a class="dropdown-item" href="<?= base_url('user/tambahBidang') ?>"><i class="fas fa-fw fa-folder-plus"></i> Tambah bidang</a>
                                <?php } ?>
                                <a class="dropdown-item" href="<?= base_url('user/setting') ?>"><i class="fas fa-fw fa-user-cog"></i> Pengaturan profil</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= base_url('auth/logout') ?>"><i class="fas fa-fw fa-sign-out-alt"></i> Keluar</a>
                            </div>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>