<?php 
if(!defined('BASEPATH')) exit ('No direct script access allowed');   

class Data extends CI_Model {
	public function construct()
	{
		parent::__construct();
	}

	public function select_account($username, $password)
	{
		$pmd5 = md5($password);
		return $this->db->query("SELECT * FROM useraccount WHERE username = ? AND password = ?", array($username, $pmd5))->row_array();
	}
	public function select_username($username)
	{
		return $this->db->query("SELECT * FROM useraccount WHERE username = ?", array($username))->row_array();
	}
	public function verify_account($emailcode)
	{
		return $this->db->query("SELECT * FROM useraccount WHERE emailcode = ? AND active = 2", array($emailcode))->row_array();
	}
	public function verify_email($username)
	{
		$q = "UPDATE useraccount SET active=3 WHERE username=?";
		$params = array($username);
		$this->db->query($q, $params);
	}
	public function change_password($username, $password)
	{
		$pmd5 = md5($password);
		$q = "UPDATE useraccount SET password=? WHERE username=?";
		$params = array($pmd5, $username);
		$this->db->query($q, $params);
	}
	public function select_account_list()
	{
		// 1 - Active
		// 0 - Inactive
		// 2 - New
		// 3 - Email Verified
		$q = "SELECT
				u.username,
				u.accountname AS 'Account Name',
				c.clientname AS 'Client Name',
				u.email AS 'Email',
				u.position AS 'Position',
				CASE
					WHEN u.active = 1 THEN 'Active'
					WHEN u.active = 0 THEN 'Inactive'
					WHEN u.active = 3 THEN 'Email Verified'
					ELSE 'New'
				END AS 'Status',
				u.active
			FROM
				useraccount u
			LEFT JOIN
				clients c
			ON
				u.clientid=c.clientid";

		return $this->db->query($q)->result_array();
	}
	public function select_client_list()
	{
		// 1 - Active
		// 0 - Inactive
		$q = "SELECT
				*,
				CASE
					WHEN active = 1 THEN 'Active'
					WHEN active = 0 THEN 'Inactive'
				END AS 'status',
				active
			FROM
				clients";

		return $this->db->query($q)->result_array();
	}
	public function select_checklist()
	{
		// 1 - Active
		// 0 - Inactive
		$q = "SELECT
				*,
				CASE
					WHEN active = 1 THEN 'Active'
					WHEN active = 0 THEN 'Inactive'
				END AS 'status'
			FROM
				checklist";

		return $this->db->query($q)->result_array();
	}
	public function select_fileaudittrail($filemonth, $fileyear, $client, $entity)
	{

	}
	public function select_filelist($filemonth, $fileyear, $entity)
	{
		$q = "SELECT filename FROM filezone a
			WHERE month=? AND year=? AND clientid = ? AND fileentity = ?";
		$params = array($filemonth, $fileyear, $_SESSION["clientid"], $entity);
		return $this->db->query($q,$params)->result_array();
	}
	public function select_filezone($filemonth, $fileyear, $client, $entity)
	{
		if($_SESSION["position"] == "client"){
			$q = "SELECT *, '". $_SESSION["username"] ."' as username FROM filezone a
			LEFT JOIN filehistory b ON a.fileid = b.fileid
			AND b.filedate =
				(
					SELECT MAX(filedate)
					FROM filehistory z
					WHERE z.fileid = b.fileid
				)
				WHERE month=? AND year=? AND clientid = ?
				ORDER BY filedate DESC";
			$params = array($filemonth, $fileyear, $_SESSION["clientid"]);
		}else{
			if ($client == "ALL"){
				$client = "%%";
			}
			if ($entity == "ALL"){
				$entity = "";
			}
			$q = "SELECT a.*, b.*, c.username, d.clientname FROM filezone a
			LEFT JOIN filehistory b ON a.fileid = b.fileid
			AND b.filedate =
				(
					SELECT MAX(filedate)
					FROM filehistory z
					WHERE z.fileid = b.fileid
				)
				LEFT JOIN useraccount c ON a.fileowner = c.username
				LEFT JOIN clients d ON c.clientid = d.clientid
				WHERE month=? AND year=?
				AND c.clientid LIKE '".$client."'
				AND a.fileentity LIKE '%".$entity."%'
				ORDER BY filedate DESC";
			$params = array($filemonth, $fileyear);
		}
		return $this->db->query($q,$params)->result_array();
	}
	public function select_filehistory($fileid)
	{
		$q = "SELECT * FROM filehistory WHERE fileid=?";
		$params = array($fileid);
		return $this->db->query($q,$params)->result_array();
	}
	public function get_filezone($fileid)
	{
		$q="SELECT * FROM filezone WHERE fileid=?";
		$params = array($fileid);
		return $this->db->query($q, $params)->row_array();
	}
	public function get_account($username)
	{
		$q="SELECT * FROM useraccount u LEFT JOIN profile p ON u.username=p.username WHERE u.username=?";
		$params = array($username);
		return $this->db->query($q, $params)->row_array();
	}
	public function get_client($clientid)
	{
		$q="SELECT * FROM clients WHERE clientid=?";
		$params = array($clientid);
		return $this->db->query($q, $params)->row_array();
	}
	public function select_filetype()
	{
		$q = "SELECT * FROM dropdown WHERE category='filezone'";
		return $this->db->query($q)->result_array();
	}
	public function select_client()
	{
		$q = "SELECT clientid, clientname FROM clients WHERE active=1";
		return $this->db->query($q)->result_array();
	}
	public function select_entity($id)
	{
		$q = "SELECT d.*, (SELECT COUNT(*) FROM filezone f WHERE f.fileentity=d.value AND f.clientid=d.subcategory) AS filecount
		FROM dropdown d WHERE category='client' AND subcategory=?";
		$param = array($id);
		return $this->db->query($q,$param)->result_array();
	}
	public function insert_account($username, $accountname, $email, $position, $clientid, $emailcode)
	{
		$q = "INSERT INTO useraccount(username, accountname, email, position, clientid, emailcode, active) VALUES(?,?,?,?,?,?,'2')";
		$params = array($username, $accountname, $email, $position, $clientid, $emailcode);
		$this->db->query($q, $params);
	}
	public function update_account($accountname, $email, $position, $username, $clientname)
	{
		$q = "UPDATE useraccount SET accountname=?, email=?, position=?, clientname=? WHERE username=?";
		$params = array($accountname, $email, $position, $clientname, $username);
		$this->db->query($q, $params);
	}
	public function insert_client($clientname, $address, $industry)
	{
		$q = "INSERT INTO clients(clientname, address, industry, active) VALUES(?,?,?,'1')";
		$params = array($clientname, $address, $industry);
		$this->db->query($q, $params);
	}
	public function insert_entity($clientid, $entity)
	{
		$q = "INSERT INTO dropdown(category, subcategory, value, name, active) VALUES('client',?,?,?,'1')";
		$params = array($clientid, $entity, $entity);
		$this->db->query($q, $params);
	}
	public function delete_entity($value, $subcategory)
	{
		$q = "DELETE FROM dropdown WHERE value=? AND subcategory=?";
		$params = array($value, $subcategory);
		$this->db->query($q, $params);
	}
	public function update_client($clientname, $address, $industry, $clientid)
	{
		$q = "UPDATE clients SET clientname=?, address=?, industry=? WHERE clientid=?";
		$params = array($clientname, $address, $industry, $clientid);
		$this->db->query($q, $params);
	}
	public function update_profile($address, $mobilenumber, $telephonenumber)
	{
		$q = "DELETE FROM profile WHERE username=?";
		$params = array($_SESSION["username"]);
		$this->db->query($q, $params);
		$q = "INSERT INTO profile(address, mobilenumber, telephonenumber, username) VALUES(?,?,?,?)";
		$params = array($address, $mobilenumber, $telephonenumber, $_SESSION["username"]);
		$this->db->query($q, $params);
	}
	public function insert_fileaudittrail($clientid, $fileentity, $month, $year, $updatedby, $trailstatus, $remarks)
	{
		$q = "INSERT INTO fileaudittrail(clientid, fileentity, month, year, updatedby, trailstatus, remarks) VALUES(?,?,?,?,?,?,?)";
		$params = array($clientid, $fileentity, $month, $year, $updatedby, $trailstatus, $remarks);
		$this->db->query($q, $params);
	}
	public function insert_file($filename, $filetype, $month, $year, $fileentity)
	{
		$q = "INSERT INTO filezone(filename, filetype, month, year, fileowner,fileentity,clientid) VALUES(?,?,?,?,?,?,?)";
		$params = array($filename, $filetype, $month, $year,$_SESSION["username"], $fileentity, $_SESSION["clientid"]);
		$this->db->query($q, $params);
	}
	public function update_file($fileid, $filename, $filetype, $month, $year, $fileentity)
	{
		$q = "UPDATE filezone SET filename=?, filetype=?, month=?, year=?, fileentity=? WHERE fileid=?";
		$params = array($filename, $filetype, $month, $year, $fileentity, $fileid);
		$this->db->query($q, $params);
	}
	public function active_account($username, $active)
	{
		$q = "UPDATE useraccount SET active=? WHERE username=?";
		$params = array($active, $username);
		$this->db->query($q, $params);
	}
	public function active_client($clientid, $active)
	{
		$q = "UPDATE clients SET active=? WHERE clientid=?";
		$params = array($active, $clientid);
		$this->db->query($q, $params);
	}
	public function reset_account($username, $genpassword)
	{
		$pmd5 = md5($genpassword);
		$q = "UPDATE useraccount SET password=?, active=1 WHERE username=?";
		$params = array($pmd5, $username);
		$this->db->query($q, $params);
	}
	public function delete_file($fileid)
	{
		$params = array($fileid);
		$q = "DELETE FROM filezone WHERE fileid=?";
		$this->db->query($q, $params);
		$q = "DELETE FROM filehistory WHERE fileid=?";
		$this->db->query($q, $params);
	}
	public function insert_history($status, $fileid, $remarks)
	{
		if($status == "Submitted"){
			$q = "INSERT INTO filehistory
					SELECT MAX(fileid) AS fileid, ? AS filestatus, current_timestamp AS filedate, '' AS remarks, ? AS updatedby FROM filezone";
			$params = array($status, $_SESSION["username"]);
		}else{
			$q = "INSERT INTO filehistory(fileid, filestatus, filedate, remarks, updatedby)
					VALUES(?, ?, current_timestamp, ?, ?)";
			$params = array($fileid, $status, $remarks, $_SESSION["username"]);
		}
		$this->db->query($q, $params);
	}
	public function view_filehistory($fileid)
	{
		$q = "SELECT * FROM filehistory WHERE filestatus='Viewed' AND fileid=?";
		$params = array($fileid);
		return $this->db->query($q, $params)->result_array();
	}
	public function deny_filehistory($fileid)
	{
		$q = "SELECT * FROM filehistory WHERE filestatus='Returned' AND fileid=?";
		$params = array($fileid);
		return $this->db->query($q, $params)->result_array();
	}
	// public function select_session($referral_id){
	// 	$q="SELECT * FROM tbl_session WHERE referral_id=?";
	// 	$params = array($referral_id);
	// 	return $this->db->query($q, $params)->result_array();
	// }
}