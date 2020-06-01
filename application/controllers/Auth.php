<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        if ($this->session->userdata('email')) {
            // jika ada session dialihkan masuk ke user (dashboard)
            redirect('user');
        } else {
            $title['title'] = "Masuk";
            $this->load->view('templates/header', $title);
            $this->load->view('templates/navbar');
            $this->load->view('auth/login');
            $this->load->view('templates/script');
        }
    }

    public function register()
    {
        if ($this->session->userdata('email')) {
            // jika ada session dialihkan masuk ke user (dashboard)
            redirect('user');
        } else {
            $title['title'] = "Register";
            $this->load->view('templates/header', $title);
            $this->load->view('templates/navbar');
            $this->load->view('auth/register');
            $this->load->view('templates/script');
        }
    }

    public function login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        // echo ($email . " " . $password);

        $user = $this->db->get_where('user', ['email' => $email])->row_array();
        // var_dump($user);
        // die;

        if ($user) {
            if (password_verify($password, $user['password'])) {
                if ($user['status_id'] != 1) {
                    $data = [
                        'email' => $user['email'],
                        'name' => $user['name'],
                        'profileImg' => $user['profileImg'],
                        'status_id' => $user['status_id']
                    ];
                    $this->session->set_userdata($data);

                    if ($user['status_id'] == 2) {
                        if ($user['tentor_active'] == null) {
                            // masuk ke dashboard student
                            redirect('user');
                        } else {
                            //masuk ke daftar tentor
                            redirect('user/registrationTentor');
                        }
                    } else {
                        // masuk ke dashboard tentor
                        redirect('user');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Akun belum diaktivasi! Cek email anda
                </div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Password salah
                </div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Email belum terdaftar
            </div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('status_id');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda telah keluar! </div>');
        redirect('auth');
    }

    public function addUser()
    {
        $this->form_validation->set_rules('name', 'Nama', 'required|trim', [
            'required' => 'Nama tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'required' => 'Email tidak boleh kosong',
            'is_unique' => 'Email sudah terpakai',
            'valid_email' => 'Email salah'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]', [
            'min_length' => 'Minimal 6 karakter',
            'matches' => 'Password tidak sama'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if (!$this->form_validation->run()) {
            $title['title'] = "Register";
            $this->load->view('templates/header', $title);
            $this->load->view('templates/navbar');
            $this->load->view('auth/register');
            $this->load->view('templates/script');
        } else {
            $name = htmlspecialchars($this->input->post('name'), true);
            $email = htmlspecialchars($this->input->post('email'), true);
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);

            $user = $this->input->post('user');
            $data = [
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'profileImg' => 'default.jpg',
                'dateCreated' => time(),
                'status_id' => 1
            ];
            // var_dump($data);
            // die;

            $this->db->insert('user', $data);

            //kirim token dan email
            $this->sendTokenEmail($email, 'verify', $user);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil!. Akun ' . $email . ' diregistrasi. Cek email untuk verifikasi!</div>');

            redirect('auth');
        }
    }

    private function sendTokenEmail($email, $type, $user)
    {
        $token = base64_encode(random_bytes(32));
        $user_token = [
            'email' => $email,
            'user' => $user,
            'token' => $token,
            'dateCreated' => time()
        ];
        $this->db->insert('user_token', $user_token);

        $config = [
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'medotjanji20@gmail.com',
            'smtp_pass' => '@MEDOTjanji-1378',
            'smtp_port' => 465,
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'newline'   => "\r\n",
        ];

        $this->load->library('email', $config);
        $this->email->initialize($config);

        $this->email->from('captainluth17@gmail.com', 'Captain Luth');
        $this->email->to($email);


        if ($type == 'verify') {
            $this->email->subject('Akun Verifikasi');
            $this->email->message('Klik link disini untuk aktivasi : <a href="' . base_url() . 'auth/verify?email=' . $email . '&user=' . $user . '&token=' . urlencode($token) . '">Aktivasi</a>');
        } else if ($type == 'forgotpassword') {
            $this->email->subject('Lupa Password');
            $this->email->message('Klik disini untuk merubah password : <a href="' . base_url() . 'auth/resetPassword?email=' . $email . '&token=' . urlencode($token) . '">Ubah Password</a>');
        }

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function verify()
    {
        $email = $this->input->get('email');
        $who = $this->input->get('user');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user_token', ['email' => $email])->row_array();

        if ($user) {
            $user_who = $this->db->get_where('user_token', ['user' => $who])->row_array();

            if ($user_who) {
                $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

                if ($user_token) {
                    // waktu now - waktu dateCreated       < 1 hari (detik * menit * jam ) => batas expired aktivasi
                    if ((time() - $user_token['dateCreated']) < (60 * 60 * 24)) {

                        if ($who == "student") {
                            $this->db->set('status_id', 2);
                        } else {
                            $this->db->set('status_id', 3);
                        }

                        $this->db->where('email', $email);
                        $this->db->update('user');

                        $this->db->delete('user_token', ['email' => $email]);

                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">' . $email . ' berhasil diaktivasi! Silahkan masuk</div>');
                        redirect('auth');
                    } else { // hapus akun kalo sudah expired
                        $this->db->delete('user', ['email' => $email]);
                        $this->db->delete('user_token', ['email' => $email]);

                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Aktivasi akun gagal! Token kadaluarsa, harap daftar lagi</div>');
                        redirect('auth');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Aktivasi akun gagal! Token salah</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Aktivasi akun gagal! User salah</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Aktivasi akun gagal! Email salah</div>');
            redirect('auth');
        }
    }

    public function forgot()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
            'required' => 'Email tidak boleh kosong',
            'valid_email' => 'Email salah'
        ]);

        if (!$this->form_validation->run()) {
            $title['title'] = "LupaPassword";
            $this->load->view('templates/header', $title);
            $this->load->view('templates/navbar');
            $this->load->view('auth/forgot');
            $this->load->view('templates/script');
        } else {
            $email = $this->input->post('email');
            $active = $this->db->query('SELECT * FROM user WHERE status_id != 1')->row_array();

            if ($active) {
                $this->sendTokenEmail($email, 'forgotpassword', 'reset');
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil! cek email untuk reset password</div>');
                redirect('auth');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Akun belum diaktivasi! cek email untuk melakukan aktivasi</div>');
                redirect('auth');
            }
        }
    }

    public function resetPassword()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user_token', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if ($user_token) {
                // waktu now - waktu date_created       < 1 hari (detik * menit * jam ) => batas expired aktivasi
                if ((time() - $user_token['dateCreated']) < (60 * 60 * 24)) {
                    $this->session->set_userdata('reset_mail', $email);

                    $this->changedPassword();
                } else { // hapus akun kalo sudah expired
                    $this->db->delete('user', ['email' => $email]);
                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Ubah password gagal! Token kadaluarsa</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Ubah password gagal! Token salah</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Ubah password gagal! Email salah</div>');
            redirect('auth');
        }
    }

    public function changedPassword()
    {
        $this->form_validation->set_rules('password1', 'New password', 'required|trim|min_length[6]|matches[password2]', [
            'min_length' => 'Minimal 6 karakter',
            'matches' => 'Password tidak sama'
        ]);
        $this->form_validation->set_rules('password2', 'Retype password', 'required|trim|min_length[6]|matches[password1]');

        if ($this->form_validation->run() == false) {
            $title['title'] = 'Reset Password';
            $this->load->view('templates/header', $title);
            $this->load->view('templates/navbar');
            $this->load->view('auth/changed-password');
            $this->load->view('templates/script');
        } else {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_mail');

            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->db->delete('user_token', ['email' => $email]);

            $this->session->unset_userdata('reset_mail');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Reset password berhasil</div>');
            redirect('auth');
        }
    }
}
