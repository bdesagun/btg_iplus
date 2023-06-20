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
	function bashistory()
	{
		$_SESSION["activepage"] = "BASHISTORY";
		$this->load->view("bashistory");
	}
	function sourcedata()
	{
		$_SESSION["activepage"] = "SOURCEDATA";
		$this->load->view("sourcedata");
	}
	function accounts()
	{
		if ($_SESSION["position"] == "admin") {
			$_SESSION["activepage"] = "N/A";
			$this->load->view("accounts");
		}else{
			redirect("Page/home");
		}
	}
	function clients()
	{
		if ($_SESSION["position"] == "admin") {
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
	function audittrail()
	{
		if ($_SESSION["position"] == "admin") {
			$_SESSION["activepage"] = "N/A";
			$this->load->view("audittrail");
		}else{
			redirect("Page/home");
		}
	}
	function email()
	{
		$this->load->view("mail_template/email_sample");
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
	function page_refresh(){
		if($_SESSION["activepage"] == "HOME"){
			redirect("Page/home");
		}
		if($_SESSION["activepage"] == "DASHBOARDS"){
			redirect("Page/dashboards");
		}
		if($_SESSION["activepage"] == "FILEZONE"){
			redirect("Page/filezone");
		}
		if($_SESSION["activepage"] == "BASHISTORY"){
			redirect("Page/bashistory");
		}
		if($_SESSION["activepage"] == "SOURCEDATA"){
			redirect("Page/sourcedata");
		}
	}
	function change_client(){
		$post = $this->security->xss_clean($this->input->post());
		$_SESSION["clientid"] = $post["clientGLobal"];
	}
	function select_clientglobal()
	{
		$option = "";
		$res = $this->data->select_client_all();
		foreach ($res as $v) {
			if($v["clientid"] == $_SESSION["clientid"]){
				$option .= "<option value='" . $v["clientid"] . "'  selected>" . $v["clientname"] . "</option>";
			}else{
				$option .= "<option value='" . $v["clientid"] . "'>" . $v["clientname"] . "</option>";
			}
		}
		echo $option;
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
	function select_bas_progress(){
		$post = $this->security->xss_clean($this->input->post());
		if ($post["filemonth"] == 'LOADING...') {
			$dateObj = DateTime::createFromFormat('!m', date('m'));
			$dateObj->sub(new DateInterval('P1M'));
			$post["filemonth"] = $dateObj->format('F');
		}
		if ($post["fileyear"] == 'LOADING...') {
			$post["fileyear"] = date('Y');
		}
		$option = "";
		$date = strtotime("2nd ".$post["filemonth"]." ".$post["fileyear"]);
		//$date = date("Y-m-t", strtotime($date. '+1 months'));
		$newmonth = strtotime('+1 month', $date);
		$last_date = date("Y-m-t", $newmonth);
		$last_day = date('d', strtotime($last_date));
		$newmonth = DateTime::createFromFormat('!m', date('m', $newmonth));
		for($d = 1; $d <= $last_day; $d ++){
			$option .= "<option value='" . $d . "'>" . sprintf('%02d',$d) . "</option>";
		}
		$data["fileday"] = $option;
		$dateObj = DateTime::createFromFormat('!m', date('m', strtotime($date)));
		$data["progress"] = $this->data->select_bas_progress($post["filemonth"], $post["fileyear"]);
		$data["filemonth"] = $newmonth->format('F');
		$this->load->view("home_table", $data);
	}
	function select_due(){
		$post = $this->security->xss_clean($this->input->post());
		$client = $_SESSION["clientid"];
		if ($post["filemonth"] == 'LOADING...') {
			$dateObj = DateTime::createFromFormat('!m', date('m'));
			$post["filemonth"] = $dateObj->format('F');
		}
		if ($post["fileyear"] == 'LOADING...') {
			$post["fileyear"] = date('Y');
		}
		$data = $this->data->select_due($post["filemonth"], $post["fileyear"], $client);
		echo json_encode($data);
	}
	function save_due(){
		$post = $this->security->xss_clean($this->input->post());
		if ($post["filemonth"] == 'LOADING...') {
			$dateObj = DateTime::createFromFormat('!m', date('m'));
			$post["filemonth"] = $dateObj->format('F');
		}
		if ($post["fileyear"] == 'LOADING...') {
			$post["fileyear"] = date('Y');
		}
		$this->data->save_due(
			$post["filemonth"],
			$post["fileyear"],
			$post["data_request"],
			$post["data_upload"],
			$post["bas_preparation"],
			$post["bas_review"],
			$post["bas_sign_off"],
			$post["bas_lodgement"]
		);
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
	function select_audittrail()
	{
		//$post = $this->security->xss_clean($this->input->post());
		$data["audit"] = $this->data->select_audittrail();
		$this->load->view("audittrail_table", $data);
	}
	function select_filezone()
	{
		$post = $this->security->xss_clean($this->input->post());
		$client = $_SESSION["clientid"];
		$entity = "";
		if ($post["filemonth"] == 'LOADING...') {
			$dateObj = DateTime::createFromFormat('!m', date('m'));
			$post["filemonth"] = $dateObj->format('F');
		}
		if ($post["fileyear"] == 'LOADING...') {
			$post["fileyear"] = date('Y');
		}
		if (isset($post["entity"])) {
			if ($post["entity"] == 'LOADING...') {
				$entity = "";
			} else {
				$entity = $post["entity"];
			}
		}
		$data["filezone"] = $this->data->select_filezone($post["filemonth"], $post["fileyear"], $client, $entity);
		if($_SESSION["activepage"] == "FILEZONE"){
			$this->load->view("filezone_table", $data);
		}
		if($_SESSION["activepage"] == "SOURCEDATA"){
			$this->load->view("sourcedata_table", $data);
		}
	}
	function select_filereview()
	{
		$post = $this->security->xss_clean($this->input->post());
		$client = $_SESSION["clientid"];
		$entity = "";
		if ($post["filemonth"] == 'LOADING...') {
			$dateObj = DateTime::createFromFormat('!m', date('m'));
			$post["filemonth"] = $dateObj->format('F');
		}
		if ($post["fileyear"] == 'LOADING...') {
			$post["fileyear"] = date('Y');
		}
		if (isset($post["entity"])) {
			if ($post["entity"] == 'LOADING...') {
				$entity = "";
			} else {
				$entity = $post["entity"];
			}
		}
		$data["filereview"] = $this->data->select_filereview($post["filemonth"], $post["fileyear"], $client, $entity);
		if($_SESSION["activepage"] == "FILEZONE"){
			$this->load->view("filereview_table", $data);
		}
		if($_SESSION["activepage"] == "BASHISTORY"){
			$this->load->view("bashistory_table", $data);
		}
	}
	function select_filelist()
	{
		$post = $this->security->xss_clean($this->input->post());
		$client = $_SESSION["clientid"];
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
	function select_month_home()
	{
		$option = "";
		$month = date('m');
		for ($x = 1; $x <= 12; $x++) {
			$dateObj = DateTime::createFromFormat('!m', $x);
			$monthName = $dateObj->format('F');
			if ($month == $x + 1) {
				$option .= "<option value='" . $monthName . "' selected>" . strtoupper($monthName) . "</option>";
			} else {
				$option .= "<option value='" . $monthName . "'>" . strtoupper($monthName) . "</option>";
			}
		}
		echo $option;
	}
	function select_year_home()
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
	function select_client_all()
	{
		$option = "";
		$res = $this->data->select_client_all();
		$option .= "<option value='ALL'>ALL</option>";
		foreach ($res as $v) {
			$option .= "<option value='" . $v["clientid"] . "'>" . $v["clientname"] . "</option>";
		}
		echo $option;
	}
	function select_clientname()
	{
		$option = "";
		$res = $this->data->select_client_all();
		$option .= "<option value=''>Select Client</option>";
		foreach ($res as $v) {
			$option .= "<option value='" . $v["clientid"] . "'>" . $v["clientname"] . "</option>";
		}
		echo $option;
	}
	function select_entity()
	{
		$client = $_SESSION["clientid"];
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

	function select_entity_all()
	{
		$post = $this->security->xss_clean($this->input->post());
		$client = $post["id"];
		$option = "";
		$res = $this->data->select_entity_all($client);
		$option .= "<option value='ALL'>ALL</option>";
		foreach ($res as $v) {
			$option .= "<option value='" . $v["entityid"] . "'>" . $v["entityname"] . "</option>";
		}
		echo $option;
	}
	function select_entity_staff()
	{
		$post = $this->security->xss_clean($this->input->post());
		$option = "";
		$res = $this->data->select_entity_staff($post["fileMonth"], $post["fileYear"], $_SESSION["clientid"], $post["trailstatus"]);
		$option .= "<option value=''>Select Entity</option>";
		foreach ($res as $v) {
			$option .= "<option value='" . $v["value"] . "'>" . $v["name"] . "</option>";
		}
		echo $option;
	}
	function select_entity_list()
	{
		$post = $this->security->xss_clean($this->input->post());
		$data["entity"] = $this->data->select_entity_all($post["clientid"]);
		$data["typebas"] = $post["typebas"];
		$this->load->view("maintenance/entity_table", $data);
	}
	function select_group_list()
	{
		$post = $this->security->xss_clean($this->input->post());
		$data["group"] = $this->data->select_group_all($post["clientid"]);
		$this->load->view("maintenance/group_table", $data);
	}
	function select_group()
	{
		$post = $this->security->xss_clean($this->input->post());
		$option = "";
		$res = $this->data->select_group_all($post["clientid"]);
		if($post["typebas"] == 'Mixed'){
			$option .= "<option value='0'>No Group</option>";
		}
		foreach ($res as $v) {
			$option .= "<option value='" . $v["groupid"] . "'>" . $v["groupname"] . "</option>";
		}
		echo $option;
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
		$genpassword = substr(str_shuffle($permitted_chars), 0, 10);
		$post = $this->security->xss_clean($this->input->post());
        $to = $post["email"];
        $subject = 'BTGI Plus Account Reset Password (New User)';
		$data["emailcode"] = $emailcode;
		$uname = $post["username"];
		$upass = $genpassword;
		$post = $this->security->xss_clean($this->input->post());
		$this->data->insert_account(
			$post["username"],
			$post["accountname"],
			$post["email"],
			$post["position"],
			$post["clientid"],
			$data["emailcode"]
		);
		$this->data->reset_account($post["username"], $genpassword);
		$myScript = APPPATH . 'py/email_reset_password.py';
		$output = shell_exec('python3 '.$myScript.' -r "'.$to.'" -s "'.$subject.'" -un "'.$uname.'" -up "'.$upass.'" -l "'.base_url().'index.php/Login/login_screen"');
		$this->data->insert_trail($output);
	}
	function reset_account()
	{
		$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
		$genpassword = substr(str_shuffle($permitted_chars), 0, 10);
		$post = $this->security->xss_clean($this->input->post());
        $to = $post["email"];
        $subject = 'BTGI Plus Account Reset Password';
		$uname = $post["username"];
		$upass = $genpassword;
		$this->data->reset_account($post["username"], $genpassword);
		$myScript = APPPATH . 'py/email_reset_password.py';
		$output = shell_exec('python3 '.$myScript.' -r "'.$to.'" -s "'.$subject.'" -un "'.$uname.'" -up "'.$upass.'" -l "'.base_url().'index.php/Login/login_screen"');
		$this->data->insert_trail($output);
	}
	function update_account()
	{
		$post = $this->security->xss_clean($this->input->post());
		$this->data->update_account(
			$post["accountname"],
			$post["email"],
			$post["position"],
			$post["username"],
			$post["clientid"]
		);
	}
	function insert_client()
	{
		$post = $this->security->xss_clean($this->input->post());
		$this->data->insert_client(
			$post["clientname"],
			$post["address"],
			$post["industry"],
			$post["clientcode"],
			$post["abndetails"],
			$post["gstdetails"],
			$post["website"],
			$post["typebas"],
			$post["filetype"],
			$post["frequency"],
			$post["otherreg"],
			$post["fileother"]
		);
	}
	function insert_entity()
	{
		$post = $this->security->xss_clean($this->input->post());
		$this->data->insert_entity($post["clientid"],$post["entity"],$post["group"]);
	}
	function update_entity()
	{
		$post = $this->security->xss_clean($this->input->post());
		$this->data->update_entity($post["entityid"],$post["entityname"],$post["groupid"]);
	}
	function delete_entity()
	{
		$post = $this->security->xss_clean($this->input->post());
		$this->data->delete_entity($post["entityid"]);
	}
	function insert_group()
	{
		$post = $this->security->xss_clean($this->input->post());
		$this->data->insert_group($post["clientid"],$post["group"]);
	}
	function update_group()
	{
		$post = $this->security->xss_clean($this->input->post());
		$this->data->update_group($post["groupid"],$post["groupname"]);
	}
	function delete_group()
	{
		$post = $this->security->xss_clean($this->input->post());
		$this->data->delete_group($post["groupid"]);
	}
	function update_client()
	{
		$post = $this->security->xss_clean($this->input->post());
		$this->data->update_client(
			$post["clientname"],
			$post["address"],
			$post["industry"],
			$post["clientcode"],
			$post["abndetails"],
			$post["gstdetails"],
			$post["website"],
			$post["typebas"],
			$post["filetype"],
			$post["frequency"],
			$post["otherreg"],
			$post["fileother"],
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
		$client = $_SESSION["clientid"];
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

			$myScript = APPPATH . 'py/email_client_confirm.py';
			$output = shell_exec('python3 '.$myScript.' -r "'.$to.'" -s "'.$subject.'" -cn "'.$data["clientdetail"]["clientname"].'" -en "'.$data["entityname"].'" -an "'.$_SESSION["accountname"].' - '.date('m/d/Y h:i:s', time()).'" -l "'.base_url().'index.php/Login/login_screen"');
			$this->data->insert_trail($output);
		}
		if($post["trailstatus"] == 'Approved'){
			$data = $this->data->select_email_recipient('reviewer', $client, $post["fileEntity"]);
			$data["clientdetail"] = $this->data->get_client($client);
			$data["entityname"] = $post["fileEntity"];
			$to = $data["emails"];
			$subject = 'BTGI Plus Notification';

			$myScript = APPPATH . 'py/email_staff_confirm.py';
			$output = shell_exec('python3 '.$myScript.' -r "'.$to.'" -s "'.$subject.'" -cn "'.$data["clientdetail"]["clientname"].'" -en "'.$data["entityname"].'" -l "'.base_url().'index.php/Login/login_screen"');
			$this->data->insert_trail($output);
		}
		if($post["trailstatus"] == 'Reviewed'){
			$data = $this->data->select_email_recipient('client', $client, '');
			$data["clientdetail"] = $this->data->get_client($client);
			$data["entityname"] = $post["fileEntity"];
			$data["month"] = $post["fileMonth"];
			$data["year"] = $post["fileYear"];
			$to = $data["emails"];
			$subject = 'BTGI Plus Notification';

			$myScript = APPPATH . 'py/email_reviewer_approve.py';
			$output = shell_exec('python3 '.$myScript.' -r "'.$to.'" -s "'.$subject.'" -bm "'.$data["month"].'" -by "'.$data["year"].'" -cn "'.$data["clientdetail"]["clientname"].'" -en "'.$data["entityname"].'" -l "'.base_url().'index.php/Login/login_screen"');
			$this->data->insert_trail($output);
		}
		if($post["trailstatus"] == 'ConfirmedBAS'){
			$data = $this->data->select_email_recipient('staff', $client, $post["fileEntity"]);
			$data["clientdetail"] = $this->data->get_client($client);
			$data["entityname"] = $post["fileEntity"];
			$to = $data["emails"];
			$subject = 'BTGI Plus Notification';

			$myScript = APPPATH . 'py/email_client_approve.py';
			$output = shell_exec('python3 '.$myScript.' -r "'.$to.'" -s "'.$subject.'" -cn "'.$data["clientdetail"]["clientname"].'" -en "'.$data["entityname"].'" -an "'.$_SESSION["accountname"].' - '.date('m/d/Y h:i:s', time()).'" -l "'.base_url().'index.php/Login/login_screen"');
			$this->data->insert_trail($output);
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
			$_SESSION["clientid"],
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
		$this->data->insert_history("Updated", $post["fileid"], "");
	}
	function update_filereview()
	{
		$post = $this->security->xss_clean($this->input->post());
		$this->data->update_filereview(
			$post["fileid"],
			$post["fileName"],
			$_SESSION["clientid"],
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
	function upload_file()
	{
		ob_start();
		$get = $this->security->xss_clean($this->input->get());
		if (!is_dir('assets/files/client_file/' . $_SESSION["clientid"] . '/' . $get["entity"] . '/'. $get["month"] . '/'. $get["year"])) {
			mkdir('./assets/files/client_file/' . $_SESSION["clientid"] . '/' . $get["entity"] . '/'. $get["month"] . '/'. $get["year"], 0777, true);
			$dir_exist = false; // dir not exist
		}
		$config['upload_path'] = 'assets/files/client_file/' . $_SESSION["clientid"] . '/' . $get["entity"] . '/'. $get["month"] . '/'. $get["year"] . '/';
		$config['allowed_types'] = '*';
		$config['overwrite'] = TRUE;
		$config['max_size'] = 150000000;
		$this->load->library('upload', $config);
		$this->upload->do_upload('file_to_upload');
		$res = $this->upload->data();
		$_SESSION["fileName"] = $res["file_name"];
	}
	function upload_file_review()
	{
		ob_start();
		$get = $this->security->xss_clean($this->input->get());
		if (!is_dir('assets/files/btg_file/' . $_SESSION["clientid"] . '/' . $get["entity"] . '/'. $get["month"] . '/'. $get["year"])) {
			mkdir('./assets/files/btg_file/' . $_SESSION["clientid"] . '/' . $get["entity"] . '/'. $get["month"] . '/'. $get["year"], 0777, true);
			$dir_exist = false; // dir not exist
		}
		$config['upload_path'] = 'assets/files/btg_file/' . $_SESSION["clientid"] . '/' . $get["entity"] . '/'. $get["month"] . '/'. $get["year"] . '/';
		$config['allowed_types'] = '*';
		$config['overwrite'] = TRUE;
		$config['max_size'] = 150000000;
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