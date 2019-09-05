<?php defined("BASEPATH") or exit("No direct script access allowed");

class Login extends CI_Controller
{


	function __construct()
	{
		parent::__construct();
		$this->load->library("session");
		$this->load->library("form_validation");
		$this->load->model("account_model", "account");
		$this->logged_in();
	}

	function logged_in()
	{
		// echo $this->session->flashdata("invalid_password");
		if ($this->session->userdata('logged_in')) {
		
			$this->data["username"] = $this->session->userdata("username");
			$account_info = $this->account->get_account_info($this->data["username"]);
			foreach ($account_info->result_array() as $row) {
				$this->data["id_user"] = $row["id_user"];
				$this->data["fullname"] = $row["fullname"];
				$this->data["designation"] = $row["designation"];
				$this->data["id_role"] = $row["id_role"];
				$this->data["nm_role"] = $row["nm_role"];
				$this->data["user_pictures"] = $row["user_pictures"];
			}

			redirect("", "refresh");
		} else {
			// echo "emang ga masuk";
		}
	}

	function index()
	{




		$this->form_validation->set_rules("username", "Username", "trim|callback_custom_required[username]");
		$this->form_validation->set_rules("password", "Password", "trim|callback_custom_required[password]");

		if ($this->form_validation->run() == FALSE) {

			/*
			$data = array ();
			$data["error_string"] = array();
			$data["inputerror"] = array();
			$data["status"] = TRUE;
			
			if($this->input->post("username") == "")
			{
				$data["inputerror"][] = "username";
				//$data["error_string"][] = "Jenis Kartu Identitas Diri is required";
				$data["status"] = FALSE;
			}
			
			if($this->input->post("password") == "")
			{
				$data["inputerror"][] = "password";
				//$data["error_string"][] = "Jenis Kartu Identitas Diri is required";
				$data["status"] = FALSE;
			}
			
			if($data["status"] === FALSE)
			{
				echo json_encode($data);
				exit();
			}
			*/

			$data["page_title"] = "Login";
			$this->load->view("login", $data);

		} else {
		

			$username = $this->input->post("username");
			$password = $this->input->post("password");



			$result = $this->account->login($username, $password);

			if ($result) {
				foreach ($result as $row) {
					if ($this->agent->is_browser()) {
						$agent = $this->agent->browser() . " " . $this->agent->version();
					} elseif ($this->agent->is_robot()) {
						$agent = $this->agent->robot();
					} elseif ($this->agent->is_mobile()) {
						$agent = $this->agent->mobile();
					} else {
						$agent = "Unidentified User Agent";
					}

					$sess_array = array();

					$sess_array = array(
						"id_user" => $row->id_user,
						"username" => $row->username,
						"id_role" => $row->id_role,
						"csrf_token" => sha1(mt_rand()),
						"platform" => $this->agent->platform(),
						"browser" => $agent,
						"logged_in" => TRUE
					);

			
					$this->session->set_userdata($sess_array);
			
				}

				redirect("", "location");
			} else {
				$this->session->set_flashdata("invalid_password", "Invalid Username or Password");
				redirect("", "auto");

			
				return false;
			}
		}
	}

	public function custom_required($str, $func)
	{
		switch ($func) {
			case "username":
				$this->form_validation->set_message("custom_required", "Enter your Username");
				return (trim($str) == "") ? FALSE : TRUE;
				break;
			case "password":
				$this->form_validation->set_message("custom_required", "Enter your Password");
				return (trim($str) == "") ? FALSE : TRUE;
				break;
		}
	}
}
