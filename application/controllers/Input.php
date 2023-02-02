<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Input extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model("data");
		// if(empty($_SESSION["username"])) {
		// 	redirect('login');
		// }
	}
	function index() {
		redirect("input/mainpage");
	}
	function mainpage() {
		$_SESSION["systemname"] = "OTala Occupational Therapy Database Management System";
		$_SESSION["theme"] = "theme-light-green";
		$this->load->view("blankpage");
	}
	function get_session(){
		$post = $this->security->xss_clean($this->input->post());
		$data = $this->data->get_session($post["session_id"]);
		echo json_encode($data);
	}
	function session_data(){
		echo json_encode($_SESSION);
	}
}
