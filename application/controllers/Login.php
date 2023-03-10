<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model("data");
	}
	function index() {
		redirect("Login/login_screen");
	}
	function login_screen() {
		$_SESSION["systemname"] = "BTG Intelligence Plus";
		$_SESSION["theme"] = "theme-light-green";
		$this->load->view("login");
	}
	function session(){
		echo json_encode($_SESSION);
	}
	function verify_login() {
		$post = $this->security->xss_clean($this->input->post());
		$data = $this->data->select_account($post["username"],$post["password"]);
		if (!empty($data)) {
			if($data["active"] == '1'){
				$_SESSION["accountname"] = $data["accountname"];
				$_SESSION["username"] = $data["username"];
				$_SESSION["position"] = $data["position"];
				$_SESSION["clientid"] = $data["clientid"];
				echo 'verified';
			}else{
				echo 'inactive';
			}
		}
		else {
			echo 'denied';
		}
	}
	function homepage(){
		redirect("Page");
	}
	function force_logout() {
		session_destroy();
		redirect("Login");
	}
	// function encrypt_pass(){
	// 	echo md5("client2");
	// }
}
