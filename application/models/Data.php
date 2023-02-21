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
		return $this->db->query("SELECT * FROM useraccount WHERE username = ? AND password = ? AND active = 1", array($username, $pmd5))->row_array();
	}
	public function select_account_list()
	{
		$q = "SELECT username AS 'Username', accountname AS 'Account Name', email AS 'Email', position AS 'Position' FROM useraccount";

		return $this->db->query($q)->result_array();
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
				WHERE month=? and year=? AND fileowner = ?
				ORDER BY filedate DESC";
			$params = array($filemonth, $fileyear, $_SESSION["username"]);
		}else{
			if ($client == "ALL"){
				$client = "";
			}
			if ($entity == "ALL"){
				$entity = "";
			}
			$q = "SELECT a.*, b.*, c.username, c.accountname FROM filezone a
			LEFT JOIN filehistory b ON a.fileid = b.fileid
			AND b.filedate =
				(
					SELECT MAX(filedate)
					FROM filehistory z
					WHERE z.fileid = b.fileid
				)
				LEFT JOIN useraccount c ON a.fileowner = c.username
				WHERE month=? AND year=?
				AND c.accountname LIKE '%".$client."%'
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
	public function select_filetype()
	{
		$q = "SELECT * FROM dropdown WHERE category='filezone'";
		return $this->db->query($q)->result_array();
	}
	public function select_client()
	{
		$q = "SELECT accountname FROM useraccount WHERE position='client'";
		return $this->db->query($q)->result_array();
	}
	public function select_entity($id)
	{
		$q = "SELECT * FROM dropdown WHERE category=?";
		$param = array($id);
		return $this->db->query($q,$param)->result_array();
	}
	public function insert_file($filename, $filetype, $month, $year, $fileentity)
	{
		$q = "INSERT INTO filezone(filename, filetype, month, year, fileowner,fileentity) VALUES(?,?,?,?,?,?)";
		$params = array($filename, $filetype, $month, $year,$_SESSION["username"], $fileentity);
		$this->db->query($q, $params);
	}
	public function update_file($fileid, $filename, $filetype, $month, $year, $fileentity)
	{
		$q = "UPDATE filezone SET filename=?, filetype=?, month=?, year=?, fileentity=? WHERE fileid=?";
		$params = array($filename, $filetype, $month, $year, $fileentity, $fileid);
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