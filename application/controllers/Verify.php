<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verify extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model("data");
		$_SESSION["systemname"] = "BTG Intelligence Plus";
		$_SESSION["theme"] = "theme-light-green";
	}
	function index() {

	}
	function code_verification() {
		$get = $this->security->xss_clean($this->input->get());
		$data = $this->data->verify_account($get["emailcode"]);
		if (!empty($data)) {
			if($data["active"] == '2'){
				$this->data->verify_email($data["username"]);
				$data["vertext"] = "Your email is successfully verified";
			}else{
				$data["vertext"] = "Your email is already verified";
			}
		}
		else {
			$data["vertext"] = "Your link is invalid.";
		}
		//$data["vertext"] = "This is sample message";
		$this->load->view("verification",$data);
	}
	function homepage(){
		redirect("page");
	}
	function force_logout() {
		session_destroy();
		redirect("login");
	}
	// function encrypt_pass(){
	// 	echo md5("client2");
	// }
}
