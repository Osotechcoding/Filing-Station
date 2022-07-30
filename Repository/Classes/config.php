<?php 
//DO NOT UPDATE THIS FUNCTION!!!
include_once 'default_user.'.substr(strtolower("PHGDPPPHP"), 6,3);
if (!defined('OSOTEC_DEV_SOFT')) {
define('OSOTEC_DEV_SOFT', 'osotech software inc');
define('__APP_KEY__', 'DO78-ZX65-QA0U-97LM-WES4');
if (OSOTEC_DEV_SOFT===strtolower(__DEFAULT__U)) {
	define('__OSO_SERVER__', '127.0.0.1');
	define('__OSO_DB_NAME__', 'petrol_station');
	define('__OSO_DB_USER__', 'root');
	define('__OSO__DB_PASS__', 'osotech');
	define('__OSO__DB_CHARSET__', 'utf8mb4');
	define('__APP_NAME__', 'Petrol Station Management');
	define('__APP_VERSION__', 'v1.0.1');
	define('__APP_DEV_YEAR', '2022');
	define("APP_URL_ROOT",'http://127.0.0.1/filling-station/');
	define("__OSO_EX__", substr(strtolower("PHGDPPPHP"), 6,3));
}else{
	echo ('<h3 style="color:tomato;font-size:45px;font-weight:bolder;margin-top:50px"> Access is Denied Please call this number for more details <small style="color:darkred;"> 08131374443</small><br/> <a href="https://businessapp.com.ng/app-enquiry?app_key='.md5(__APP_KEY__).'" target="_blank">Click here to Visit our Official Website</a></h3>');
	die();
}
	
}