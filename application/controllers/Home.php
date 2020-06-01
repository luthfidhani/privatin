<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		// $this->load->model('homepage_model', 'homepage');
	}
	public function index()
	{
		$title['title'] = 'PrivatIn';
		// $data['category'] = $this->db->get('category')->result_array();
		// $data['focus'] = $this->db->get('focus')->result_array();
		$this->load->view('templates/header', $title);
		$this->load->view('templates/navbar');
		$this->load->view('home');
		$this->load->view('templates/footer');
		$this->load->view('templates/script');

		$inputCity = $this->input->get('term');
		if ($inputCity) {
			$city = $this->db->query('SELECT city FROM city')->result_array();
			echo json_encode($city);
		}
	}

	public function dataCity()
	{
		$inputCity = $this->input->get('term');
		if ($inputCity) {
			$city = $this->db->query('SELECT city as value FROM city WHERE city LIKE "%' . $inputCity . '%"')->result_array();
		} else {
			$city = $this->db->query('SELECT city as value FROM city')->result_array();
		}
		echo json_encode($city);
	}

	//--------------------------------------------------------------------

}
