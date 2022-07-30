<?php 
require_once "Repository/Classes/Session.php";
require_once "Repository/Classes/Actions.php";
@Session::init();
@Session::check_session_email();
?>
<!doctype html>
<html lang="en">

<head>

<meta charset="utf-8" />
<title>2FA | PSMS</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
<meta content="Themesbrand" name="author" />
<!-- App favicon -->
<link rel="shortcut icon" href="asset/images/favicon.ico">
<!-- vendor css -->
<link rel="stylesheet" href="assets/css/style.css">
<!-- owl.carousel css -->

<!-- Bootstrap Css -->
<link href="asset/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="asset/css/icons.min.css" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="asset/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body class="auth-body-bg">

<div>
<div class="container-fluid p-0">
<div class="row g-0">

<div class="col-xl-8 col-lg-8" style="background: url('asset/bg2.jpg');
background-repeat: no-repeat; background-position: center; background-size: cover;">
<div class="auth-full-bg pt-lg-5 p-4">
<div class="w-100">
<div class="bg-overlay"></div>
<div class="d-flex h-100 flex-column">
  <h1 class="text-white text-center">PETROL STATION MANAGEMENT SYSTEM </h1>
<div class="p-4 mt-auto" style="background-color: rgba(0, 0, 0, .5); border-radius: 30px;">
    <div class="row justify-content-center">
        <h4 class="text-white mt-4 justify-content-center text-center">Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam ad sed non aut doloribus.</h4>
        <div class="col-lg-7">
            <div class="text-center">
                
                <h4 class="mb-3 text-danger"><span class="text-primary"></span>+ Product of BusinessApp</h4>
              
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
<!-- end col -->

<div class="col-xl-4 col-lg-4">
<div class="auth-full-page-content p-md-5 p-4">
<div class="w-100">

<div class="d-flex flex-column h-100">

<div class="my-auto">
    
    <div>
        <h5 class="text-primary">Thank you for Using PSMS !</h5>
        <p class="text-muted">Please choose a security question to help secure your account.</p>
    </div>

    <div class="mt-4">
    <div class="text-center mt-1" id="server-response"></div>
        <form id="two_FAuth_form">
            <input type="hidden" name="action" value="set_2FAuth_">
            <input type="hidden" name="logger" value="<?php echo $_SESSION['ADMIN_EMAIL'];?>">
            <div class="mb-3">
                <label for="2fa" class="form-label">Choose Security Question</label>
                <select name="question" id="2fa" class="custom-select form-control-select">
                    <option>Choose...</option>
                    <option>What is your mother maiden name?</option>
                    <option>Where did you meet your spouse?</option>
                    <option>What is your childhood Nick name?</option>
                    <option>What is the name of your High school?</option>
                    <option>What is your Pet Name?</option>
                </select>
            </div>
              <div class="mb-3">
                <label for="answer" class="form-label">Security Answer</label>
                <input type="text" autocomplete="off" class="form-control" id="answer" name="answer" placeholder="Enter your answer here...">
            </div>
           
            <div class="mt-3 d-grid">
                <button class="btn btn-success waves-effect waves-light __loading_btn__" type="submit"><i class="fas fa-lock"></i> Continue</button>
            </div>
        </form>
    </div>
</div>

<div class="mt-2 mt-md-2 text-center">
    <p class="mb-0">© <script>document.write(new Date().getFullYear())</script> PSMS. Developed by BusinessApp</p>
</div>
</div>


</div>
</div>
</div>
<!-- end col -->
</div>
<!-- end row -->
</div>
<!-- end container-fluid -->
</div>

<!-- JAVASCRIPT -->
<script src="asset/libs/jquery/jquery.min.js"></script>
<script src="asset/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="asset/libs/metismenu/metisMenu.min.js"></script>
<script src="asset/libs/simplebar/simplebar.min.js"></script>
<script src="asset/libs/node-waves/waves.min.js"></script>
<!-- owl.carousel js -->
<!-- App js -->
<script src="asset/js/app.js"></script>
<script>
//two_FAuth_form
$(function(){
const two_FAuth_form = $("#two_FAuth_form");
two_FAuth_form.on("submit",function(e){
e.preventDefault();
//send request
$(".__loading_btn__").html('<img src="asset/loaders/rolling_loader.svg" width="30" alt="loading"> Processing...');
$.post("Repository/Helpers/helper",two_FAuth_form.serialize(),function(res){
setTimeout(()=>{
$(".__loading_btn__").html('<i class="fas fa-lock"></i> Continue');
$("#server-response").html(res);
},2500);
})
})
});
</script>
</body>
</html>
