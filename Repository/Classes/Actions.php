<?php  

/**
 * 
 */
require_once 'config.'.substr(strtolower("PHGDPPPHP"), 6,3);
require_once 'Session.'.__OSO_EX__;
require_once 'Database.'.__OSO_EX__;
Session::init();
class Actions {
	private $dbh;
	protected $query;
	protected $stmt;
	protected $response;

	public function __construct()
	{
		 if (substr($_SERVER['REQUEST_URI'], -4) == ".php" or (stripos($_SERVER['REQUEST_URI'], ".php")== true)) {
      // send the user to error 503 page
      self::url_redirect_root("404-error");
    
    }
		$Database = new Database;
		$this->dbh = $Database->osotech_connect();
	}
	public function website_root(){
		return APP_URL_ROOT;
	}
	public function url_redirect_root($flink) {
		header("Location: ".self::website_root().$flink);
    exit();
    //"http://localhost/filling-station/". $flink;
	}

	//all the actions on this portal will be here
	public function register($data){
    $fname = self::clean_string($data['fulname']);
    $username = self::clean_string($data['user_name']);
    $email = self::clean_string($data['email']);
    $pass = self::clean_string($data['pass']);
    $pass_conf = self::clean_string($data['pass_conf']);
    $agree_to_term = isset($data['agree_to_term'])? 'on' : '';
    //check agree to terms
    if ($agree_to_term!=="on") {
      // code...
       $this->response = self::alert_msg("You must agree to our terms and condition!","warning");
    }else
    //check if any field is empty
    if (self::isEmptyStr($fname) || self::isEmptyStr($username) ||self::isEmptyStr($email) || self::isEmptyStr($pass) || self::isEmptyStr($pass_conf)) {
     $this->response = self::alert_msg("All fields are Required!","warning");
    }elseif (!self::is_valid_email($email)) {
      // code...
      $this->response = self::alert_msg("Your e-mail format is not supported!","warning");
    }elseif (self::allowed_password_length($pass)) {
      // code...
      $this->response = self::alert_msg("Your password should contains atleast seven character long","warning");
    }elseif (!self::check_two_passwords($pass,$pass_conf)) {
      // code...
      $this->response = self::alert_msg("The two passwords do not matched","warning");
    }elseif (self::check_user_exists("admin_tbl",$email)) {
      // code...user with this email already registered
       $this->response = self::alert_msg("This e-mail ".$email." already exists!","warning");
    }
    else{
//create the new admin
      //create token and hashed pass
     // $token = self::generateRandomTokenWithLenght(20);
      $hash_pass = self::encrypt_user_password($pass);
      $created_at = date("Y-m-d");
      $this->query = "INSERT INTO admin_tbl (admin_name,username,email,pwd,created_at) VALUES (?,?,?,?,?,?);";
      $this->stmt = $this->dbh->prepare($this->query);
      if ($this->stmt->execute(array($fname,$username,$email,$hash_pass,$created_at))) {
       $this->response = self::alert_msg("Account Registered successfully, Please wait..<script>setTimeout(()=>{
          window.location.href='login';
        },4000)</script>","success");
      }else{
        $this->response = self::alert_msg("Oops! Something went wrong, Please try again","warning"); 
      }
    }
    return $this->response;
	}

	public function login($data){
    @Session::init();
    $sess_token = $_SESSION['CSRF_TOKEN'];
    $username = self::clean_string($data['username']);
    $pass = self::clean_string($data['admin_pass']);
    $csrf_token = $data['csrf_token'];
    if ($csrf_token!==$sess_token) {
      // code...
       $this->response = self::alert_msg("warning","You have been denied access to this page. Please check your permissions!","danger");
    }elseif (self::isEmptyStr($username) || self::isEmptyStr($pass)) {
     $this->response = self::alert_msg("Warning","Enter Login Details!","danger");
    }else{
 $this->query = "SELECT * FROM admin_tbl WHERE username=? LIMIT 1";
    $this->stmt = $this->dbh->prepare($this->query);
    $this->stmt->execute(array($username));
    if ($this->stmt->rowCount()==1) {
      $result = $this->stmt->fetch();
      $db_password = $result->pwd;
      //check if password entered match with db pwd 
      if (self::check_two_passwords_hash($pass,$db_password)) {
        if (isset($data['rem']) && $data['rem']==='on') {
          // save details to cookie
          Session::create_Cookie("login_email",$result->email);
          Session::create_Cookie("login_user",$result->username);
        }else{
          Session::remove_Cookie("login_email","");
          Session::remove_Cookie("login_user","");
        }
        $session_token = Session::set_csrf_token();
        $_COOKIE['login_email'] = $result->email;
        $_COOKIE['login_user'] = $result->username;
        Session::set("ADMIN_TOKEN",$session_token);
        Session::set("ADMIN_ID",$result->adminId);
        Session::set("ADMIN_USERNAME",$result->username);
        Session::set("ADMIN_EMAIL",$result->email);
        if (self::check_security_question($result->email)) {
         $this->response = self::alert_msg("Success","Please wait..<script>setTimeout(()=>{
          window.location.href='./';
        },2000)</script>","success"); 
        }else{
 $this->response = self::alert_msg("Success","Please wait..<script>setTimeout(()=>{
          window.location.href='./2fa';
        },2000)</script>","success"); 
        }
      
      }else{
      $this->response =$this->response = self::alert_msg("warning","Invalid Password!","danger"); //Invalid Account Password
      }
    }else{
      // Email Address Not Found or User Details not found
      $this->response =$this->response = self::alert_msg("warning","Invalid account details!","danger");
    }
    }
    return $this->response;
	}

  public function set_2FAuth($data){
    $email = self::clean_string($data['logger']);
    $question = self::clean_string($data['question']);
    $answer = self::clean_string($data['answer']);
    if (self::isEmptyStr($question) || $question =="Choose...") {
      // code...
       $this->response =$this->response = self::alert_msg("warning","Please select security question to continue!","danger");
    }else if(self::isEmptyStr($answer)){
 $this->response =$this->response = self::alert_msg("warning","Please Enter your personal answer!","danger");
    }else{
      //check if detail already existed
      if (self::check_security_question($email)) {
        $this->response =$this->response = self::alert_msg("warning","2Factor Authentication already Exists for $email <a href='login'>Login Here</a>!","danger");
      }else{
        //create the 2fa data
      $this->query ="INSERT INTO two_factor_auth (email,secret_question,secret_answer) VALUES (?,?,?);";
      $this->stmt = $this->dbh->prepare($this->query);
      if ($this->stmt->execute(array($email,$question,$answer))) {
      $this->response = self::alert_msg("Success","Your account is now secured! Please wait..<script>setTimeout(()=>{
          window.location.href='./';
        },2000)</script>","success");
    }else{
$this->response =$this->response =self::alert_msg("Server Error","Something went wrong!","danger");
    }
  
      }
   
  }
   return  $this->response;
}
  public function check_security_question($email){
     $this->query = "SELECT * FROM two_factor_auth WHERE email=? LIMIT 1";
    $this->stmt = $this->dbh->prepare($this->query);
    $this->stmt->execute(array($email));
    if ($this->stmt->rowCount()==1) {
      $fetch_ques =$this->stmt->fetch();
      $this->response = true;
    }else{
      $this->response =false;
    }
    return $this->response;
  }

  public function logout(){
    @Session::init();
    $this->response = @Session::destroy();
  return $this->response;
  }

  //create staff
  public function register_staff($data){
    $name = self::clean_string($data['fullname']);
    $phone = self::clean_string($data['phoneno']);
    $email = self::clean_string($data['email']);
    $address = self::clean_string($data['address']);
    $edu = self::clean_string($data['qualification']);
    $office = self::clean_string($data['designation']);
    //check if any field is empty
    if (self::isEmptyStr($name) || self::isEmptyStr($phone) ||self::isEmptyStr($email) || self::isEmptyStr($address) || self::isEmptyStr($edu) || self::isEmptyStr($office)) {
     $this->response = self::alert_msg("warning","All fields are Required!","warning");
    }elseif (!self::is_valid_email($email)) {
      // code...
      $this->response = self::alert_msg("warning","The Staff e-mail address format is not supported!","warning");
    }elseif (self::check_user_exists("staff_tbl",$email)) {
      // code...user with this email already registered
       $this->response = self::alert_msg("Error","This e-mail ".$email." already Registered!","danger");
    }
    else{
//create Staff ID NO 
      $regNo = self::generateRegistrationNumber("PSMS",5);
      $created_at = date("Y-m-d");
      $this->query = "INSERT INTO staff_tbl (full_name,email,phone,address,designation,qualification,regNo,created_at) VALUES (?,?,?,?,?,?,?,?);";
      $this->stmt = $this->dbh->prepare($this->query);
      if ($this->stmt->execute(array($name,$email,$phone,$address,$office,$edu,$regNo,$created_at))) {
       $this->response = self::alert_msg("Success","Staff Details Saved successfully, Please wait..<script>setTimeout(()=>{
          window.location.reload();
        },2500)</script>","success");
      }else{
        $this->response = self::alert_msg("Error", "Oops! Something went wrong, Please try again","warning"); 
      }
    }
    return $this->response;
  }

  //fetch all staff
  public function get_all_staff(){
     $this->query = "SELECT * FROM `staff_tbl` ORDER BY staff_id DESC";
    $this->stmt = $this->dbh->prepare($this->query);
    $this->stmt->execute();
     if ($this->stmt->rowCount()>0) {
      $this->response = $this->stmt->fetchAll();
    }else{
      $this->response=false;
    }
    return $this->response;
  }

 //fetch single staff by id
  public function get_staff_by_id($staff_id){
     $this->query = "SELECT * FROM `staff_tbl` WHERE staff_id=? LIMIT 1";
    $this->stmt = $this->dbh->prepare($this->query);
    $this->stmt->execute([$staff_id]);
     if ($this->stmt->rowCount()==1) {
      $this->response = $this->stmt->fetch();
      return $this->response;
    }
    
  }

  //fetch single staff by id
  public function get_customer_by_id($cId){
     $this->query = "SELECT * FROM `credit_customer` WHERE cId=? LIMIT 1";
    $this->stmt = $this->dbh->prepare($this->query);
    $this->stmt->execute([$cId]);
     if ($this->stmt->rowCount()==1) {
      $this->response = $this->stmt->fetch();
      return $this->response;
    }
    
  }
  
  public function staff_in_dropdown(){
  $this->response ='';
  $this->query = "SELECT * FROM staff_tbl ORDER BY staff_id ASC";
  $this->stmt= $this->dbh->prepare($this->query);
  $this->stmt->execute();
  if ($this->stmt->rowCount()>0) {
    while ($rows =$this->stmt->fetch()) {
  $this->response.='<option value="'.$rows->staff_id.'">'.$rows->full_name.'</option>';
    }
     return $this->response;
     //$this->dbh = NULL;
  }
}

//CREATE CREDITOR
  public function register_creditor($data){
    $name = self::clean_string($data['fullname']);
    $phone = self::clean_string($data['phone']);
    $email = self::clean_string($data['email']);
    $address = self::clean_string($data['address']);
    $ctype = self::clean_string($data['ctype']);
    //check if any field is empty
    if (self::isEmptyStr($name) || self::isEmptyStr($phone) ||self::isEmptyStr($email) || self::isEmptyStr($address) || self::isEmptyStr($ctype)) {
     $this->response = self::alert_msg("warning","All fields are Required!","warning");
    }elseif (!self::is_valid_email($email)) {
      // code...
      $this->response = self::alert_msg("warning","The Customer e-mail address format is not supported!","warning");
    }elseif (self::check_user_exists("credit_customer",$email)) {
      // code...user with this email already registered
       $this->response = self::alert_msg("Error","This e-mail ".$email." already Registered!","danger");
    }
    else{
      $created_at = date("Y-m-d");
      $this->query = "INSERT INTO credit_customer (name,phone,email,address,user_type,created_at) VALUES (?,?,?,?,?,?);";
      $this->stmt = $this->dbh->prepare($this->query);
      if ($this->stmt->execute(array($name,$phone,$email,$address,$ctype,$created_at))) {
       $this->response = self::alert_msg("Success","Creditor Details Saved successfully, Please wait..<script>setTimeout(()=>{
          window.location.reload();
        },2500)</script>","success");
      }else{
        $this->response = self::alert_msg("Error", "Oops! Something went wrong, Please try again","warning"); 
      }
    }
    return $this->response;
  }

   //fetch all creditors
  public function get_all_creditors(){
     $this->query = "SELECT * FROM `credit_customer` ORDER BY cId DESC";
    $this->stmt = $this->dbh->prepare($this->query);
    $this->stmt->execute();
     if ($this->stmt->rowCount()>0) {
      $this->response = $this->stmt->fetchAll();
    }else{
      $this->response=false;
    }
    return $this->response;
  }

  //fetch single creditor by id
  public function get_creditor_by_id($cId){
     $this->query = "SELECT * FROM `credit_customer` WHERE cId=? LIMIT 1";
    $this->stmt = $this->dbh->prepare($this->query);
    $this->stmt->execute([$cId]);
     if ($this->stmt->rowCount()==1) {
      $this->response = $this->stmt->fetch();
      return $this->response;
    }
    
  }
  public function creditors_in_dropdown(){
  $this->response ='';
  $this->query = "SELECT * FROM credit_customer ORDER BY cId ASC";
  $this->stmt= $this->dbh->prepare($this->query);
  $this->stmt->execute();
  if ($this->stmt->rowCount()>0) {
    while ($rows =$this->stmt->fetch()) {
  $this->response.='<option value="'.$rows->cId.'">'.$rows->name.'</option>';
    }
     return $this->response;
     //$this->dbh = NULL;
  }
}
  //

	public function admin_forgot_password($data){
$email = self::clean_string($data['reseter_email']);
  if (self::isEmptyStr($email)) {
   $this->response = self::alert_msg("warning","Oops! Your email is required to reset your lost password!","danger"); 
  }elseif (!self::is_valid_email($email)) {
    // code...
     $this->response = self::alert_msg("warning","Please enter a valid email address!","danger"); 
  }else{
    //check for this email in the db
    $this->query = "SELECT * FROM admin_tbl WHERE email=? LIMIT 1";
    $this->stmt = $this->dbh->prepare($this->query);
    $this->stmt->execute(array($email));
     if ($this->stmt->rowCount()==1) {
      $get_datas = $this->stmt->fetch();
      //create token to use and token_expire time 
      $reset_token = $this->generateRandomTokenWithLenght(25);
      $reset_email = $get_datas->email;
      // http://localhost/javenist/Eshop/
     $reset_link_url ="http://localhost/filling-station/reset-password?reset-code=$reset_token&reset-email=".self::encrypt_String('code',$reset_email);
     //update admin table
     $this->stmt =$this->dbh->prepare("UPDATE admin_tbl SET access_token='$reset_token',token_expire=DATE_ADD(NOW(), INTERVAL 10 MINUTE) WHERE email='$reset_email' LIMIT 1");
     $this->stmt->execute();
     if ($this->stmt->rowCount()==1) {
    $this->response = self::alert_msg("Success","Reset link has been sent to $reset_email, Link expires in 10 minutes time or  click <a href='".$reset_link_url."'> here</a>","success"); 
     }else{
  $this->response = self::alert_msg("warning","Oops! Something went wrong, Please try again","warning"); 
     }
    }else{
        $this->response = self::alert_msg("Danger","Account with this $email could not be found!, Please check your email and try again!","danger");
    }
  }

    return $this->response;

	}

  //money that was taking to Bank
  public function bank_saving($data){
    $admin_id = self::clean_string($data['adId']);
    $bank = self::clean_string($data['bank_name']);
    $saving_amount = self::clean_string($data['amount_to_bank']);
    $note = self::clean_string($data['note']);
    $date = date("Y-m-d");
    //check for empty space
    if (self::isEmptyStr($admin_id) || self::isEmptyStr($bank) || self::isEmptyStr($saving_amount) || self::isEmptyStr($note)) {
      // code...
       $this->response = self::alert_msg("warning","Oops! All fields are Required!","danger");
    }elseif (!is_numeric($saving_amount)) {
      // code...
       $this->response = self::alert_msg("warning","Oops! Numeric Character is Required!","danger");
    }else{
//check if this amount is already saved earlier
      $this->stmt =$this->dbh->prepare("SELECT * FROM `bank_saving_tbl` WHERE amount=? AND bank=? AND created_at=? LIMIT 1");
      $this->stmt->execute(array($saving_amount,$bank,$date));
      if ($this->stmt->rowCount() ==1) {
        // show that this particular moeny already saved
         $this->response = self::alert_msg("warning","Oops! This Particular Money <b>".number_format($saving_amount,2)."</b> already saved to $bank ealier today!","danger");
      }else{
        //proceed with the saving
         $this->stmt =$this->dbh->prepare("INSERT INTO `bank_saving_tbl` (admin_id,amount,bank,note,created_at) VALUES (?,?,?,?,?);");
     if ( $this->stmt->execute(array($admin_id,$saving_amount,$bank,$note,$date))) {
       // code...
        $this->response = self::alert_msg("Success","Money Saved Successfully, Please wait..<script>setTimeout(()=>{
          window.location.reload();
        },2500)</script>","success");
     }else{
     $this->response = self::alert_msg("warning","Oops! Server Error has Occured Please Try again...!","danger");
     }
      }
    }
    return  $this->response;
  }

  //fetch all money saved into the bank
  public function fetch_all_saved_money(){
     $this->query = "SELECT * FROM `bank_saving_tbl` ORDER BY id DESC";
    $this->stmt = $this->dbh->prepare($this->query);
    $this->stmt->execute();
     if ($this->stmt->rowCount()>0) {
      $this->response = $this->stmt->fetchAll();
    }else{
      $this->response=false;
    }
    return $this->response;
  }

  public function check_user_exists($table,$email){
    if (!self::isEmptyStr($email)) {
      $this->query = "SELECT * FROM {$table} WHERE email=? LIMIT 1";
    $this->stmt = $this->dbh->prepare($this->query);
    $this->stmt->execute(array($email));
    if ($this->stmt->rowCount()==1) {
      $this->response = true;
    }else{
        $this->response = false;
    }
   
    }
     return   $this->response;
  }

	public function admin_reset_password($data){
    $email = self::clean_string($data['user_email']);
    $new_pass = self::clean_string($data['new_pass']);
    $new_pass_conf = self::clean_string($data['new_pass_conf']);
    //check for empty
    if (self::isEmptyStr($new_pass) || self::isEmptyStr($new_pass_conf)) {
      // code...
       $this->response = self::alert_msg("warning","Please Enter your new Pasword!","danger");
    }elseif (!self::check_two_passwords($new_pass,$new_pass_conf)) {
      // code...
      $this->response = self::alert_msg("warning","The two passwords you entered do not match!","danger");
    }else{
      //encrypt the new password
      $new_password = self::encrypt_user_password($new_pass);
      //update the new password and delete token
      $this->stmt =$this->dbh->prepare("UPDATE admin_tbl SET password='$new_password',token='' WHERE email='$email' AND token_expire > NOW() LIMIT 1");
      $this->stmt->execute();
      if ($this->stmt->rowCount()==1) {
        $this->response = self::alert_msg("Success","Password Updated successfully, Please wait..<script>setTimeout(()=>{
          window.location.href='login';
        },2000)</script>","success");
      }else{
         $this->response = self::alert_msg("warning","Oops!, Something went wrong, Try again...","danger");
      }
    }
    return  $this->response;

	}

	public function update_admin_details($data){

	}
  //update staff details 
  public function update_staff_details($data){
    $name = self::clean_string($data['staff_name']);
    $phone = self::clean_string($data['staff_phone']);
    $email = self::clean_string($data['staff_email']);
    $address = self::clean_string($data['staff_address']);
    $edu = self::clean_string($data['education']);
    $office = self::clean_string($data['office']);
    $Id = self::clean_string($data['staff_id']);
    //check if any field is empty
    if (self::isEmptyStr($name) || self::isEmptyStr($phone) ||self::isEmptyStr($email) || self::isEmptyStr($address) || self::isEmptyStr($edu) || self::isEmptyStr($office) || self::isEmptyStr($Id)) {
     $this->response = self::alert_msg("warning","All fields are Required!","warning");
    }elseif (!self::is_valid_email($email)) {
      // code...
      $this->response = self::alert_msg("warning","The Staff e-mail address format is not supported!","warning");
    }else{
//create Staff ID NO 
      $regNo = self::generateRegistrationNumber("PSMS",5);
      $created_at = date("Y-m-d");
      $this->query = "UPDATE staff_tbl SET full_name=?,email=?,phone=?,address=?,designation=?,qualification=? WHERE staff_id=? LIMIT 1;";
      $this->stmt = $this->dbh->prepare($this->query);
      if ($this->stmt->execute(array($name,$email,$phone,$address,$office,$edu,$Id))) {
       $this->response = self::alert_msg("Success","Staff Details Updated Successfully, Please wait..<script>setTimeout(()=>{
          window.location.reload();
        },2500)</script>","success");
      }else{
        $this->response = self::alert_msg("Error", "Oops! Something went wrong, Please try again","warning"); 
      }
    }
    return $this->response;
  }

  //show or not show creditor upload btn
  public function show_creditor_btn():bool{
     $this->query ="SELECT * FROM `sales_remit` WHERE DATE(created)= DATE(CURRENT_DATE())";
      $this->stmt = $this->dbh->prepare($this->query);
       $this->stmt->execute();
       if ($this->stmt->rowCount()>0) {
         // code...
        $this->response= true;
       }else{
        $this->response=false;
       }
       return $this->response;
  }

 //create pump method
  public function create_pump($data){
    $pump_name = self::clean_string($data['pump_name']);
    $pump_code = self::clean_string($data['pcode']);
    $status = self::clean_string($data['pstatus']);
    $fid = self::clean_string($data['fid']);
    $created_at = date("Y-m-d");
    //check if details are null
    if (self::isEmptyStr($pump_name) || self::isEmptyStr($pump_code) || self::isEmptyStr($status) || self::isEmptyStr($fid)) {
      // code...
       $this->response = self::alert_msg("warning","Please enter Pump Details","danger");
    }else{
      //check if pump detail already created
      $this->query ="SELECT * FROM `pumps_tbl` WHERE fuel=? AND pump_desc=? AND pcode=? LIMIT 1";
      $this->stmt = $this->dbh->prepare($this->query);
       $this->stmt->execute(array($fid,$pump_name,$pump_code));
       if ( $this->stmt->rowCount()==1) {
         // code...
         $this->response = self::alert_msg("warning","Oops!, this Pump '$pump_name' already Exists","danger");
       }else{
          $this->query ="INSERT INTO pumps_tbl (fuel,pump_desc,pcode,status,created_at) VALUES (?,?,?,?,?);";
      $this->stmt = $this->dbh->prepare($this->query);
       if ($this->stmt->execute(array($fid,$pump_name,$pump_code,$status,$created_at))) {
         // code...
         $this->response = self::alert_msg("Success","Pump Created successfully, Please wait..<script>setTimeout(()=>{
          window.location.reload();
        },2000)</script>","success");
       }else{
         $this->response = self::alert_msg("warning","Oops!, Server Error Occured! Try again","danger");
       }
       }
    }
    return $this->response;

  }

  //fetch pumps
  public function fetch_all_pumps(){
   
   $this->query = "SELECT * FROM `pumps_tbl` as pt
  INNER JOIN `fuel_tbl` as ft
  ON pt.fuel = ft.fId ORDER BY pt.created_at DESC";
    $this->stmt = $this->dbh->prepare($this->query);
    $this->stmt->execute();
    if ($this->stmt->rowCount() > 0) {
      $this->response = $this->stmt->fetchAll();
    }
  return  $this->response;
  }

  //update pump
  public function update_pump($data){
 $pump_desc = self::clean_string($data['pump_desc']);
    $p_code = self::clean_string($data['code']);
    $pstatus = self::clean_string($data['status']);
    $id = self::clean_string($data['pump_id']);
    $fid = self::clean_string($data['fid']);
    //check if details are null
    if (self::isEmptyStr($pump_desc) || self::isEmptyStr($p_code) || self::isEmptyStr($pstatus) || self::isEmptyStr($fid)) {
      // code...
       $this->response = self::alert_msg("warning","Please enter Pump Details","danger");
    }else{
      //let do the update
      $this->stmt =$this->dbh->prepare("UPDATE pumps_tbl SET fuel=?, pump_desc=?,pcode=?,status=? WHERE pumpId=? LIMIT 1");
      if ($this->stmt->execute(array($fid,$pump_desc,$p_code,$pstatus,$id))) {
        // code...
         $this->dbh =null;
         $this->response = self::alert_msg("Success","Pump Updated successfully, Please wait..<script>setTimeout(()=>{
          window.location.reload();
        },2000)</script>","success");
      }else{
         $this->response = self::alert_msg("warning","Oops!, Server Error Occured! Try again","danger");
      }
    }
    return $this->response;

  }

  //fetch_all Fuel Order 
  public function fetch_all_order(){
  $this->query = "SELECT * FROM `orders` as o
  INNER JOIN `fuel_tbl` as ft
  ON o.fuel= ft.fId ORDER BY o.created_at DESC";
    $this->stmt = $this->dbh->prepare($this->query);
    $this->stmt->execute();
    if ($this->stmt->rowCount() > 0) {
      $this->response = $this->stmt->fetchAll();
    }
  return  $this->response;
   $this->dbh =null;
  }

  //fetch_all Fuel 
  public function fetch_all_fuel(){
       $this->query = "SELECT * FROM `fuel_tbl` ORDER BY fId ASC";
    $this->stmt = $this->dbh->prepare($this->query);
    $this->stmt->execute();
    if ($this->stmt->rowCount() > 0) {
      $this->response = $this->stmt->fetchAll();
    }
  return  $this->response;
   $this->dbh =null;
  }

  //fetch_all Fuel Price
  public function fetch_fuel_price(){
$this->query = "SELECT * FROM `price_control_tbl` as pct
  INNER JOIN `fuel_tbl` as ft
  ON pct.fuel_id = ft.fId ORDER BY pct.id ASC";
    $this->stmt = $this->dbh->prepare($this->query);
    $this->stmt->execute();
    if ($this->stmt->rowCount() > 0) {
      $this->response = $this->stmt->fetchAll();
    }
  return  $this->response;
   $this->dbh =null;
  }

  //fetch all meter allocation Fuel 
  public function fetch_all_allocation(){
    $this->query = "SELECT * FROM `allocate_meter_tbl` as amt
  INNER JOIN `pumps_tbl` as pt
  ON pt.pumpId = amt.pump
  INNER JOIN `fuel_tbl`as ft
  ON ft.fId = amt.fuel_id
  INNER JOIN `staff_tbl`as st
  ON st.staff_id = amt.attendant_id
  WHERE DATE(amt.date)=DATE(CURRENT_DATE())ORDER BY aId ASC";
      /*$this->query = "SELECT * FROM allocate_meter_tbl WHERE DATE(created_at)=DATE(CURRENT_DATE())ORDER BY aId ASC";*/
    $this->stmt = $this->dbh->prepare($this->query);
    $this->stmt->execute();
    if ($this->stmt->rowCount() > 0) {
      $this->response = $this->stmt->fetchAll();
    }else{
       $this->response=null;
    }
  return  $this->response;
   $this->dbh =null;
  }
//SELECT DATE_SUB(CURDATE(), INTERVAL 1 DAY) AS yesterday_date;
  //SELECT DATE_SUB(CURDATE(), INTERVAL 2 MONTH) AS date_two_months_ago;
  //SELECT DATE_ADD(CURDATE(), INTERVAL 1 DAY) AS tomorrow_date;
  //fetch all meter allocation Fuel 
  public function get_all_allocationById($data){
    $aId = self::clean_string($data['Id']);
    if (!self::isEmptyStr($aId)) {
      // Complx Query
  $this->query = "SELECT * FROM `allocate_meter_tbl` as amt
  INNER JOIN `pumps_tbl` as pt
  ON pt.pumpId = amt.pump
  INNER JOIN `fuel_tbl`as ft
  ON ft.fId = amt.fuel_id
  WHERE amt.aId =? LIMIT 1";
    $this->stmt = $this->dbh->prepare($this->query);
    $this->stmt->execute([$aId]);
    if ($this->stmt->rowCount() ==1) {
      $this->response = $this->stmt->fetch();
    }
    }
  return  json_encode($this->response);
   $this->dbh =null;
  }

  //show all sales history
  public function show_sales_history(){
    $this->query = "SELECT * FROM `sales_remit` as sr
  INNER JOIN `pumps_tbl` as pt
  ON pt.pumpId = sr.pump_id
  INNER JOIN `fuel_tbl`as ft
  ON ft.fId = sr.fuel_id
  INNER JOIN `staff_tbl`as st
  ON st.staff_id = sr.staff_id ORDER BY DATE(sr.created) DESC";
   $this->stmt = $this->dbh->prepare($this->query);
    $this->stmt->execute();
    if ($this->stmt->rowCount()>0) {
    $this->response = $this->stmt->fetchAll();
    }else{
      $this->response =false;
    }

    return $this->response;
  }

  //show all credit sales history
  public function show_credit_sales_history(){
    $this->query = "SELECT * FROM `credit_sales` as cs
  INNER JOIN `pumps_tbl` as pt
  ON pt.pumpId = cs.pump_id
  INNER JOIN `fuel_tbl`as ft
  ON ft.fId = cs.fuel_id
  INNER JOIN `staff_tbl`as st
  ON st.staff_id = cs.seller_id
  INNER JOIN `credit_customer`as cc
  ON cc.cId = cs.buyer_id ORDER BY DATE(cs.sold_date) DESC";
   $this->stmt = $this->dbh->prepare($this->query);
    $this->stmt->execute();
    if ($this->stmt->rowCount()>0) {
    $this->response = $this->stmt->fetchAll();
    }else{
      $this->response =false;
    }

    return $this->response;
  }

  //show all sales history
  public function filter_sales_history_by_date($from_date,$to_date){
    if (!self::isEmptyStr($from_date) AND !self::isEmptyStr($to_date)) {
      $from_date =  date("Y-m-d",strtotime($from_date));
      $to_date = date("Y-m-d",strtotime($to_date));
   $this->query = "SELECT * FROM `sales_remit` as sr
  INNER JOIN `pumps_tbl` as pt
  ON pt.pumpId = sr.pump_id
  INNER JOIN `fuel_tbl`as ft
  ON ft.fId = sr.fuel_id
  INNER JOIN `staff_tbl`as st
  ON st.staff_id = sr.staff_id WHERE sr.created BETWEEN ? AND ? ORDER BY sr.created DESC";
   $this->stmt = $this->dbh->prepare($this->query);
    $this->stmt->execute(array($from_date,$to_date));
    if ($this->stmt->rowCount()>0) {
    $this->response = $this->stmt->fetchAll();
    }else{
      $this->response =false;
    }
    }else{
     $this->response =false;
    }
    return $this->response;
  }

  public function submit_sales_details($data){
    $aId = self::clean_string($data['u_aid']);
    $price = self::clean_string($data['u_price']);
    $sId = self::clean_string($data['u_staff']);
    $fId = self::clean_string($data['u_fuel']);
    $pump = self::clean_string($data['u_pump_desc']);
    $before = self::clean_string($data['bfs']);
    $after = self::clean_string($data['afs']);
    $litres =self::clean_string($data['u_litre']);
    $mmk =self::clean_string($data['mmk']);
    $pumpId =self::clean_string($data['u_pump_id']);
    $created_at = date("Y-m-d");
    //check for empty values
    if (self::isEmptyStr($after) || self::isEmptyStr($litres) || self::isEmptyStr($mmk)) {
      $this->response = self::alert_msg("warning","Invalid submission! Please Try again","danger");
    }elseif (!is_numeric($after)) {
      // code...
       $this->response =self::alert_msg("warning","Please enter Numeric Character Value Only","danger");
    }else{
      //update allocate meter 
      $this->stmt =$this->dbh->prepare("UPDATE `allocate_meter_tbl` SET after_sales=?,volume_sold=?,total_amount=? WHERE aId=? AND attendant_id=? AND fuel_id=? LIMIT 1");
      if ($this->stmt->execute(array($after,$litres,$mmk,$aId,$sId,$fId))) {
        // create sales history
        $this->stmt =$this->dbh->prepare("INSERT INTO `sales_remit`(staff_id,pump_id,litre_price,litre_sold,total,fuel_id,created) VALUES (?,?,?,?,?,?,?);");
        if ($this->stmt->execute(array($sId,$pumpId,$price,$litres,$mmk,$fId,$created_at))) {
          // deduct from the current litres  from fuel_tbl
          $fuel_datas = self::get_fuel_by_id($fId);
          $c_ava_fuel = (int)$fuel_datas->litres;
          $ufl =(int)($c_ava_fuel-$litres);
          //update now
          $this->stmt =$this->dbh->prepare("UPDATE `fuel_tbl` SET litres=? WHERE fId=? LIMIT 1");
          if ( $this->stmt->execute(array($ufl,$fId))) {
            $this->dbh =null;
         $this->response = self::alert_msg("Success","Sales Record updated and Submitted successfully, Please wait..<script>setTimeout(()=>{
          window.location.reload();
        },2000)</script>","success");
          }
            
        }else{
    $this->response = self::alert_msg("warning","Oops!, Server Error Occured! Try again","danger");
      }
      }else{
    $this->response = self::alert_msg("warning","Oops!, Server Error Occured! Try again","danger");
      }
    }
    return $this->response;

  }

  //get diesel transaction for previuos day
  public function get_diesel_transaction_today(){
    $this->stmt =$this->dbh->prepare("SELECT sum(`litre_sold`) as litres,sum(`total`) as amount FROM `sales_remit` WHERE fuel_id='2' AND created= DATE(CURRENT_DATE())");
    $this->stmt->execute();
    if ($this->stmt->rowCount()>0) {
      // code...
      $this->response = $this->stmt->fetch();
      return $this->response;
    }
  }
  public function get_gas_transaction_today(){
    $this->stmt =$this->dbh->prepare("SELECT sum(`litre_sold`) as litres,sum(`total`) as amount FROM `sales_remit` WHERE fuel_id='3' AND created= DATE(CURRENT_DATE())");
    $this->stmt->execute();
    if ($this->stmt->rowCount()>0) {
      // code...
      $this->response = $this->stmt->fetch();
      return $this->response;
    }
  }
  public function get_kerosene_transaction_today(){
    $this->stmt =$this->dbh->prepare("SELECT sum(`litre_sold`) as litres,sum(`total`) as amount FROM `sales_remit` WHERE fuel_id='4' AND created= DATE(CURRENT_DATE())");
    $this->stmt->execute();
    if ($this->stmt->rowCount()>0) {
      // code...
      $this->response = $this->stmt->fetch();
      return $this->response;
    }
  }
  //get_petrol_credit_transaction_today

  public function get_petrol_credit_transaction_today(){
    $this->stmt =$this->dbh->prepare("SELECT sum(`litre`) as litres,sum(`amount`) as amount FROM `credit_sales` WHERE fuel_id='1' AND pstatus=0");
    $this->stmt->execute();
    if ($this->stmt->rowCount()>0) {
      // code...
      $this->response = $this->stmt->fetch();
      return $this->response;
    }

  }

   //get_petrol_credit_transaction_today

  public function get_diesel_credit_transaction_today(){
    $this->stmt =$this->dbh->prepare("SELECT sum(`litre`) as litres,sum(`amount`) as amount FROM `credit_sales` WHERE fuel_id='2' AND pstatus=0");
    $this->stmt->execute();
    if ($this->stmt->rowCount()>0) {
      // code...
      $this->response = $this->stmt->fetch();
      return $this->response;
    }

  }

   //get_petrol_credit_transaction_today

  public function get_gas_credit_transaction_today(){
    $this->stmt =$this->dbh->prepare("SELECT sum(`litre`) as litres,sum(`amount`) as amount FROM `credit_sales` WHERE fuel_id='3' AND pstatus=0");
    $this->stmt->execute();
    if ($this->stmt->rowCount()>0) {
      // code...
      $this->response = $this->stmt->fetch();
      return $this->response;
    }

  }

   //get_petrol_credit_transaction_today

  public function get_kerosene_credit_transaction_today(){
    $this->stmt =$this->dbh->prepare("SELECT sum(`litre`) as litres,sum(`amount`) as amount FROM `credit_sales` WHERE fuel_id='4' AND pstatus=0");
    $this->stmt->execute();
    if ($this->stmt->rowCount()>0) {
      // code...
      $this->response = $this->stmt->fetch();
      return $this->response;
    }

  }

  //get total litres and total sales per day
  public function get_petrol_transaction_today(){
    $this->stmt =$this->dbh->prepare("SELECT sum(`litre_sold`) as litres,sum(`total`) as amount FROM `sales_remit` WHERE fuel_id='1' AND created= DATE(CURRENT_DATE())");
    $this->stmt->execute();
    if ($this->stmt->rowCount()>0) {
      // code...
      $this->response = $this->stmt->fetch();
      return $this->response;
    }

  }

   public function update_new_price($data){
    $date = date("Y-m-d");
       if (!self::isEmptyStr($data['fid'])) {
         // count total fuel_type
        for ($i=0; $i < count($data['fid']); $i++) { 
          // code...
          $fId = $data['fid'][$i];
          $Id = $data['id'][$i];
          $old_price = $data['default_price'][$i];
          $price = $data['new_price'][$i];
          //check if empty values 
          if (self::isEmptyStr($old_price) || self::isEmptyStr($price)) {
            // code...
             $this->response =self::alert_msg("warning","Please enter new Price","danger");
          }elseif (!is_numeric($price)) {
           $this->response =self::alert_msg("warning","Please enter Numeric Character Value Only","danger");
          }
          else {
            $price = (int)$price;
            $old_price = (int)$old_price;
            //create price history before updating the currnt price per litre
            $this->query ="INSERT INTO price_control_history (fId,price) VALUES (?,?);";
            $this->stmt=$this->dbh->prepare($this->query);
            if ($this->stmt->execute(array($fId,$old_price))) {
              // then update the price
              $this->stmt =$this->dbh->prepare("UPDATE price_control_tbl SET litre_price=? WHERE fuel_id=? AND id=?");
              if ($this->stmt->execute(array($price,$fId,$Id))) {
                // code...
                 $this->response = self::alert_msg("Success","Price Updated successfully, Please wait..<script>setTimeout(()=>{
          window.location.reload();
        },2000)</script>","success");
              }else{
                $this->response =self::alert_msg("warning","Server Error Encountered! Try again...","danger");
              }
            }
          }
        }

       }else{
        $this->response =self::alert_msg("warning","Please enter the update details","danger");
       }

   $this->dbh =null;
   return $this->response;
  }

  //create_fuel 
  public function create_fuel($data){
    //get fuel by id 
    $fid = self::clean_string($data['fuel']);
    $supplier = self::clean_string($data['supplier']);
    $cost = self::clean_string($data['cost_price']);
    $litres = self::clean_string($data['total_litre']);
    $created_at = date("Y-m-d h:i:s A");
//check if any field is empty
    if (self::isEmptyStr($fid)|| self::isEmptyStr($supplier) || self::isEmptyStr($cost) || self::isEmptyStr($litres)) {
      // code...
       $this->response = self::alert_msg("warning","Please enter Order Details","danger");
    }else{
      $f_data = self::get_fuel_by_id($fid);
      $old_litre = $f_data->litres;
      $newLitres =(int)($old_litre+$litres);
      //first update the litre qty in fuel_tbl then create order history on order tbl
      //update query
      $this->stmt =$this->dbh->prepare("UPDATE `fuel_tbl` SET `litres`=? WHERE fId=? LIMIT 1");
      if ($this->stmt->execute([$newLitres,$fid])) {
        // create order history
        $this->query ="INSERT INTO orders (fuel,litres,supplier,cost_amount,created_at) VALUES (?,?,?,?,?);";
        $this->stmt =$this->dbh->prepare($this->query);
        if ($this->stmt->execute([$fid,$litres,$supplier,$cost,$created_at])) {
         
          $this->response = self::alert_msg("Success","Order Submitted Successfully, Please wait..<script>setTimeout(()=>{
          window.location.reload();
        },2000)</script>","success");
          // code...
        }else{
        $this->response = self::alert_msg("warning","Oops!, Server Error Occured! Try again","danger");
        }
      }else{
        //error occured
        $this->response = self::alert_msg("warning","Oops!,Unknown Error Occured! Try again","danger");
      }

    }
    return $this->response;
 $this->dbh =null;
  }

//get fuel by id 
  public function get_fuel_by_id($fId){
     $this->query ="SELECT * FROM fuel_tbl WHERE fId=$fId LIMIT 1";
  $this->stmt= $this->dbh->prepare($this->query);
  $this->stmt->execute();
  if ($this->stmt->rowCount()==1) {
    // code...
  $this->response = $this->stmt->fetch();
  }else{
$this->response =false;
  }
   return $this->response;
     $this->dbh =null;
  }

   public function fuel_in_dropdown(){
  $this->response ='';
  $this->query = "SELECT * FROM fuel_tbl ORDER BY fId ASC";
  $this->stmt= $this->dbh->prepare($this->query);
  $this->stmt->execute();
  if ($this->stmt->rowCount()>0) {
    while ($rows =$this->stmt->fetch()) {
  $this->response.='<option value="'.$rows->fId.'">'.$rows->fuel_type.'</option>';
    }
     return $this->response;
     //$this->dbh = NULL;
  }
}
//assign_to_duty_pump
public function assign_to_duty_pump($data){
 $pump_id = self::clean_string($data['pump_id']);
 $attendant = self::clean_string($data['attendant']);
 $fuel_price = self::clean_string($data['fuel_price']);
 $fuel_id = self::clean_string($data['fuel_id']);
 $cmr = self::clean_string($data['cmr']);
 $date = date("Y-m-d");
 //check for empty values 
 if (self::isEmptyStr($pump_id) ||self::isEmptyStr($attendant) ||self::isEmptyStr($fuel_price) || self::isEmptyStr($fuel_id) ||self::isEmptyStr($cmr)) {
   // code...
   $this->response = self::alert_msg("warning","Oops!,All fields are required!","danger");
 }elseif (!is_numeric($cmr)) {
   // code...
  $this->response = self::alert_msg("warning","Oops!,Meter Reading required a Numeric Character!","danger");
 }else{
  if (self::check_pump_assignment($attendant,$pump_id,$fuel_id)) {
    // code...
    $this->response = self::alert_msg("warning","Oops!,This Pump already assigned to a staff!","danger");
  }else{
    //create the new sales remit table
  $this->query = "INSERT INTO `allocate_meter_tbl` (attendant_id,pump,fuel_id,before_sales,price_per_litre,`date`) VALUES (?,?,?,?,?,?);";
  $this->stmt=$this->dbh->prepare($this->query);
  if ($this->stmt->execute(array($attendant,$pump_id,$fuel_id,$cmr,$fuel_price,$date))) {
    // code...
     $this->response = self::alert_msg("Success","Data Saved Successfully, Please wait..<script>setTimeout(()=>{
          window.location.reload();
        },2000)</script>","success");
  }else{
    $this->response = self::alert_msg("warning","Oops!, Server Error Occured! Try again","danger");
  }
  }
  
 }
 return $this->response;
 $this->dbh=NULL;
}

//check already assigned staff to duty
public function check_pump_assignment($staff_id,$pump_id,$fuel_id){
  $this->stmt = $this->dbh->prepare("SELECT * FROM `allocate_meter_tbl` WHERE attendant_id=? AND pump=? AND fuel_id=? AND `date`=DATE(CURRENT_DATE()) LIMIT 1");
  $this->stmt->execute(array($staff_id,$pump_id,$fuel_id));
  if ($this->stmt->rowCount()==1) {
    $this->response = true;
  }else{
     $this->response = false;
  }
  return $this->response;
}
//show_fuel_price_byId
public function show_fuel_price_byId($id){
 
  $this->query =  "SELECT * FROM `price_control_tbl` as pc
  INNER JOIN `fuel_tbl` as ft
  ON ft.fId = pc.fuel_id
  INNER JOIN `pumps_tbl`as pt
  ON ft.fId = pt.fuel WHERE pt.pumpId=? LIMIT 1";
  $this->stmt= $this->dbh->prepare($this->query);
  $this->stmt->execute([$id]);
  if ($this->stmt->rowCount()==1) {
    // code...
    $result = $this->stmt->fetch();
    $this->response = json_encode($result); 
  }else{
      $this->response =false;
    }
  return $this->response;
}

//fetch price by fuel type id
public function fetch_fuel_price_byId($fId){
  $this->query =  "SELECT litre_price FROM `price_control_tbl` 
  WHERE fuel_id=? LIMIT 1";
  $this->stmt= $this->dbh->prepare($this->query);
  $this->stmt->execute([$fId]);
  if ($this->stmt->rowCount()==1) {
    $result = $this->stmt->fetch();
    $this->response = $result->litre_price; 
  }else{
    $this->response =false;
    }
  return $this->response;
}
//pumps in dropdwon list
 public function fetch_pumps_in_dropdown(){
  $this->response ='';
  $this->query = "SELECT * FROM `pumps_tbl` ORDER BY pumpId DESC";
  $this->stmt= $this->dbh->prepare($this->query);
  $this->stmt->execute();
  if ($this->stmt->rowCount()>0) {
    $rows =$this->stmt->fetchAll();
    foreach ($rows as $row) {
  echo '<option value="'.$row->pumpId.'">'.$row->pump_desc.' &raquo; '.$row->pcode.'</option>';
    }
  }
}

//upload_credit_sold 
public function upload_credit_sold($data){
  $seller_id = self::clean_string($data['seller_id']);
 $buyer_id = self::clean_string($data['buyer_id']);
 $litre = self::clean_string($data['litre']);
 $fuel_id = self::clean_string($data['fuel_id']);
 $price = self::clean_string($data['price_of_litre']);
 $sold_amount = self::clean_string($data['sold_amount']);
 $pump_id = self::clean_string($data['pump_id']);
 $date = date("Y-m-d");
 //check for empty vals
 if (self::isEmptyStr($seller_id) ||self::isEmptyStr($buyer_id) ||self::isEmptyStr($litre) || self::isEmptyStr($fuel_id) ||self::isEmptyStr($price) ||self::isEmptyStr($sold_amount) || self::isEmptyStr($pump_id)) {
   // code...
  $this->response = self::alert_msg("warning","Oops!,All fields are required!","danger");
 }else{
  //check if this particular details have been uploaded earlier today
   $this->query = "SELECT * FROM `credit_sales` WHERE seller_id=? AND buyer_id=? AND pump_id=? AND fuel_id=? AND sold_date =? LIMIT 1";
  $this->stmt= $this->dbh->prepare($this->query);
  $this->stmt->execute([$seller_id,$buyer_id,$pump_id,$fuel_id,$date]);
  //check returned rows
  if ($this->stmt->rowCount()==1) {
    // throw error...
    $this->response = self::alert_msg("warning","Oops!,This details have already been created!","danger");
  }else{
//create the new credit sales into the db
    $this->query ="INSERT INTO `credit_sales` (seller_id,buyer_id,pump_id,fuel_id,litre,amount,price,sold_date) 
    VALUES (?,?,?,?,?,?,?,?);";
     $this->stmt= $this->dbh->prepare($this->query);
     if ($this->stmt->execute(array($seller_id,$buyer_id,$pump_id,$fuel_id,$litre,$sold_amount,$price,$date))) {
  // get the sales record that has the staff,pump,fuel details
      $this->stmt =$this->dbh->prepare("SELECT * FROM sales_remit WHERE staff_id=? AND pump_id=? AND fuel_id=? AND DATE(created)=? LIMIT 1");
      $this->stmt->execute([$seller_id,$pump_id,$fuel_id,$date]);
      if ($this->stmt->rowCount()==1) {
        $set_data = $this->stmt->fetch();
        $total_sold = $set_data->total;
        $sell_date = $set_data->created;
        $updated_val =(int)($total_sold -$sold_amount);
        //update total sold
        $this->stmt = $this->dbh->prepare("UPDATE sales_remit SET total=? WHERE staff_id=? AND pump_id=? AND fuel_id=? AND created=? LIMIT 1");
        if ( $this->stmt->execute([$updated_val,$seller_id,$pump_id,$fuel_id,$sell_date])) {
          // code...
      $this->response = self::alert_msg("Success","Data Saved Successfully, Please wait..<script>setTimeout(()=>{
          window.location.reload();
        },2000)</script>","success");
        }else{
           $this->response = self::alert_msg("warning","Oops!,Server Error Encountered!","danger");
        }
      }
     }else{
      $this->response = self::alert_msg("warning","Oops!,Server Error Occurred!","danger");
        }
  }

 }
 return  $this->response;
}

//delete customer 
public function delete_customer($cId){
  $this->stmt = $this->dbh->prepare("DELETE FROM credit_customer WHERE cId=? LIMIT 1");
    $this->stmt->execute([$cId]);
    if ($this->stmt->rowCount()==1) {
      $this->stmt = $this->dbh->prepare("DELETE FROM credit_sales WHERE buyer_id=? LIMIT 1");
    if ($this->stmt->execute([$cId])) {
        $this->response = self::alert_msg("Success","Customer Data Deleted Successfully, Please wait..<script>setTimeout(()=>{
          window.location.reload();
        },2000)</script>","success");
    }else{
        $this->response = self::alert_msg("warning","Oops!,Server Error Occurred! Try again","danger");
    }
    }
    return $this->response;
}

  //fetch pump by Id
  public function fetch_pump_byId($id){
  $this->query = "SELECT * FROM `pumps_tbl` as pt
  INNER JOIN `fuel_tbl` as ft
  ON pt.fuel = ft.fId WHERE pt.pumpId=? LIMIT 1";
    $this->stmt = $this->dbh->prepare($this->query);
    $this->stmt->execute([$id]);
    if ($this->stmt->rowCount()==1) {
      $this->response = $this->stmt->fetch();
    }else{
      $this->response =false;
    }
  return  $this->response;
  }

  public function image_upload_details($file){
    $file_name = $file['avatar']['name'];
        $file_size = $file['avatar']['size'];
        $file_temp = $file['avatar']['tmp_name'];
        $div_ = explode('.', $file_name);
        $file_ext = strtolower(end($div_));
        $unique_image = 'admin_'.substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "profiles/".$unique_image;
  }

	public function move_image_to_folder($filename,$destination){
      if (move_uploaded_file($filename, $destination)){
         $this->response =true;
      }else{
        $this->response =false;
      }
      return $this->response;
    }

   public function generateToken(){
    $token = md5(uniqid(mt_rand(102098,2134109),true));
    return $token;
}

	public function allowed_Image_Extension($ext){
    $allowed = array("png","jpg","jpeg");
    $result = in_array($ext, $allowed);
    $this->response = ($result === true)? true : false;
    return $this->response;
  }
  //check valid email
  public function is_valid_email($email){
  $this->response = (filter_var($email,FILTER_VALIDATE_EMAIL) == true) ? true : false;
  return $this->response;
  }
   //check allowed image extension 
  public function allowed_Image_Size($avatar_size){
    $allowed_size = 1000000;//1MB 1000000
    $result = ($avatar_size > $allowed_size);
    $this->response = ($result === true)? true : false;
    return $this->response;
  }

  public function check_two_passwords_hash($password,$db_password){
    $this->response = password_verify($password, $db_password);
    return ($this->response == true)? true : false;
  }

  public function check_two_passwords($password,$confirm_password){
    
    $this->response = ($password === $confirm_password)? true : false;
    return $this->response;
  }

  public function encrypt_user_password($password){
    if (!self::isEmptyStr($password)) {
      $this->response = password_hash($password, PASSWORD_DEFAULT);
      return $this->response;
    }
  }

  //allowed password length
  public function allowed_password_length($pwd){
    if (!self::isEmptyStr($pwd)) {
      // code...
      return (strlen($pwd) <= 6)? true : false;
    }
  }

   //String Conversion
  public function encrypt_String($action,$string){
    $output ="";
    $Encrypt_method ="AES-256-CBC";
    $Secret_key = "ilovemywifeoiza!@iremidesomuch@!)";
    $Secret_iv = "ilovemywifeoiza!";
    $key = hash('sha256',$Secret_key);
    $initialization_vector =substr(hash('sha256',$Secret_iv), 0,16);
    
    if (!self::isEmptyStr($string)) {
      //check the type of action
      if ($action =="code") {
        // encrypt string
        $output = openssl_encrypt($string, $Encrypt_method,$key,0, $initialization_vector);
        $output = base64_encode($output);
      }
      if ($action =="decode") {
        // code...
        $output = base64_decode($string);
        $output= openssl_decrypt($output, $Encrypt_method,$key,0, $initialization_vector);
      }

    }
    return $output;
  }

public function isEmptyStr($str){
 return ($str === "" || empty($str))? true : false;
}

public function generateRandomTokenWithLenght($len){
  $this->response = bin2hex(random_bytes($len));
  return $this->response;
}

public function generateRegistrationNumber($prefix=null,$len){
    $prefix = strtoupper($prefix);
    $token = "";
   // $stringCode = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    //$stringCode .=strtoupper(strrev("abcdefghijklmnopqrstuvwxyz"));
    $stringCode ="1234567890";
    $keyMax = strlen($stringCode);
    $Str =str_shuffle($stringCode);
    for ($i=0; $i < $len; $i++) {
        // code...
        $token.=$Str[random_int(0,$keyMax-1)];
    }
    $this->response = $prefix.$token;
    return $this->response;
 }
	public function clean_string($string){
	if (!self::isEmptyStr($string)) {
  $data = trim($string);
  $data = htmlspecialchars($data);
  $data = stripcslashes($data);
  $data = filter_var($data,FILTER_SANITIZE_STRING);
  $this->response = $data;
  return $this->response;
	}

		}
    //check user who is reseting pass
  public function check_password_reset_code($reset_code,$reset_email){
     if (!self::isEmptyStr($reset_code) && !self::isEmptyStr($reset_email)) {
      $this->query = "SELECT * FROM `admin_tbl` WHERE token='$reset_code' AND email='$reset_email' AND token <>'' AND token_expire > NOW() LIMIT 1";
    $this->stmt = $this->dbh->prepare($this->query);
    $this->stmt->execute();
    if ($this->stmt->rowCount()==1) {
      $this->response = true;
    }else{
    $this->response = false;
    }
   return $this->response;
    }
    }

    public function send_reset_link($data){

    }

    public function alert_msg($title="",$msg="",$type="danger"){
      return '<div class="text-center"><div class="alert alert-'.$type.' alert-dismissible fade show" role="alert">
              <strong>'.$title.': </strong> '.$msg.'
            </div></div>';
    }
}

$Actions = new Actions();