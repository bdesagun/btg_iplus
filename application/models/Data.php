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
	public function select_filezone($filemonth, $fileyear)
	{
		$q = "SELECT * FROM filezone a
			LEFT JOIN filehistory b ON a.fileid = b.fileid
			WHERE month=? and year=? AND fileowner = ?
			ORDER BY filedate DESC";
		$params = array($filemonth, $fileyear, $_SESSION["username"]);
		return $this->db->query($q,$params)->result_array();
	}
	public function get_filezone($fileid){
		$q="SELECT * FROM filezone WHERE fileid=?";
		$params = array($fileid);
		return $this->db->query($q, $params)->row_array();
	}
	public function select_filetype()
	{
		$q = "SELECT * FROM dropdown WHERE category='filezone'";
		return $this->db->query($q)->result_array();
	}
	public function insert_file($filename, $filetype, $month, $year)
	{
		$q = "INSERT INTO filezone(filename, filetype, month, year, fileowner) VALUES(?,?,?,?,?)";
		$params = array($filename, $filetype, $month, $year,$_SESSION["username"]);
		$this->db->query($q, $params);
	}
	public function update_file($fileid, $filename, $filetype, $month, $year)
	{
		$q = "UPDATE filezone SET filename=?, filetype=?, month=?, year=? WHERE fileid=?";
		$params = array($filename, $filetype, $month, $year, $fileid);
		$this->db->query($q, $params);
	}
	public function insert_history()
	{
		$q = "INSERT INTO filehistory
				SELECT MAX(fileid) AS fileid, 'submitted' AS filestatus, current_timestamp AS filedate, ? AS updatedby FROM filezone";
		$params = array($_SESSION["username"]);
		$this->db->query($q, $params);
	}
	// public function select_session($referral_id){
	// 	$q="SELECT * FROM tbl_session WHERE referral_id=?";
	// 	$params = array($referral_id);
	// 	return $this->db->query($q, $params)->result_array();
	// }
}