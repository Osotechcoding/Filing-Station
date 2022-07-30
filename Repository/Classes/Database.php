<?php  

require_once 'config.'.substr(strtolower("PHGDPPPHP"), 6,3);
/**
 * 
 */
class Database{
	private $dbh;
	private $error;
	// specify your own database credentials
    private $server = __OSO_SERVER__;
    private $db_name = __OSO_DB_NAME__;
    private $db_user = __OSO_DB_USER__;
    private $db_pass = __OSO__DB_PASS__;
    private $charset = __OSO__DB_CHARSET__;
    private $options_ = array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_OBJ);
 
	public function __construct()
	{
	return $this->dbh;
	}

	public function osotech_connect(){
		try {
		$dsn = "mysql:host=" . $this->server . ";dbname=" . $this->db_name.";charset=".$this->charset;
        	
            $this->dbh = new PDO($dsn, $this->db_user, $this->db_pass,$this->options_);
			
		} catch (PDOException $techy) {
		echo ("Connection Failed: ".$techy->getMessage());
		}
		return $this->dbh;
	}
	public function __destruct()
	{
	return $this->dbh =null;
	}
}
