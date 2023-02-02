<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model("data");
	}
	function index() {
		redirect("login/login_screen");
	}
	function login_screen() {
		$_SESSION["systemname"] = "Sample Website";
		$this->load->view("blankpage");
	}
	function session(){
		echo json_encode($_SESSION);
	}
	function verify_login() {
		$post = $this->security->xss_clean($this->input->post());
		$data = $this->data->select_account($post["username"],$post["password"]);
		if (!empty($data)) {
			$_SESSION["fname"] = $data["fname"]; 
			$_SESSION["username"] = $data["username"]; 
			$_SESSION["password"] = $data["password"];
			echo 'verified';
		}
		else {
			echo 'denied';
		}
	}
	function save_comid(){
		$_SESSION['comid'] = $_POST['comid'];
		$_SESSION["comname"] = $this->data->select_comname();
	}
	function select_company(){
		if(empty($_SESSION["username"])) {
			redirect('login');
		}
		$data["company"] = $this->data->select_company();
		$this->load->view("company",$data);
	}
	function force_logout() {
		session_destroy();
		redirect("login/login_screen");
	}
}
