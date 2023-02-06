<?php 
if(!defined('BASEPATH')) exit ('No direct script access allowed');   

class Data extends CI_Model {
	public function construct() {
		parent::__construct();
	}

	public function select_account($username, $password){
		$pmd5 = md5($password);
		return $this->db->query("SELECT * FROM useraccount WHERE username = ? AND password = ? AND active = 1", array($username, $pmd5))->row_array();
	}
}