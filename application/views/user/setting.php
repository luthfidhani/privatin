<body style="background-image: url('<?= base_url('assets/img/background.png') ?>');background-repeat: repeat;">

    <div class="container mt-3 mb-5 font-nunito">
        <h3>Pengaturan</h3>
        <div class="row pt-3">
            <div class="col-md-4">
                <?= $this->session->flashdata('message'); ?>
                <div class="card shadow container" style="width: 100%;">
                    <img class="card-img-top img-card img-center img-fluid rounded-circle img-thumbnail mt-3" style="width:200px; height:200px" src="<?= base_url('assets/img/profile/') . $this->session->userdata('profileImg') ?>" alt="sd">
                    <div class="card-body">
                        <h5 class="card-title text-center"><?= $this->session->userdata('name') ?></h5>
                        <hr>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card shadow container" style="width: 100%;">
                    <nav class="m-3">
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab">Profil</a>
                            <a class="nav-item nav-link" id="nav-privacy-tab" data-toggle="tab" href="#nav-privacy" role="tab">Privasi</a>
                            <a class="nav-item nav-link" id="nav-password-tab" data-toggle="tab" href="#nav-password" role="tab">Keamanan</a>
                        </div>
                    </nav>
                    <div class="tab-content m-3" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-profile" role="tabpanel">
                            <!-- edit profile -->

                            <?= form_open_multipart('user/setting') ?>
                            <h5>Info Pribadi</h5>
                            <hr>
                            <div class="form-group">
                                <label for="name">Nama lengkap</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?= $data_user['name'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="address">Alamat</label>
                                <textarea class="form-control" id="address" name="address" rows="3" value=""><?= $data_user['address'] ?></textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="city">Kota</label>
                                        <input type="text" class="form-control" id="city" name="city" value="<?= $city ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="province">Provinsi</label>
                                        <input type="text" class="form-control" id="province" name="province" value=" <?= $province ?>" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="contact">Nomor HP (WA)</label>
                                <input type="number" class="form-control" id="contact" name="contact" value="<?= $data_user['contact'] ?>">
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="dateBirth">Tanggal lahir</label>
                                        <input type="date" class="form-control" id="dateBirth" name="dateBirth" value="<?= $data_user['dateBirth'] ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="education">Pendidikan</label>
                                        <select class="form-control" id="education" name="education">
                                            <option value="sd" <?= $data_user['education'] == 'sd' ? ' selected="selected"' : ''; ?>>sd</option>
                                            <option value="smp" <?= $data_user['education'] == 'smp' ? ' selected="selected"' : ''; ?>>smp</option>
                                            <option value="sma" <?= $data_user['education'] == 'sma' ? ' selected="selected"' : ''; ?>>sma</option>
                                            <option value="sarjana" <?= $data_user['education'] == 'sarjana' ? ' selected="selected"' : ''; ?>>sarjana</option>
                                            <option value="magister" <?= $data_user['education'] == 'magister' ? ' selected="selected"' : ''; ?>>magister</option>
                                            <option value="doktor" <?= $data_user['education'] == 'doktor' ? ' selected="selected"' : ''; ?>>doktor</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="gender">Jenis kelamin</label>
                                        <select class="form-control" id="gender" name="gender">
                                            <option value="L" <?= $data_user['gender'] == 'L' ? ' selected="selected"' : ''; ?>>laki-laki</option>
                                            <option value="P" <?= $data_user['gender'] == 'P' ? ' selected="selected"' : ''; ?>>perempuan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="profileImg" style="width: 100%">Foto profil
                                    <div class="custom-file mt-2">
                                        <input type="file" class="custom-file-input" id="profileImg" name="profileImg">
                                        <label class="custom-file-label" for="profileImg">Choose file</label>
                                    </div>
                                </label>
                            </div>
                            <hr><br>
                            <h5>Tentang Saya</h5>
                            <hr>
                            <div class="form-group">
                                <label for="description">Biografi</label>
                                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Perkanalkan diri anda disini..." value=""><?= $data_user['description'] ?></textarea>
                            </div>
                            <input type="text" id="is_submit" name="is_submit" value="1" hidden>
                            <input type="text" id="category" name="category" value="profile" hidden>
                            <div style="float: right">
                                <a type="button" class="btn btn-outline-primary mr-3">Kembali</a>
                                <button type="submit" class="btn btn-primary">Simpan perubahan</button>
                            </div>
                            </form>
                        </div>

                        <div class="tab-pane fade" id="nav-privacy" role="tabpanel">
                            <!-- edit privacy -->

                        </div>

                        <div class="tab-pane fade" id="nav-password" role="tabpanel">
                            <!-- edit password -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>