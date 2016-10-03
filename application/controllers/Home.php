<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Home extends CI_Controller {	
	function __construct() {
		parent::__construct();
		
		$this->load->helper(array("url", "form"));
		$this->load->library(array("session", "form_validation"));

		$this->load->model("users_model");
		$this->load->model("topics_model");
		$this->load->model("dicts_model");
		$this->load->model("vocabularys_model");
	}

	public function index() {
		// $foundWords = $this->dicts_model->translate("gree");
		// echo "<pre>"; var_dump($foundWords); echo "</pre>"; die(1);
		$userLoggedIn = $this->session->userdata("loged-in");
		if ($userLoggedIn == null) {
			redirect('home/login', 'refresh');
		} else {
			$data["userLoggedIn"] = $userLoggedIn;
			$this->load->view('templates/header');
			$this->load->view("page/home", $data);
	        $this->load->view('templates/footer');	
		}
		
	}

	public function checkExistsUsername() {
		$username = $this->input->post('username');
		$result = $this->users_model->checkExistsUsername($username);
		echo $result;
	}

	public function login() {
		if ($this->input->post('btnSubmit') == null) {
			$this->loadLoginView();
		} else {
			if ($this->input->post('btnSubmit') == "register") {
				$this->form_validation->set_rules('r_username', 'Username', 'trim|required|min_length[6]|max_length[100]');
				$this->form_validation->set_rules('r_password', 'Password', 'trim|required|min_length[6]|max_length[100]');
				$this->form_validation->set_rules('r_email', 'Email
					', 'trim|required|min_length[6]|max_length[100]|valid_email');
				$this->form_validation->set_rules('r_passwordf', 'Password', 'trim|required');

				if ($this->form_validation->run()) {
					$newUser = array(
						"username" => $this->input->post('r_username'),
						"email" => $this->input->post('r_email'),
						"password" => $this->input->post('r_password'),
						"status" => "normal"
					);
					$this->users_model->create($newUser);
					$data["msg"] = "r_success";
					$this->loadLoginView($data);
				} else {
					$data["msg"] = "r_error";
					$this->loadLoginView($data);
				}
			}
			if ($this->input->post('btnSubmit') == "login") {
				$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[6]|max_length[100]');
				$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[100]');
				if ($this->form_validation->run()) {
					$userLoggedIn = $this->users_model->getUserLogin($this->input->post('username'), $this->input->post('password'));
					if ($userLoggedIn == null) {
						$data["msg"] = "l_error";
						$data["username_error"] = $this->input->post('username');
						$this->loadLoginView($data);
					} else {
						$this->session->set_userdata("loged-in", $userLoggedIn);
						redirect('home', 'refresh');
					}
				} else {
					$data["username_error"] = $this->input->post('username');
					$data["msg"] = "l_error";
					$this->loadLoginView($data);
				}
			}
					
		}
	}

	public function logout() {
		$this->session->unset_userdata("loged-in");
		redirect('home', 'refresh');
	}

	private function loadLoginView($data = null) {
		$this->load->view('templates/header', $data);
        $this->load->view('page/login', $data);
        $this->load->view('templates/footer', $data);
	}

	public function translate() {
		$keyword = $this->input->post('keyword');
		echo json_encode($this->dicts_model->translate($keyword));
	}

	public function getTopicList() {
		$result = array();
		$userLoggedIn = $this->session->userdata("loged-in");
		if ($userLoggedIn != null) {
			$result["topicList"] = $this->topics_model->getTopicByUser($userLoggedIn["user_id"]);
			$result["currentTopic"] = null;
			if (count($result["topicList"]) > 0)
				$result["currentTopic"] = $result["topicList"][0];
			echo json_encode($result);
		}
	}

	public function addTopic() {
		$result = array();
		$userLoggedIn = $this->session->userdata("loged-in");
		if ($userLoggedIn != null) {
			$newTopic = array(
				"user_id" => $userLoggedIn["user_id"],
				"topic_name" => $this->input->post('topicName'),
				"status" => $this->input->post('isShare')
				);
			$currentTopicId = $this->topics_model->create($newTopic);
			$result["currentTopic"] = $this->topics_model->get($currentTopicId);
			$result["topicList"] = $this->topics_model->getTopicByUser($userLoggedIn["user_id"]);

			echo json_encode($result);
		}
	}

	public function updateTopic() {
		$result = array();
		$userLoggedIn = $this->session->userdata("loged-in");
		if ($userLoggedIn != null) {
			$topic = array(
				"user_id" => $userLoggedIn["user_id"],
				"topic_name" => $this->input->post('topicName'),
				"status" => $this->input->post('isShare'),
				"topic_id" => $this->input->post('topicId')
				);
			$this->topics_model->update($topic);
			$result["currentTopic"] = $topic;
			$result["topicList"] = $this->topics_model->getTopicByUser($userLoggedIn["user_id"]);

			echo json_encode($result);
		}
	}

	public function deleteTopic() {
		$result = array();
		$userLoggedIn = $this->session->userdata("loged-in");
		if ($userLoggedIn != null) {
			$this->topics_model->delete($this->input->post('topicId'));
			$result["topicList"] = $this->topics_model->getTopicByUser($userLoggedIn["user_id"]);
			$result["currentTopic"] = null;
			if (count($result["topicList"]) > 0)
				$result["currentTopic"] = $result["topicList"][0];

			echo json_encode($result);
		}
	}

	public function getVocList() {
		$result = array();
		$userLoggedIn = $this->session->userdata("loged-in");
		if ($userLoggedIn != null) {
			$result["vocList"] = $this->vocabularys_model->getVobByTopic($this->input->post('topicId'));
			echo json_encode($result);
		}
	}

	public function addVoc() {
		$result = array();
		$userLoggedIn = $this->session->userdata("loged-in");
		if ($userLoggedIn != null) {
			$topicId = $this->input->post('topicId');
			$newVoc = array(
				"topic_id" => $topicId,
				"voc_new" => $this->input->post('vocNew'),
				"pron" => $this->input->post('pron'),
				"type" => $this->input->post('type'),
				"mean" => $this->input->post('mean'),
				"status" => $this->input->post('status'),
			);
			$vocId = $this->vocabularys_model->create($newVoc);
			$result["newVoc"] = $this->vocabularys_model->get($vocId);
			echo json_encode($result);
		}
	}

	public function deleteVoc() {
		$result = array();
		$userLoggedIn = $this->session->userdata("loged-in");
		if ($userLoggedIn != null) {
			$this->vocabularys_model->delete($this->input->post('vocId'));
			$result["status"] = "success";
			echo json_encode($result);
		}
	} 

}
?>