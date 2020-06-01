<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        if ($this->session->userdata('email')) {
            // masuk ke dashboard
            // $json = file_get_contents('http://localhost/privatin/api/profileUser?email=' . $this->session->userdata('email'));
            // $user = json_decode($json, true);
            // $user = $user[0];

            $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->result_array();
            $user = $user[0];

            if ($user['address'] == null || $user['province_id'] == null || $user['dateBirth'] == null || $user['education'] == null || $user['identityNumber'] == null || $user['identityImg'] == null || $user['contact'] == null || $user['description'] == null) {
                $this->session->set_flashdata('message', '
                <div class="alert alert-warning" role="alert">
                Profile tidak lengkap!<br> <a href="' . base_url('user/setting') . '">Klik untuk melengkapi profile</a>
                </div>');
            }
            $data['data_user'] = $user;
            $data['title'] = "Dashboard";
            $data['name'] = $this->session->userdata('name');
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar');

            if ($this->session->userdata('status_id') == 2) {
                // masuk ke dashboard student
                $data['user'] = 'student';
                $this->load->view('user/dashboard', $data);
            } else {
                //masuk ke dashboard tentor
                $data['user'] = 'tentor';
                $this->load->view('user/dashboard', $data);
            }
            $this->load->view('templates/footer');
            $this->load->view('templates/script');
        } else {
            // tendang ke login
            redirect('auth');
        }
    }

    public function registrationTentor()
    {
        if ($this->session->userdata('email')) {
            if ($this->session->userdata('status_id') == 2) {
                echo 'daftar tentor';
            } else {
                redirect('user');
            }
        } else {
            //tendang ke login
            redirect('auth');
        }
    }

    public function setting()
    {
        if (!$this->input->post('is_submit')) {
            $title['title'] = 'PrivatIn';
            $data['data_user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->result_array();
            $data['data_user'] = $data['data_user'][0];
            $city = $this->db->get_where('city', ['id' => $data['data_user']['city_id']])->result_array();
            if ($city != null) {
                $city = $city[0];
                $province = $this->db->get_where('province', ['id' => $city['province_id']])->result_array();
                $province = $province[0];
            } else {
                $city['city'] = null;
                $province['province'] = null;
            }
            $data['city'] = $city['city'];
            $data['province'] = $province['province'];
            $this->load->view('templates/header', $title);
            $this->load->view('templates/navbar');
            $this->load->view('user/setting', $data);
            $this->load->view('templates/footer');
            $this->load->view('templates/script');
        } else {
            $category = $this->input->post('category');
            if ($category == 'profile') {

                $city = urlencode($this->input->post('city'));

                $url = file_get_contents(base_url('api/dataProvince?city=') . $city);
                $obj = json_decode($url, true);

                $obj = $obj[0];
                $city_id = $obj['city_id'];
                $province_id = $obj['province_id'];

                $data = [
                    'name' => $this->input->post('name'),
                    'address' => $this->input->post('address'),
                    'city_id' => $city_id,
                    'province_id' => $province_id,
                    'contact' => $this->input->post('contact'),
                    'dateBirth' => $this->input->post('dateBirth'),
                    'education' => $this->input->post('education'),
                    'gender' => $this->input->post('gender'),
                    'description' => $this->input->post('description')
                ];


                //cek jika ada gambar yang akan diupdate
                $upload_image = $_FILES['profileImg']['name'];

                if ($upload_image) {
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['max_size'] = '2048'; //2MB
                    $config['upload_path'] = './assets/img/profile';

                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('profileImg')) {
                        // menghapus gambar lama biar ga memenuhi file kecuali default.jpg
                        $old_image = $data['data_user']['profileImg'];
                        if ($old_image != 'default.jpg') {
                            unlink(FCPATH . 'assets/img/profile/' . $old_image);
                        }
                        $new_image = $this->upload->data('file_name');
                        $this->db->set('profileImg', $new_image);
                    } else {
                        echo $this->upload->display_errors();
                    }
                }

                $this->db->set($data);
                $this->db->where('email', $this->session->userdata('email'));
                $this->db->update('user');

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diperbarui!</a></div>');
                redirect('user/setting');
            } else if ($category == 'privacy') {
            } else {
            }
        }
    }
}
