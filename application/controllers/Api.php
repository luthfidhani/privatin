<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Api extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->model('homepage_model', 'homepage');
    }

    public function dataCity()
    {
        $data = $this->db->query('SELECT city as value FROM city')->result_array();
        echo json_encode($data);
    }

    public function dataProvince()
    {
        $city = $this->input->get('city');
        $data = $this->db->query("SELECT city.id as city_id, city, province.id as province_id, province FROM `city` JOIN province ON city.province_id = province.id where city =  '" . $city . "'")->result_array();
        echo json_encode($data);
    }

    public function dataSubject()
    {
        $data = $this->db->query('SELECT name as value FROM focus_group')->result_array();
        echo json_encode($data);
    }

    public function profileUser()
    {
        $email = $this->input->get('email');
        if ($email) {
            $data = $this->db->query("SELECT name, email, address, city_id, province_id, dateBirth, education, identityNumber, profileImg, identityImg, contact, description, status_id, tentor_active, verify FROM user WHERE email='" . $email . "'")->result_array();
            if (!$data) {
                $data = [
                    'status' => 'not found'
                ];
            }
        } else {
            $data = [
                'status' => 'not found'
            ];
        }
        echo json_encode($data);
    }

    //--------------------------------------------------------------------

}
