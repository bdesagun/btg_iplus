<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model("data");
	}
	function index() {
		$_SESSION["systemname"] = "BTG Intelligence Plus";
		$_SESSION["theme"] = "theme-light-green";
		redirect("login/login_screen");
	}
	function login_screen() {
		$this->load->view("login");
	}
	function session(){
		echo json_encode($_SESSION);
	}
	function verify_login() {
		$post = $this->security->xss_clean($this->input->post());
		$data = $this->data->select_account($post["username"],$post["password"]);
		if (!empty($data)) {
			$_SESSION["accountname"] = $data["accountname"];
			$_SESSION["username"] = $data["username"]; 
			$_SESSION["password"] = $data["password"];
			echo 'verified';
		}
		else {
			echo 'denied';
		}
	}
	function homepage(){
		redirect("page");
	}
	function force_logout() {
		session_destroy();
		redirect("login");
	}
	// function encrypt_pass(){
	// 	echo md5("admin");
	// }
}
