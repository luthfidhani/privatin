<?php

defined('BASEPATH') or exit('No direct script access allowed');

class About extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->model('homepage_model', 'homepage');
    }
    public function index()
    {
        $title['title'] = 'Tentang Kami';
        $this->load->view('templates/header', $title);
        $this->load->view('templates/navbar');
        $this->load->view('about');
        $this->load->view('templates/footer');
    }
}
