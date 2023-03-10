<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Page extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model("data");
		$this->load->config('email');
        $this->load->library('email');
		if (empty($_SESSION["username"])) {
			redirect('login');
		}
	}
	function index()
	{
		redirect("Page/home");
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
	function workflow()
	{
		$_SESSION["activepage"] = "WORKFLOW";
		$this->load->view("workflow");
	}
	function dashboards()
	{
		$_SESSION["activepage"] = "DASHBOARDS";
		$this->load->view("dashboards");
	}
	function accounts()
	{
		if ($_SESSION["position"] == "staff" || $_SESSION["position"] == "admin") {
			$_SESSION["activepage"] = "N/A";
			$this->load->view("accounts");
		}else{
			redirect("Page/home");
		}
	}
	function clients()
	{
		if ($_SESSION["position"] == "staff" || $_SESSION["position"] == "admin") {
			$_SESSION["activepage"] = "N/A";
			$this->load->view("clients");
		}else{
			redirect("Page/home");
		}
	}
	function maintenance()
	{
		if ($_SESSION["position"] == "admin") {
			$_SESSION["activepage"] = "N/A";
			$this->load->view("maintenance");
		}else{
			redirect("Page/home");
		}
	}
	function profile()
	{
		$_SESSION["activepage"] = "N/A";
		$this->load->view("profile");
	}
	function change_password() {
		$post = $this->security->xss_clean($this->input->post());
		$data = $this->data->select_account($_SESSION["username"],$post["currentpassword"]);
		if (!empty($data)) {
			$this->data->change_password($_SESSION["username"],$post["newpassword"]);
			echo 'accepted';
		}
		else {
			echo 'denied';
		}
	}
	function select_username(){
		$post = $this->security->xss_clean($this->input->post());
		$data = $this->data->select_username($post["username"]);
		if (!empty($data)) {
			echo 'existing';
		}
		else {
			echo 'available';
		}
	}
	function select_account_list()
	{
		if ($_SESSION["position"] == "staff" || $_SESSION["position"] == "admin") {
			$data["acclist"] = $this->data->select_account_list();
			$this->load->view("accounts_table", $data);
		}else{
			redirect("Page/home");
		}
		//$post = $this->security->xss_clean($this->input->post());
	}
	function select_client_list()
	{
		if ($_SESSION["position"] == "staff" || $_SESSION["position"] == "admin") {
			$data["clients"] = $this->data->select_client_list();
			$this->load->view("clients_table", $data);
		}else{
			redirect("Page/home");
		}
		//$post = $this->security->xss_clean($this->input->post());
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
				$client = "%%";
			} else {
				$client = $post["client"];
			}
		}
		if (isset($post["entity"])) {
			if ($post["entity"] == 'LOADING...') {
				$entity = "%%";
			} else {
				$entity = $post["entity"];
			}
		}
		$data["filezone"] = $this->data->select_filezone($post["filemonth"], $post["fileyear"], $client, $entity);
		$this->load->view("filezone_table", $data);
	}
	function select_filelist()
	{
		$post = $this->security->xss_clean($this->input->post());
		$data["filezone"] = $this->data->select_filelist($post["filemonth"], $post["fileyear"], $post["entity"]);
		$this->load->view("filelist", $data);
	}
	function select_checklist()
	{
		if ($_SESSION["position"] == "admin") {
			$data["checklist"] = $this->data->select_checklist();
			$this->load->view("maintenance/checklist_table", $data);
		}else{
			redirect("Page/home");
		}
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
		$option .= "<option value=''>Select File Type</option>";
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
			$option .= "<option value='" . $v["clientid"] . "'>" . $v["clientname"] . "</option>";
		}
		echo $option;
	}
	function select_clientname()
	{
		$option = "";
		$res = $this->data->select_client();
		$option .= "<option value=''>Select Client</option>";
		foreach ($res as $v) {
			$option .= "<option value='" . $v["clientid"] . "'>" . $v["clientname"] . "</option>";
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
			$client = $_SESSION["clientid"];
		}
		$option = "";
		$res = $this->data->select_entity($client);
		if ($_SESSION["position"] != "client") {
			$option .= "<option value='ALL'>ALL</option>";
		}else{
			$option .= "<option value=''>Select Entity</option>";
		}
		foreach ($res as $v) {
			$option .= "<option value='" . $v["value"] . "'>" . $v["name"] . "</option>";
		}
		echo $option;
	}
	function select_entity_list()
	{
		$post = $this->security->xss_clean($this->input->post());
		$data["entity"] = $this->data->select_entity($post["clientid"]);
		$this->load->view("maintenance/entity_table", $data);
	}
	function insert_account(){
		$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
		$emailcode = substr(str_shuffle($permitted_chars), 0, 30);
		$post = $this->security->xss_clean($this->input->post());
        $to = $post["email"];
        $subject = 'BTGI Plus Email Verification';
		$data["emailcode"] = $emailcode;
        $message = $this->load->view('mail_template/email_verification',$data,true);
        $from = $this->config->item('smtp_user');
		$post = $this->security->xss_clean($this->input->post());
		$this->data->insert_account(
			$post["username"],
			$post["accountname"],
			$post["email"],
			$post["position"],
			$post["clientid"],
			$data["emailcode"]
		);
        $this->email->set_newline("\r\n");
        $this->email->from($from);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);

        if ($this->email->send()) {
            echo 'Your Email has successfully been sent.';
        } else {
            show_error($this->email->print_debugger());
        }
	}
	function update_account()
	{
		$post = $this->security->xss_clean($this->input->post());
		$this->data->update_account(
			$post["accountname"],
			$post["email"],
			$post["position"],
			$post["username"],
			$post["clientname"]
		);
	}
	function insert_client()
	{
		$post = $this->security->xss_clean($this->input->post());
		$this->data->insert_client(
			$post["clientname"],
			$post["address"],
			$post["industry"]
		);
	}
	function insert_entity()
	{
		$post = $this->security->xss_clean($this->input->post());
		$this->data->insert_entity(
			$post["clientid"],
			$post["entity"]
		);
	}
	function delete_entity()
	{
		$post = $this->security->xss_clean($this->input->post());
		$this->data->delete_entity(
			$post["value"],
			$post["subcategory"]
		);
	}
	function update_client()
	{
		$post = $this->security->xss_clean($this->input->post());
		$this->data->update_client(
			$post["clientname"],
			$post["address"],
			$post["industry"],
			$post["clientid"]
		);
	}
	function update_profile()
	{
		$post = $this->security->xss_clean($this->input->post());
		$this->data->update_profile(
			$post["address"],
			$post["mobilenumber"],
			$post["telephonenumber"]
		);
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
	function active_account()
	{
		$post = $this->security->xss_clean($this->input->post());
		$this->data->active_account($post["username"], $post["active"]);
	}
	function active_client()
	{
		$post = $this->security->xss_clean($this->input->post());
		$this->data->active_client($post["clientid"], $post["active"]);
	}
	function reset_account()
	{
		$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
		$genpassword = substr(str_shuffle($permitted_chars), 0, 10);
		$post = $this->security->xss_clean($this->input->post());
        $to = $post["email"];
        $subject = 'BTGI Plus Account Reset Password';
		$data["username"] = $post["username"];
		$data["password"] = $genpassword;
        $message = $this->load->view('mail_template/reset_password_template',$data,true);
        $from = $this->config->item('smtp_user');
		$this->data->reset_account($post["username"], $genpassword);

        $this->email->set_newline("\r\n");
        $this->email->from($from);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);

        if ($this->email->send()) {
            echo 'Your Email has successfully been sent.';
        } else {
            show_error($this->email->print_debugger());
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
	function get_account()
	{
		$post = $this->security->xss_clean($this->input->post());
		$data = $this->data->get_account($post["username"]);
		echo json_encode($data);
	}
	function get_profile()
	{
		$data = $this->data->get_account($_SESSION["username"]);
		echo json_encode($data);
	}
	function get_client()
	{
		$post = $this->security->xss_clean($this->input->post());
		$data = $this->data->get_client($post["clientid"]);
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