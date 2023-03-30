<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(
    'protocol' => 'smtp', // 'mail', 'sendmail', or 'smtp'
    'smtp_host' => 'smtp.outlook.office365.com',
    'smtp_port' => 587,
    'smtp_user' => 'dave.tablante@btgi.com.au',
    'smtp_pass' => 'Asd@Qwe#',
    'smtp_crypto' => 'tls', //can be 'ssl' or 'tls' for example
    'mailtype' => 'html', //plaintext 'text' mails or 'html'
    'smtp_timeout' => '30', //in seconds
    'charset' => 'iso-8859-1',
    'wordwrap' => TRUE
);