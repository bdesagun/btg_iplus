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
		$data = $this->data->select_iframe_page('Workflow');
		$this->load->view("workflow",$data);
	}
	function dashboards()
	{
		$_SESSION["activepage"] = "DASHBOARDS";
		$data = $this->data->select_iframe_page('Dashboard');
		$this->load->view("dashboards",$data);
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
			$data["iframe"] = $this->data->select_iframe();
			$this->load->view("maintenance", $data);
		}else{
			redirect("Page/home");
		}
	}
	function update_iframe(){
		$post = $this->security->xss_clean($this->input->post());
		$this->data->update_iframe($post["pagename"],$post["pageurl"]);
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
				$entity = "";
			} else {
				$entity = $post["entity"];
			}
		}
		if($_SESSION["position"] == "client"){
			$client = $_SESSION["clientid"];
		}
		$data["filezone"] = $this->data->select_filezone($post["filemonth"], $post["fileyear"], $client, $entity);
		$this->load->view("filezone_table", $data);
	}
	function select_filereview()
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
				$entity = "";
			} else {
				$entity = $post["entity"];
			}
		}
		if($_SESSION["position"] == "client"){
			$client = $_SESSION["clientid"];
		}
		$data["filereview"] = $this->data->select_filereview($post["filemonth"], $post["fileyear"], $client, $entity);
		$this->load->view("filereview_table", $data);
	}
	function select_filelist()
	{
		$post = $this->security->xss_clean($this->input->post());
		$client = "";
		if (isset($post["clientid"])) {
			$client = $post["clientid"];
		}else{
			$client = $_SESSION["clientid"];
		}
		$data["filezone"] = $this->data->select_filelist($post["filemonth"], $post["fileyear"], $client, $post["entity"], $post["filecategory"]);
		$data["fileaudit"] = $this->data->select_fileaudittrail($post["filemonth"], $post["fileyear"], $client, $post["entity"]);
		$data["filecategory"] = $post["filecategory"];
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
	function select_entity_staff()
	{
		$post = $this->security->xss_clean($this->input->post());
		$option = "";
		$res = $this->data->select_entity_staff($post["fileMonth"], $post["fileYear"], $post["clientid"], $post["trailstatus"]);
		$option .= "<option value=''>Select Entity</option>";
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
	function select_access_list()
	{
		$post = $this->security->xss_clean($this->input->post());
		$data["access"] = $this->data->select_access_list($post["username"]);
		$this->load->view("maintenance/access_table", $data);
	}
	function insert_access(){
		$post = $this->security->xss_clean($this->input->post());
		$this->data->insert_access(
			$post["clientid"],
			$post["entity"],
			$post["username"]
		);
	}
	function delete_access(){
		$post = $this->security->xss_clean($this->input->post());
		$this->data->delete_access(
			$post["clientid"],
			$post["entity"],
			$post["username"]
		);
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
	function insert_fileaudittrail()
	{
		//($clientid, $fileentity, $month, $year, $updatedby, $trailstatus, $remarks)
		$post = $this->security->xss_clean($this->input->post());
		$client = "";
		if (isset($post["clientid"])) {
			$client = $post["clientid"];
		}else{
			$client = $_SESSION["clientid"];
		}

		$this->data->insert_fileaudittrail(
			$client,
			$post["fileEntity"],
			$post["fileMonth"],
			$post["fileYear"],
			$_SESSION["username"],
			$post["trailstatus"],
			$post["trailstatus"]
		);
		if($post["trailstatus"] == 'Confirmed'){
			$data = $this->data->select_email_recipient('staff', $client, $post["fileEntity"]);
			$data["clientdetail"] = $this->data->get_client($client);
			$data["entityname"] = $post["fileEntity"];
			$to = $data["emails"];
			$subject = 'BTGI Plus Notification';
			$message = $this->load->view('mail_template/email_client_confirm',$data,true);
			$from = $this->config->item('smtp_user');

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
		if($post["trailstatus"] == 'Approved'){
			$data = $this->data->select_email_recipient('reviewer', $client, $post["fileEntity"]);
			$data["clientdetail"] = $this->data->get_client($client);
			$data["entityname"] = $post["fileEntity"];
			$to = $data["emails"];
			$subject = 'BTGI Plus Notification';
			$message = $this->load->view('mail_template/email_staff_confirm',$data,true);
			$from = $this->config->item('smtp_user');

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
		if($post["trailstatus"] == 'Reviewed'){
			$data = $this->data->select_email_recipient('client', $client, '');
			$data["clientdetail"] = $this->data->get_client($client);
			$data["entityname"] = $post["fileEntity"];
			$data["month"] = $post["fileMonth"];
			$data["year"] = $post["fileYear"];
			$to = $data["emails"];
			$subject = 'BTGI Plus Notification';
			$message = $this->load->view('mail_template/email_reviewer_approve',$data,true);
			$from = $this->config->item('smtp_user');

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
		if($post["trailstatus"] == 'ConfirmedBAS'){
			$data = $this->data->select_email_recipient('staff', $client, $post["fileEntity"]);
			$data["clientdetail"] = $this->data->get_client($client);
			$data["entityname"] = $post["fileEntity"];
			$data["month"] = $post["fileMonth"];
			$data["year"] = $post["fileYear"];
			$to = $data["emails"];
			$subject = 'BTGI Plus Notification';
			$message = $this->load->view('mail_template/email_client_approve',$data,true);
			$from = $this->config->item('smtp_user');

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
	function insert_filereview()
	{
		$post = $this->security->xss_clean($this->input->post());
		$this->data->insert_filereview(
			$post["fileName"],
			$post["clientid"],
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
	function update_filereview()
	{
		$post = $this->security->xss_clean($this->input->post());
		$this->data->update_filereview(
			$post["fileid"],
			$post["fileName"],
			$post["clientid"],
			$post["fileMonth"],
			$post["fileYear"],
			$post["fileEntity"]
		);
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
	function upload_file_review()
	{
		$get = $this->security->xss_clean($this->input->get());
		if (!is_dir('assets/files/' . $get["clientid"] . '/' . $get["entity"])) {
			mkdir('./assets/files/' . $get["clientid"] . '/' . $get["entity"], 0777, true);
			$dir_exist = false; // dir not exist
		}
		$config['upload_path'] = 'assets/files/' . $get["clientid"] . '/' . $get["entity"] . '/';
		$config['allowed_types'] = '*';
		$config['overwrite'] = TRUE;
		$config['max_size'] = 20000000;
		$this->load->library('upload', $config);
		$this->upload->do_upload('file_to_upload_review');
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