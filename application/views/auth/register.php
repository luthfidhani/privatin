<body class="auth">
    <div class="container font-nunito">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card shadow mt-5">
                    <div class="card-body text-center p-5">
                        <div class="font-nunito">
                            <ul class="nav nav-pills nav-fill mb-3" id="pills-tab" role="tablist">
                                <!-- <div class="row"> -->
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-student-tab" data-toggle="pill" href="#pills-student" role="tab" onclick="student()">Daftar sebagai murid</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-tentor-tab" data-toggle="pill" href="#pills-tentor" role="tab" onclick="tentor()">Daftar sebagai tentor</a>
                                </li>
                            </ul>
                        </div>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-student" role="tabpanel">
                                <h5 class="card-title mb-4" style="font-size: 24px">Daftar sebagai murid</h5>
                            </div>

                            <div class="tab-pane fade" id="pills-tentor" role="tabpanel">
                                <h5 class="card-title mb-4" style="font-size: 24px">Daftar sebagai tentor</h5>
                            </div>
                        </div>
                        <form action="<?= base_url('auth/addUser') ?>" method="POST">
                            <input type="hidden" id="user" name="user" value="student">

                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="name" name="name" style="font-size: 13px" placeholder="Nama lengkap" value="<?= set_value('name') ?>">
                                <?= form_error('name', '<small class="text-danger pl-3">', '</small>') ?>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control form-control-user" id="email" name="email" style="font-size: 13px" placeholder="Email" value="<?= set_value('email') ?>">
                                <?= form_error('email', '<small class="text-danger pl-3">', '</small>') ?>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" id="password1" name="password1" style="font-size: 13px" placeholder="Password">
                                        <?= form_error('password1', '<small class="text-danger pl-3">', '</small>') ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" id="password2" name="password2" style="font-size: 13px" placeholder="Ketik ulang password">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" style="font-size: 13px" class="btn btn-primary btn-user btn-block">Daftar</button>
                        </form>
                        <hr>
                        <a class="small" href="<?= base_url('auth/forgot') ?>">Lupa Password?</a><br>
                        <a class="small" href="<?= base_url('auth') ?>">Login!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    function student() {
        document.getElementById("user").value = "student";
    }

    function tentor() {
        document.getElementById("user").value = "tentor";
    }
</script>