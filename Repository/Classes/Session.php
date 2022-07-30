<?php 

/**
 * 
 */
class Session  
{
	
public static function init(){
	if (version_compare(phpversion(), '5.4.0', '<')) {
		//check is no session exist
		if (session_id() == "") {
			// auto start session
			@session_start();
		}
	}else{
		if (session_status() == PHP_SESSION_NONE) {
			// auto start session
			@session_start();
		}
	}
}
//get session value by key
public static function set($k,$v){
	$_SESSION[$k] = $v;
}

public static function create_Cookie($name,$value){
		return setcookie($name,$value,time()+(24*60*60),"/");
	}
	public static function remove_Cookie($name,$value=""){
		return setcookie($name,$value,time()+(1*60),"/");
	}

	public static function set_csrf_token(){
		$_SESSION['CSRF_TOKEN'] =  md5(uniqid(mt_rand(102098,21341009),true));
		return $_SESSION['CSRF_TOKEN'];
	}
	public static function check_admin_token(){
	if (!isset($_SESSION['ADMIN_TOKEN']) || empty($_SESSION['ADMIN_TOKEN'])) {
		self::destroy();
	}
}

public static function check_session_email(){
		if (!isset($_SESSION['ADMIN_EMAIL']) || empty($_SESSION['ADMIN_EMAIL'])) {
		self::destroy();
	}
	}
public static function get($k){
		if (isset($_SESSION[$k])) {
   return $_SESSION[$k];
  } else {
   return false;
  }
	}

public static function destroy(){
		@Session::init();
		@session_destroy();
  header("Location: login");
  exit();
	}

}