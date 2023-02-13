<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model("data");
		if(empty($_SESSION["username"])) {
			redirect('login');
		}
	}
	function index()
	{
		redirect("page/home");
	}
	function home()
	{
		$_SESSION["activepage"] = "HOME";
		$this->load->view("home");
	}
	function filezone()
	{
		$_SESSION["activepage"] = "FILEZONE";
		$this->load->view("filezone");
	}
	function select_filezone()
	{
		$post = $this->security->xss_clean($this->input->post());
		if($post["filemonth"] == 'LOADING...'){
			$dateObj   = DateTime::createFromFormat('!m', date('m'));
			$post["filemonth"] = $dateObj->format('F');
		}
		if($post["fileyear"] == 'LOADING...'){
			$post["fileyear"] = date('Y');
		}
		$data["filezone"] = $this->data->select_filezone($post["filemonth"],$post["fileyear"]);
		$this->load->view("filezone_table",$data);
	}
	function select_month()
	{
		$option = "";
		$month = date('m');
		for($x = 1; $x <= 12; $x++)
		{
			$dateObj   = DateTime::createFromFormat('!m', $x);
			$monthName = $dateObj->format('F');
			if ($month == $x) {
				$option .= "<option value='".$monthName."' selected>".strtoupper($monthName)."</option>";
			} else {
				$option .= "<option value='".$monthName."'>".strtoupper($monthName)."</option>";
			}
		}
		echo $option;
	}
	function select_year()
	{
		$option = "";
		$year = date('Y');
		for($x = 1; $x <= 5; $x++)
		{
			$option .= "<option value='".$year."'>".$year."</option>";
			$year = $year - 1;
		}
		echo $option;
	}
	function select_filetype()
	{
		$option = "";
		$res = $this->data->select_filetype();
		$option .= "<option value='0'>Select File Type</option>";
		foreach ($res as $v) {
			$option .= "<option value='".$v["value"]."'>".$v["name"]."</option>";
		}
		echo $option;
	}
	function insert_file()
	{
		$post = $this->security->xss_clean($this->input->post());
		$this->data->insert_file(
			$post["fileName"],
			$post["fileType"],
			$post["fileMonth"],
			$post["fileYear"]
		);
		$this->data->insert_history();
	}
	function update_file()
	{
		$post = $this->security->xss_clean($this->input->post());
		$this->data->update_file(
			$post["fileid"],
			$post["fileName"],
			$post["fileType"],
			$post["fileMonth"],
			$post["fileYear"]
		);
	}
	function upload_file() {
		if (!is_dir('assets/files/'.$_SESSION["username"]))
		{
			mkdir('./assets/files/'.$_SESSION["username"], 0777, true);
			$dir_exist = false; // dir not exist
		}
        $config['upload_path']          = 'assets/files/'.$_SESSION["username"].'/';
        $config['allowed_types']        = '*';
        $config['max_size']             = 20000000;
        $this->load->library('upload', $config);
        $this->upload->do_upload('file_to_upload');
		$res = $this->upload->data();
		$_SESSION["fileName"] = $res["file_name"];
	}
	function get_filezone()
	{
		$post = $this->security->xss_clean($this->input->post());
		$data = $this->data->get_filezone($post["fileid"]);
		echo json_encode($data);
	}
	function get_session()
	{
		$post = $this->security->xss_clean($this->input->post());
		$data = $this->data->get_session($post["session_id"]);
		echo json_encode($data);
	}
	function session_data()
	{
		echo json_encode($_SESSION);
	}
	function force_logout()
	{
		session_destroy();
		redirect("login");
	}
	function consolelog($text)
	{
		echo "<script>console.log('Debug Objects: " . $text . "' );</script>";
	}
}
