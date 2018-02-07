<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Posts_model extends CI_Model {

  // Get options (States)
	public function getOptions() {
		$this->db->select('id_state, description');
		$this->db->from('state');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}	

  // Get Posts (Pagination -> Limit and start)
	public function getPosts($dataPosts, $limit, $start) {
		$this->db->select('posts.id_post, posts.title, posts.content, posts.date, posts.id_user, state.description');
		$this->db->from('posts');
		$this->db->join('state', 'posts.id_state = state.id_state');

		$this->db->like('posts.title', $dataPosts['title']);
		$this->db->like('posts.date', $dataPosts['date']);

		if($dataPosts['state'] != NULL) {
			$this->db->where('state.description', $dataPosts['state']);
		}

		$this->db->limit($limit, $start);

		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}

  // Count posts
	public function countPosts() {
		$result = $this->db->count_all_results('posts');
		return $result;
	}

  // Insert new post
	public function insertPost($dataNewPost) {
		$this->db->insert('posts', $dataNewPost);
	}

  // Delete post
	public function deletePost($idPost) {
		$this->db->delete('posts', array('id_post' => $idPost)); 
	}

}