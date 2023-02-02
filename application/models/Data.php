<?php 
if(!defined('BASEPATH')) exit ('No direct script access allowed');   

class Data extends CI_Model {
	public function construct() {
		parent::__construct();
	}
	public function select_patient(){
		$q="SELECT * FROM tbl_patient";
		return $this->db->query($q)->result_array();
	}
	public function select_referral($case_number){
		$q="SELECT * FROM tbl_referral WHERE case_number=? ORDER BY referral_date DESC ";
		$params = array($case_number);
		return $this->db->query($q, $params)->result_array();
	}
	public function select_referral_full($initial_contact, $order_date, $clinic, $payment_mode, $admission){
		$con = $initial_contact == 1 ? " initial_contact_status = 0 " : "";
		$ord = $order_date == 1 ? " ORDER BY tr.date_logged DESC " : " ORDER BY tr.referral_date DESC ";
		$and = $con == "" ? "" : " AND ";
		$clinic = $clinic == "All" ? "%%" : $clinic;
		$payment_mode = $payment_mode == "All" ? "%%" : $payment_mode;
		$admission = $admission == "All" ? "%%" : $admission;
		$q="SELECT CONCAT(tp.last_name,', ',tp.first_name) AS full_name, tp.birth_date, tr.*
			FROM tbl_patient tp
			LEFT JOIN tbl_referral tr ON tp.case_number=tr.case_number
			WHERE
			" . $con . $and . "
			(IFNULL(tr.clinic, '') LIKE ?
			AND IFNULL(tr.payment_mode, '') LIKE ?
			AND IFNULL(tr.admission, '') LIKE ?)
			" . $ord;
		$params = array(
			$clinic,
			$payment_mode,
			$admission
		);
		return $this->db->query($q, $params)->result_array();
	}
	public function select_session($referral_id){
		$q="SELECT * FROM tbl_session WHERE referral_id=?";
		$params = array($referral_id);
		return $this->db->query($q, $params)->result_array();
	}
	public function select_session_date($date_from, $date_to, $clinic, $payment_mode, $admission){
		$clinic = $clinic == "All" ? "%%" : $clinic;
		$payment_mode = $payment_mode == "All" ? "%%" : $payment_mode;
		$admission = $admission == "All" ? "%%" : $admission;
		$q="SELECT ts.session_date, tp.last_name, tp.first_name, tp.contact_number, ts.*, tr.clinic, tr.payment_mode, tr.admission
			FROM tbl_session ts
			LEFT JOIN tbl_referral tr ON ts.referral_id=tr.referral_id
			LEFT JOIN tbl_patient tp ON tr.case_number=tp.case_number
			WHERE session_date BETWEEN ? AND ?
			AND (IFNULL(tr.clinic, '') LIKE ?
			AND IFNULL(tr.payment_mode, '') LIKE ?
			AND IFNULL(tr.admission, '') LIKE ?)";
		$params = array(
			date("Y-m-d",strtotime($date_from)),
			date("Y-m-d",strtotime($date_to)),
			$clinic,
			$payment_mode,
			$admission
		);
		return $this->db->query($q, $params)->result_array();
	}
	public function insert_referral($case_number, $referral_date, $date_logged, $referral_link, $special_clinic, $doctor, $diagnosis_code, $full_diagnosis, $clinic, $payment_mode, $admission){
		$q = "INSERT INTO tbl_referral(case_number, referral_date, date_logged, referral_link, special_clinic, doctor, diagnosis_code, full_diagnosis, clinic, payment_mode, admission,initial_contact_status)
							VALUES(?,?,?,?,?,?,?,?,?,?,?,0)";
		$params = array(
			$case_number,
			date("Y-m-d",strtotime($referral_date)),
			date("Y-m-d",strtotime($date_logged)),
			$referral_link,
			$special_clinic,
			$doctor,
			$diagnosis_code,
			$full_diagnosis,
			$clinic,
			$payment_mode,
			$admission
		);
		$this->db->query($q, $params);
	}
	public function insert_patient($case_number,$last_name,$first_name,$contact_number,$gender,$birth_date,$email,$city_municipality,$province,$region){
		$q = "INSERT INTO tbl_patient(case_number,last_name,first_name,contact_number,gender,birth_date,email,city_municipality,province,region)
							VALUES(?,?,?,?,?,?,?,?,?,?)";
		$params = array(
			$case_number,
			$last_name,
			$first_name,
			$contact_number,
			$gender,
			date("Y-m-d",strtotime($birth_date)),
			$email,
			$city_municipality,
			$province,
			$region
		);
		$this->db->query($q, $params);
	}
	public function insert_session($referral_id, $session_date, $attendance, $platform, $new_old_status, $ward, $remarks, $management_id, $splint_id, $amount, $payment_type, $date_paid){
		$q = "INSERT INTO tbl_session(referral_id, session_date, attendance, platform, new_old_status, ward, remarks, management_id, splint_id, amount, payment_type, date_paid)
							VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";
		$params = array(
			$referral_id,
			date("Y-m-d",strtotime($session_date)),
			$attendance,
			$platform,
			$new_old_status,
			$ward,
			$remarks,
			$management_id,
			$splint_id,
			$amount,
			$payment_type,
			date("Y-m-d",strtotime($date_paid))
		);
		$this->db->query($q, $params);
	}
	public function update_referral($case_number, $referral_date, $date_logged, $referral_link, $special_clinic, $doctor, $diagnosis_code, $full_diagnosis, $clinic, $payment_mode, $admission, $referral_id){
		$q = "UPDATE tbl_referral SET case_number=?, referral_date=?, date_logged=?, referral_link=?, special_clinic=?, doctor=?, diagnosis_code=?, full_diagnosis=?, clinic=?, payment_mode=?, admission=?
							WHERE referral_id=?";
		$params = array(
			$case_number,
			date("Y-m-d",strtotime($referral_date)),
			date("Y-m-d",strtotime($date_logged)),
			$referral_link,
			$special_clinic,
			$doctor,
			$diagnosis_code,
			$full_diagnosis,
			$clinic,
			$payment_mode,
			$admission,
			$referral_id
		);
		$this->db->query($q, $params);
	}
	public function update_patient($case_number,$last_name,$first_name,$contact_number,$gender,$birth_date,$email,$city_municipality,$province,$region){
		$q = "UPDATE tbl_patient SET last_name=?,first_name=?,contact_number=?,gender=?,birth_date=?,email=?,city_municipality=?,province=?,region=?
							WHERE case_number=?";
		$params = array(
			$last_name,
			$first_name,
			$contact_number,
			$gender,
			date("Y-m-d",strtotime($birth_date)),
			$email,
			$city_municipality,
			$province,
			$region,
			$case_number
		);
		$this->db->query($q, $params);
	}
	public function update_session($session_date, $attendance, $platform, $new_old_status, $ward, $remarks, $management_id, $splint_id, $amount, $payment_type, $date_paid, $session_id){
		$q = "UPDATE tbl_session SET session_date=?, attendance=?, platform=?, new_old_status=?, ward=?, remarks=?, management_id=?, splint_id=?, amount=?, payment_type=?, date_paid=?
							WHERE session_id=?";
		$params = array(
			date("Y-m-d",strtotime($session_date)),
			$attendance,
			$platform,
			$new_old_status,
			$ward,
			$remarks,
			$management_id,
			$splint_id,
			$amount,
			$payment_type,
			date("Y-m-d",strtotime($date_paid)),
			$session_id
		);
		$this->db->query($q, $params);
	}
	public function update_contact($date_contacted, $date_scheduled, $contact_type, $remarks, $amount, $measurement, $splint_type, $splint_hours, $referral_id){
		$q = "UPDATE tbl_referral SET date_contacted=?, date_scheduled=?, contact_type=?, remarks=?, amount=?, measurement=?, splint_type=?, splint_hours=?, initial_contact_status=1
							WHERE referral_id=?";
		$params = array(
			$date_contacted,
			$date_scheduled,
			$contact_type,
			$remarks,
			$amount,
			$measurement,
			$splint_type,
			$splint_hours,
			$referral_id
		);
		$this->db->query($q, $params);
	}
	public function get_patient($case_id){
		$q="SELECT * FROM tbl_patient WHERE case_number=?";
		$params = array($case_id);
		return $this->db->query($q, $params)->row_array();
	}
	public function get_referral($referral_id){
		$q="SELECT * FROM tbl_referral WHERE referral_id=?";
		$params = array($referral_id);
		return $this->db->query($q, $params)->row_array();
	}
	public function get_session($session_id){
		$q="SELECT * FROM tbl_session WHERE session_id=?";
		$params = array($session_id);
		return $this->db->query($q, $params)->row_array();
	}
}