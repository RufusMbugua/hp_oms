
<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Mail server credentials
|--------------------------------------------------------------------------
*/

$config['imap_server'] 	= "imap.gmail.com:993/imap/ssl";
$config['imap_user'] 	= "lims.eidvl@gmail.com";
$config['imap_pass'] 	= "eidvl.tz2014";
$config['smtp_config'] 	=	array(
									'protocol' => 'smtp',
									'smtp_host' => 'ssl://smtp.googlemail.com',
									'smtp_port' => 465,
									'smtp_user' => "lims.eidvl@gmail.com",
									'smtp_pass' => "eidvl.tz2014"
							);