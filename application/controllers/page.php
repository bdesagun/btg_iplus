<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Page extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model("data");
		if (empty($_SESSION["username"])) {
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
	function accounts()
	{
		$_SESSION["activepage"] = "N/A";
		$this->load->view("accounts");
	}
	function select_account_list()
	{
		//$post = $this->security->xss_clean($this->input->post());
		$data["acclist"] = $this->data->select_account_list();
		$this->load->view("accounts_table", $data);
	}
	function select_filezone()
	{
		$post = $this->security->xss_clean($this->input->post());
		$client = "";
		$entity = "";
		if ($post["filemonth"] == 'LOADING...') {
			$dateObj = DateTime::createFromFormat('!m', date('m'));
			$post["filemonth"] = $dateObj->format('F');
		}
		if ($post["fileyear"] == 'LOADING...') {
			$post["fileyear"] = date('Y');
		}
		if (isset($post["client"])) {
			if ($post["client"] == 'LOADING...') {
				$client = "";
			} else {
				$client = $post["client"];
			}
		}
		if (isset($post["entity"])) {
			if ($post["entity"] == 'LOADING...') {
				$entity = "";
			} else {
				$entity = $post["entity"];
			}
		}
		$data["filezone"] = $this->data->select_filezone($post["filemonth"], $post["fileyear"], $client, $entity);
		$this->load->view("filezone_table", $data);
	}
	function select_filehistory()
	{
		$post = $this->security->xss_clean($this->input->post());
		$data["filehistory"] = $this->data->select_filehistory($post["fileid"]);
		$this->load->view("filehistory", $data);
	}
	function select_month()
	{
		$option = "";
		$month = date('m');
		for ($x = 1; $x <= 12; $x++) {
			$dateObj = DateTime::createFromFormat('!m', $x);
			$monthName = $dateObj->format('F');
			if ($month == $x) {
				$option .= "<option value='" . $monthName . "' selected>" . strtoupper($monthName) . "</option>";
			} else {
				$option .= "<option value='" . $monthName . "'>" . strtoupper($monthName) . "</option>";
			}
		}
		echo $option;
	}
	function select_year()
	{
		$option = "";
		$year = date('Y');
		for ($x = 1; $x <= 5; $x++) {
			$option .= "<option value='" . $year . "'>" . $year . "</option>";
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
			$option .= "<option value='" . $v["value"] . "'>" . $v["name"] . "</option>";
		}
		echo $option;
	}
	function select_client()
	{
		$option = "";
		$res = $this->data->select_client();
		$option .= "<option value='ALL'>ALL</option>";
		foreach ($res as $v) {
			$option .= "<option value='" . $v["accountname"] . "'>" . $v["accountname"] . "</option>";
		}
		echo $option;
	}
	function select_entity()
	{
		$post = $this->security->xss_clean($this->input->post());
		$client = "";
		if (isset($post["id"])) {
			$client = $post["id"];
		} else {
			$client = $_SESSION["accountname"];
		}
		$option = "";
		$res = $this->data->select_entity($client);
		if ($_SESSION["position"] != "client") {
			$option .= "<option value='ALL'>ALL</option>";
		}
		foreach ($res as $v) {
			$option .= "<option value='" . $v["value"] . "'>" . $v["name"] . "</option>";
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
			$post["fileYear"],
			$post["fileEntity"]
		);
		$this->data->insert_history("Submitted", "", "");
	}
	function view_filehistory()
	{
		if ($_SESSION["position"] == "staff" || $_SESSION["position"] == "admin") {
			$post = $this->security->xss_clean($this->input->post());
			$data = $this->data->view_filehistory($post["fileid"]);
			if (empty($data)) {
				$this->data->insert_history("Viewed", $post["fileid"], "");
			}
		}
	}
	function approve_file()
	{
		if ($_SESSION["position"] == "staff" || $_SESSION["position"] == "admin") {
			$post = $this->security->xss_clean($this->input->post());
			$this->data->insert_history("Approved", $post["fileid"], "");
		}
	}
	function deny_file()
	{
		if ($_SESSION["position"] == "staff" || $_SESSION["position"] == "admin") {
			$post = $this->security->xss_clean($this->input->post());
			$this->data->insert_history("Returned", $post["fileid"], $post["filereason"]);
		}
	}
	function update_file()
	{
		$post = $this->security->xss_clean($this->input->post());
		$this->data->update_file(
			$post["fileid"],
			$post["fileName"],
			$post["fileType"],
			$post["fileMonth"],
			$post["fileYear"],
			$post["fileEntity"]
		);
		$data = $this->data->deny_filehistory($post["fileid"]);
		if (!empty($data)) {
			$this->data->insert_history("Updated", $post["fileid"], "");
		}
	}
	function upload_file()
	{
		$get = $this->security->xss_clean($this->input->get());
		if (!is_dir('assets/files/' . $_SESSION["username"] . '/' . $get["entity"])) {
			mkdir('./assets/files/' . $_SESSION["username"] . '/' . $get["entity"], 0777, true);
			$dir_exist = false; // dir not exist
		}
		$config['upload_path'] = 'assets/files/' . $_SESSION["username"] . '/' . $get["entity"] . '/';
		$config['allowed_types'] = '*';
		$config['overwrite'] = TRUE;
		$config['max_size'] = 20000000;
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
	function delete_file(){
		$post = $this->security->xss_clean($this->input->post());
		$this->data->delete_file($post["fileid"]);
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