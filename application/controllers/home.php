<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('user_model', 'user');
	}

	public function index() {
		$this->load->view('common/header');
		$this->load->view('common/nav');
		$this->load->view('home');
		$this->checkUserSession();
	}

	// Get current user
	public function getUser() {
		$dataUser = [
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password')
		];

		$user = $this->user->getUser($dataUser);

		if($user != false) {
			$dataSession = [
				'id_user' => $user->id_user, 
				'username' => $user->username, 
				'password' => $user->password
			];

			$this->session->set_userdata($dataSession);
			redirect(base_url('posts'));
		} else {
			redirect(base_url());
		}
	}

	private function checkUserSession() {
		if($this->session->userdata('username') != NULL) {
			redirect(base_url('posts'));
		}
	}
}
