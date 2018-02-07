<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Posts extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->library('pagination');
		$this->load->model('posts_model', 'posts');
	}

	public function index() {
		$this->load->view('common/header');
		$this->load->view('common/nav');

		$options = $this->posts->getOptions();

		$dataPosts = [
			'title' => $this->input->get('title'),
			'date' => $this->input->get('date'),
			'state' => $this->input->get('state')
		];

		// Pagination
		$start = $this->input->get("page")??0;
		$limitPerPage = 10;
		$posts = $this->posts->getPosts($dataPosts, $limitPerPage, $start);
		$countPosts = $this->posts->countPosts();
		
		$config['base_url'] = base_url('posts');
		$config['total_rows'] = $countPosts;
		$config['per_page'] = $limitPerPage;

		$config['enable_query_strings'] = true;
		$config['page_query_string']    = true;
		$config['query_string_segment'] = 'page';

		$choice = $config["total_rows"] / $config["per_page"];
    $config["num_links"] = round($choice);

    $config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['prev_link'] = '&laquo';
		$config['prev_tag_open'] = '<li class="prev">';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = '&raquo';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';

		$this->pagination->initialize($config);
    $links = $this->pagination->create_links();

		$data = [
			'options' => $options, 
			'posts' => $posts, 
			'dataPosts' => $dataPosts, 
			'links' => $links
		];
			
		$this->load->view('posts', $data);
		$this->checkUserSession();
	}

  // Get data from inputs and create new post
	public function newPost() {
		$dataNewPost = [
			'title' => $this->input->post('title'),
			'content' => $this->input->post('content'),
			'date' => date('Y-m-d'),

			'id_user' => $this->session->userdata('id_user'),
			'id_state' => $this->input->post('state')
		];

		$this->posts->insertPost($dataNewPost);
		redirect(base_url('posts'));
	}

  // Delete post
	public function deletePost($idPost) {
		$this->posts->deletePost($idPost);
		redirect(base_url('posts'));
	}

  // Logout
	public function logout() {
		$this->session->sess_destroy();
		redirect(base_url());
	}

  // Check user session
	private function checkUserSession() {
		if($this->session->userdata('username') == NULL) {
			redirect(base_url());
		}
	}

}
