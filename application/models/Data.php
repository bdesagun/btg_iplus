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
		return $this->db->query(
			"SELECT
				u.*,
				c.clientname,
				(SELECT GROUP_CONCAT(clientid) AS emails FROM userentity WHERE username = ?) AS clientaccess,
				(SELECT GROUP_CONCAT(CONCAT('''', entity, '''' )) AS emails FROM userentity WHERE username = ?) AS entityaccess
			FROM
				useraccount u
			LEFT JOIN clients c ON u.clientid=c.clientid
			WHERE u.username = ? AND u.password = ?", array($username, $username, $username, $pmd5)
		)->row_array();
	}
	public function select_username($username)
	{
		return $this->db->query("SELECT * FROM useraccount WHERE username = ?", array($username))->row_array();
	}
	public function select_iframe()
	{
		return $this->db->query("SELECT * FROM iframe")->result_array();
	}
	public function select_iframe_page($pagename)
	{
		return $this->db->query("SELECT pageurl FROM iframe WHERE pagename = ?", array($pagename))->row_array();
	}
	public function update_iframe($pagename,$pageurl)
	{
		$q = "UPDATE iframe SET pageurl=? WHERE pagename=?";
		$params = array($pageurl,$pagename);
		$this->db->query($q, $params);
	}
	public function select_email_recipient($position,$clientid,$entity)
	{
		if($position != 'client'){
			$params = array($position,$clientid,$entity);
			return $this->db->query("SELECT GROUP_CONCAT(a.email) AS emails FROM useraccount a WHERE a.position = ?
			AND (SELECT COUNT(*) FROM userentity b WHERE b.clientid=? AND b.entity=? AND a.username=b.username) > 0", $params)->row_array();
		}else{
			$params = array($position,$clientid);
			return $this->db->query("SELECT GROUP_CONCAT(a.email) AS emails FROM useraccount a WHERE a.position = ? AND clientid = ?", $params)->row_array();
		}
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
				u.clientid=c.clientid
			ORDER BY accountname";

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
	public function select_access_list($username)
	{
		$q = "SELECT
			a.*,
			b.clientname
		FROM
			userentity a
		LEFT JOIN
			clients b
		ON
			a.clientid = b.clientid
		WHERE
			username=?";
		$params = array($username);
		return $this->db->query($q,$params)->result_array();
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
	public function select_audittrail()
	{
		$q = "SELECT * FROM audittrail ORDER BY updateddate DESC";
		return $this->db->query($q)->result_array();
	}
	public function select_bas_progress($filemonth, $fileyear, $client)
	{
		$filter = "AND b.subcategory =".$_SESSION["clientid"];
		if($client == 'ALL'){
			$client = '%%';
		}
		if($_SESSION["position"] != "client"){
			$filter = "AND b.subcategory IN (".$_SESSION["clientaccess"].") AND b.value IN (".$_SESSION["entityaccess"].")";
		}
		$q = "SELECT
			d.clientname,
			b.value,
			((COUNT(a.entity) * 17) + 10) AS progress,
            CASE
            	WHEN COUNT(a.entity) = 1 THEN CASE WHEN STR_TO_DATE(CONCAT(a.month, ' ', data_upload, ', ', a.year), '%M %d, %Y') >= CURDATE() THEN 'primary' ELSE 'danger' END
            	WHEN COUNT(a.entity) = 2 THEN CASE WHEN STR_TO_DATE(CONCAT(a.month, ' ', bas_preparation, ', ', a.year), '%M %d, %Y') >= CURDATE() THEN 'primary' ELSE 'danger' END
            	WHEN COUNT(a.entity) = 3 THEN CASE WHEN STR_TO_DATE(CONCAT(a.month, ' ', bas_review, ', ', a.year), '%M %d, %Y') >= CURDATE() THEN 'primary' ELSE 'danger' END
            	WHEN COUNT(a.entity) = 4 THEN CASE WHEN STR_TO_DATE(CONCAT(a.month, ' ', bas_sign_off, ', ', a.year), '%M %d, %Y') >= CURDATE() THEN 'primary' ELSE 'danger' END
			END AS 'barcolor'
		FROM dropdown b
		LEFT JOIN clients d ON b.subcategory = d.clientid
		LEFT JOIN fileaudittrail a ON a.clientid = d.clientid AND a.entity = b.value
        	AND a.month = (SELECT x.month FROM filedue x WHERE x.clientid = b.subcategory ORDER BY x.id DESC LIMIT 1)
            AND a.year = (SELECT x.year FROM filedue x WHERE x.clientid = b.subcategory ORDER BY x.id DESC LIMIT 1)
        LEFT JOIN filedue c ON c.clientid = b.subcategory AND c.month = a.month AND c.year = a.year
		WHERE b.category = 'client' AND b.subcategory LIKE ? AND d.clientname != 'null'
		".$filter."
		GROUP BY b.value
        ORDER BY d.clientname";
		$params = array($client);
		return $this->db->query($q,$params)->result_array();
	}
	public function select_due($filemonth, $fileyear, $client)
	{
		$q = "SELECT * FROM filedue a WHERE
			month = (SELECT x.month FROM filedue x WHERE x.clientid = ? ORDER BY x.id DESC LIMIT 1)
			AND year = (SELECT x.year FROM filedue x WHERE x.clientid = ? ORDER BY x.id DESC LIMIT 1)
			AND a.clientid = ?";
		$params = array($client, $client, $client);
		return $this->db->query($q,$params)->row_array();
	}
	public function save_due($filemonth, $fileyear, $data_request, $data_upload, $bas_preparation, $bas_review, $bas_sign_off, $bas_lodgement)
	{
		//SELECT MONTH(STR_TO_DATE('April 3, 2023', '%M %d, %Y'));
		//SELECT STR_TO_DATE('April 3, 2023', '%M %d, %Y');
		$q = "DELETE FROM filedue WHERE clientid IN (".$_SESSION["clientaccess"].") AND month = ? AND year = ?";
		$params = array($filemonth, $fileyear);
		$this->db->query($q, $params);
		//$q = "INSERT INTO filedue(clientid, month, year, data_request, data_upload, bas_preparation, bas_review, bas_sign_off, bas_lodgement) VALUES(?,?,?,?,?,?,?,?,?)";
		$q = "INSERT INTO filedue(clientid, month, year, data_request, data_upload, bas_preparation, bas_review, bas_sign_off, bas_lodgement)
				SELECT clientid, ? AS month, ? AS year, ? AS data_request, ? AS data_upload, ? AS bas_preparation, ? AS bas_review, ? AS bas_sign_off, ? AS bas_lodgement
				FROM clients WHERE clientid IN (".$_SESSION["clientaccess"].")";
		$params = array($filemonth, $fileyear, $data_request, $data_upload, $bas_preparation, $bas_review, $bas_sign_off, $bas_lodgement);
		$this->db->query($q, $params);

		$this->data->insert_trail("Update schedule in home page. Month: ".$filemonth.", Year: ".$fileyear);
	}
	public function select_filelist($filemonth, $fileyear, $client, $entity, $filecategory)
	{
		$q = "SELECT
				filename,
				filestatus,
				CASE
					WHEN filestatus = 'Approved' THEN 'green'
					ELSE 'orange'
				END AS filecolor
			FROM filezone a
			LEFT JOIN filehistory b ON a.fileid = b.fileid
			AND b.filedate =
				(
					SELECT MAX(filedate)
					FROM filehistory z
					WHERE z.fileid = b.fileid
				)
			WHERE month=? AND year=? AND clientid = ? AND fileentity = ? AND filecategory=?";
		$params = array($filemonth, $fileyear, $client, $entity, $filecategory);
		return $this->db->query($q,$params)->result_array();
	}
	public function select_fileaudittrail($filemonth, $fileyear, $client, $entity)
	{
		$q = "SELECT trailstatus FROM fileaudittrail a
			WHERE month=? AND year=? AND clientid = ? AND entity = ? ORDER BY updateddate DESC LIMIT 1";
		$params = array($filemonth, $fileyear, $client, $entity);
		return $this->db->query($q,$params)->row_array();
	}
	public function select_filereview($filemonth, $fileyear, $client, $entity)
	{
		if ($entity == "ALL"){
			$entity = "";
		}
		if($_SESSION["position"] == "client"){
			$q = "SELECT
				a.*,
				b.*,
				'". $_SESSION["username"] ."' as username,
				e.trailstatus,
				e.updateddate
			FROM filezone a
			LEFT JOIN filehistory b ON a.fileid = b.fileid
			AND b.filedate =
				(
					SELECT MAX(filedate)
					FROM filehistory z
					WHERE z.fileid = b.fileid
				)
			LEFT JOIN fileaudittrail e ON
			a.year = e.year
			AND a.month = e.month
			AND a.clientid = e.clientid
			AND a.fileentity = e.entity
			AND e.updateddate =
				(
					SELECT MAX(updateddate)
					FROM fileaudittrail x
					WHERE x.year = e.year
						AND x.month = e.month
						AND x.clientid = e.clientid
						AND x.entity = e.entity
				)
			WHERE a.month=? AND a.year=? AND a.clientid = ?
			AND a.fileentity LIKE '%".$entity."%'
			AND a.filecategory = 'btgfile'
			ORDER BY a.fileEntity, b.filedate DESC";
			$params = array($filemonth, $fileyear, $_SESSION["clientid"]);
		}else{
			if ($client == "ALL"){
				$client = "%%";
				$entity = "";
			}
			$q = "SELECT
				a.*,
				b.*,
				c.username,
				d.clientname,
				e.trailstatus,
				e.updateddate
			FROM filezone a
			LEFT JOIN filehistory b ON a.fileid = b.fileid
			AND b.filedate =
				(
					SELECT MAX(filedate)
					FROM filehistory z
					WHERE z.fileid = b.fileid
				)
			LEFT JOIN fileaudittrail e ON
			a.year = e.year
			AND a.month = e.month
			AND a.clientid = e.clientid
			AND a.fileentity = e.entity
			AND e.updateddate =
				(
					SELECT MAX(updateddate)
					FROM fileaudittrail x
					WHERE x.year = e.year
						AND x.month = e.month
						AND x.clientid = e.clientid
						AND x.entity = e.entity
				)
			LEFT JOIN useraccount c ON
			a.fileowner = c.username
			LEFT JOIN clients d ON
			a.clientid = d.clientid
			WHERE a.month=? AND a.year=?
			AND a.clientid LIKE '".$client."'
			AND a.fileentity LIKE '%".$entity."%'
			AND a.filecategory = 'btgfile'
			AND a.clientid IN (".$_SESSION["clientaccess"].")
			AND a.fileentity IN (".$_SESSION["entityaccess"].")
			ORDER BY a.fileEntity, b.filedate DESC";
			$params = array($filemonth, $fileyear);
		}
		return $this->db->query($q,$params)->result_array();
	}
	public function select_filezone($filemonth, $fileyear, $client, $entity)
	{
		if ($entity == "ALL"){
			$entity = "";
		}
		if($_SESSION["position"] == "client"){
			$q = "SELECT
				a.*,
				b.*,
				'". $_SESSION["username"] ."' as username,
				e.trailstatus,
				CASE
					WHEN filestatus = 'Approved' THEN 'green'
					ELSE 'orange'
				END AS filecolor
			FROM filezone a
			LEFT JOIN filehistory b ON a.fileid = b.fileid
			AND b.filedate =
				(
					SELECT MAX(filedate)
					FROM filehistory z
					WHERE z.fileid = b.fileid
				)
			LEFT JOIN fileaudittrail e ON
			a.year = e.year
			AND a.month = e.month
			AND a.clientid = e.clientid
			AND a.fileentity = e.entity
			AND e.updateddate =
				(
					SELECT MAX(updateddate)
					FROM fileaudittrail x
					WHERE x.year = e.year
						AND x.month = e.month
						AND x.clientid = e.clientid
						AND x.entity = e.entity
				)
			WHERE a.month=? AND a.year=? AND a.clientid = ?
			AND a.fileentity LIKE '%".$entity."%'
			AND a.filecategory = 'clientfile'
			ORDER BY a.fileEntity, b.filedate DESC";
			$params = array($filemonth, $fileyear, $_SESSION["clientid"]);
		}else{
			if ($client == "ALL"){
				$client = "%%";
				$entity = "";
			}
			$q = "SELECT
				a.*,
				b.*,
				c.username,
				d.clientname,
				e.trailstatus,
				CASE
					WHEN filestatus = 'Approved' THEN 'green'
					ELSE 'orange'
				END AS filecolor
			FROM filezone a
			LEFT JOIN filehistory b ON
			a.fileid = b.fileid
			AND b.filedate =
				(
					SELECT MAX(filedate)
					FROM filehistory z
					WHERE z.fileid = b.fileid
				)
            LEFT JOIN fileaudittrail e ON
			a.year = e.year
			AND a.month = e.month
			AND a.clientid = e.clientid
			AND a.fileentity = e.entity
			AND e.updateddate =
				(
					SELECT MAX(updateddate)
					FROM fileaudittrail x
					WHERE x.year = e.year
						AND x.month = e.month
						AND x.clientid = e.clientid
						AND x.entity = e.entity
				)
			LEFT JOIN useraccount c ON
			a.fileowner = c.username
			LEFT JOIN clients d ON
			c.clientid = d.clientid
			WHERE a.month=? AND a.year=?
			AND c.clientid LIKE '".$client."'
			AND a.fileentity LIKE '%".$entity."%'
			AND a.filecategory = 'clientfile'
			AND a.clientid IN (".$_SESSION["clientaccess"].")
			AND a.fileentity IN (".$_SESSION["entityaccess"].")
			ORDER BY a.fileEntity, filedate DESC";
			$params = array($filemonth, $fileyear);
		}
		return $this->db->query($q,$params)->result_array();
	}
	public function select_filehistory($fileid)
	{
		$q = "SELECT a.*, b.accountname FROM filehistory a
			LEFT JOIN useraccount b ON a.updatedby = b.username WHERE a.fileid=?";
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
		$q="SELECT * FROM clients WHERE clientid=? ";
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
		$q = "SELECT clientid, clientname FROM clients WHERE active=1
		AND clientid IN (".$_SESSION["clientaccess"].")";
		return $this->db->query($q)->result_array();
	}
	public function select_client_all()
	{
		$q = "SELECT clientid, clientname FROM clients WHERE active=1";
		return $this->db->query($q)->result_array();
	}
	public function select_entity_all($id)
	{
		$q = "SELECT d.*, (SELECT COUNT(*) FROM filezone f WHERE f.fileentity=d.value AND f.clientid=d.subcategory) AS filecount
		FROM dropdown d WHERE category='client' AND subcategory=?";
		$param = array($id);
		return $this->db->query($q,$param)->result_array();
	}
	public function select_entity($id)
	{
		$access = "";
		if($_SESSION["position"] != 'client'){
			$access = " AND d.subcategory IN (".$_SESSION["clientaccess"].") AND d.value IN (".$_SESSION["entityaccess"].") ";
		}
		$q = "SELECT d.*, (SELECT COUNT(*) FROM filezone f WHERE f.fileentity=d.value AND f.clientid=d.subcategory) AS filecount
		FROM dropdown d WHERE category='client' AND subcategory=?" . $access;
		$param = array($id);
		return $this->db->query($q,$param)->result_array();
	}
	public function select_entity_staff($month, $year, $clientid, $trailstatus)
	{
		$q = "SELECT a.entity AS name, a.entity AS value FROM fileaudittrail a WHERE month=? AND year=? AND clientid=? AND trailstatus=?
			AND (SELECT COUNT(*) FROM fileaudittrail b WHERE month=? AND year=? AND clientid=? AND a.entity=b.entity  AND trailstatus='ConfirmedBAS') = 0
			AND a.clientid IN (".$_SESSION["clientaccess"].") AND a.entity IN (".$_SESSION["entityaccess"].")";
		$param = array($month, $year, $clientid, $trailstatus, $month, $year, $clientid);
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
		$q = "UPDATE useraccount SET accountname=?, email=?, position=?, clientid=? WHERE username=?";
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
	public function insert_access($clientid, $entity, $username)
	{
		if($clientid == 'ALL'){
			$clientid = '%%';
		}
		if($entity == 'ALL'){
			$entity = '%%';
		}
		$q = "DELETE FROM userentity WHERE clientid LIKE ? AND entity LIKE ? AND username=?";
		$params = array($clientid, $entity, $username);
		$this->db->query($q, $params);
		$q = "INSERT INTO userentity(clientid, entity, username, active)
			SELECT a.clientid, b.value, ? AS username, '1' AS active FROM clients a LEFT JOIN dropdown b ON a.clientid=b.subcategory
			WHERE a.clientid LIKE ? AND b.value LIKE ?";
		$params = array($username, $clientid, $entity);
		$this->db->query($q, $params);
	}
	public function delete_access($clientid, $entity, $username)
	{
		$q = "DELETE FROM userentity WHERE clientid=? AND entity=? AND username=?";
		$params = array($clientid, $entity, $username);
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
		$q = "INSERT INTO fileaudittrail(clientid, entity, month, year, updatedby, trailstatus, remarks, updateddate) VALUES(?,?,?,?,?,?,?,CURRENT_TIMESTAMP())";
		$params = array($clientid, $fileentity, $month, $year, $updatedby, $trailstatus, $remarks);
		$this->db->query($q, $params);
	}
	public function insert_file($filename, $filetype, $month, $year, $fileentity)
	{
		$q = "INSERT INTO filezone(filename, filetype, month, year, fileowner,fileentity,clientid,filecategory) VALUES(?,?,?,?,?,?,?,'clientfile')";
		$params = array($filename, $filetype, $month, $year,$_SESSION["username"], $fileentity, $_SESSION["clientid"]);
		$this->db->query($q, $params);
	}
	public function insert_filereview($filename, $clientid, $month, $year, $fileentity)
	{
		$q = "INSERT INTO filezone(filename, month, year, fileowner,fileentity,clientid,filecategory) VALUES(?,?,?,?,?,?,'btgfile')";
		$params = array($filename, $month, $year,$_SESSION["username"], $fileentity, $clientid);
		$this->db->query($q, $params);
	}
	public function update_file($fileid, $filename, $filetype, $month, $year, $fileentity)
	{
		$q = "UPDATE filezone SET filename=?, filetype=?, month=?, year=?, fileentity=? WHERE fileid=?";
		$params = array($filename, $filetype, $month, $year, $fileentity, $fileid);
		$this->db->query($q, $params);
	}
	public function update_filereview($fileid, $filename, $clientid, $month, $year, $fileentity)
	{
		$q = "UPDATE filezone SET filename=?, clientid=?, month=?, year=?, fileentity=? WHERE fileid=?";
		$params = array($filename, $clientid, $month, $year, $fileentity, $fileid);
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
	public function insert_trail($activiy)
	{
		$q = "INSERT INTO audittrail(activity, updatedby, updateddate)
					VALUES(?, ?, current_timestamp)";
		$params = array($activiy, $_SESSION["username"]);
		$this->db->query($q, $params);
	}
	// public function select_session($referral_id){
	// 	$q="SELECT * FROM tbl_session WHERE referral_id=?";
	// 	$params = array($referral_id);
	// 	return $this->db->query($q, $params)->result_array();
	// }
}