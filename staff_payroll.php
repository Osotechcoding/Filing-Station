<?php 
 // error_reporting(1);
require_once "Repository/Classes/Session.php";
require_once "Repository/Classes/Actions.php";
@Session::init();
@Session::check_admin_token();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Payroll -PMS</title>
    <!-- HTML5 Shim and Respond.js IE11 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 11]>
    	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    	<![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <meta name="author" content="Phoenixcoded" />
    <!-- Favicon icon -->
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">

    <!-- data tables css -->
    <link rel="stylesheet" href="assets/css/plugins/dataTables.bootstrap4.min.css">
    <!-- vendor css -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="">
	<!-- [ Pre-loader ] start -->
	<div class="loader-bg">
		<div class="loader-track">
			<div class="loader-fill"></div>
		</div>
	</div>
	<!-- [ Pre-loader ] End -->
	<!-- [ navigation menu ] start -->
	<?php include_once("Inc/sideBarNav.php");?>
	<!-- [ navigation menu ] end -->
	<!-- [ Header ] start -->
	<?php include_once("inc/header.php");?>
	<!-- [ Header ] end -->
<!-- [ Main Content ] start -->
<section class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">PSMS PAYROLL</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index-2.html"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">STAFF PAYROLL</a></li>
                            <li class="breadcrumb-item"><a href="#!">PAYROLL MANAGEMENT</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- HTML (DOM) Sourced Data table start -->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5><button type="button" class="btn btn-secondary btn-md btn-round" data-toggle="modal" data-target="#payroll_modal"><i class="fas fa-file-signature"></i> Add Payroll</button></h5>
                    </div>
                    <div class="card-body">
                        <div class="dt-responsive table-responsive">
                            <table class="table table-striped nowrap datatable text-center">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Qualification</th>
                                        <th>Salary</th>
                                        <th>Join date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Tiger Nixon</td>
                                        <td>System Architect</td>
                                        <td>Edinburgh</td>
                                        <td>61</td>
                                        <td>2011/04/25</td>
                                        <td><div class="btn-group" role="group">
								<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Action
								</button>
								<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
									<a class="dropdown-item" href="#!" data-toggle="modal" data-target="#pay_salary_modal"><i class="fas fa-money-bill"></i> Pay Salary</a>
									<a class="dropdown-item" href="salary_history.php"><i class="fas fa-chart-bar"></i> Salary History</a>
								</div>
							</div></td>
                                    </tr>
                                  
                                </tbody>
                                
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- HTML (DOM) Sourced Data table end -->
           
        </div>
        <!-- [ Main Content ] end -->
    </div>
</section>
<!-- [ varying-modal ] start -->
			<div class="modal fade" id="payroll_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h2 class="modal-title" id="exampleModalLabel"><i class="fas fa-chart-line"></i> Add Staff Payroll or Salary </h2>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									</div>
									<form>
									<div class="modal-body">
										 <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="staff">Staff <span class="fas fa-user-plus"></span></label>
                                         <select name="staff" id="staff" class="custom-select">
                                        	<option value="">Choose...</option>
                                        	<?php echo $Actions->staff_in_dropdown();?>
                                        </select>
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                    	<!-- fas fa-thermometer-half -->
                                        <label for="salary"> Basic Salary <span class="fas fa-chart-pie"></span></label>
                                        <input type="text" name="salary" class="form-control" id="salary" placeholder="123.09">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    	<!-- fas fa-thermometer-half -->
                                        <label for="allowance"> Total Allowances <span class="fas fa-chart-area"></span></label>
                                        <input type="text" name="allowance" class="form-control" id="allowance" placeholder="20,000.00">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    	<!-- fas fa-thermometer-half -->
                                        <label for="tax"> Tax Deducted at Source (TDS) <span class="fas fa-balance-scale"></span></label>
                                        <input type="text" name="tax" class="form-control" id="tax" placeholder="10%">
                                    </div>
                                </div>
                            </div>
											
									</div>
									<div class="modal-footer">
										<button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
										<button type="button" class="btn  btn-primary">Submit</button>
									</div>
								</form>
								</div>
							</div>
						</div>
			<!-- [ varying-modal ] end -->


			<!-- [ varying-modal ] start -->
			<div class="modal fade" id="pay_salary_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h2 class="modal-title" id="exampleModalLabel"><i class="fas fa-money-bill"></i> Pay Salalry </h2>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									</div>
									<form>
									<div class="modal-body">
										 <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="staff_id">Staff <span class="fas fa-user-plus"></span></label>
                                        <input type="text" name="staff_id" class="form-control" id="staff_id" value="Adeola Adewumi" readonly>
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                    	<!-- fas fa-thermometer-half -->
                                        <label for="salary"> Net Salary <span class="fas fa-chart-pie"></span></label>
                                        <input type="text" name="salary" class="form-control" id="salary" value="23,000.00" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    	<!-- fas fa-thermometer-half -->
                                        <label for="allowance"> Enter Amount to Pay <span class="fas fa-chart-area"></span></label>
                                        <input type="text" name="allowance" class="form-control" id="allowance" placeholder="20,000.00">
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="payment_type">Payment Method <span class="fas fa-user-plus"></span></label>
                                         <select name="payment_type" id="payment_type" class="custom-select">
                                        	<option value="">Choose...</option>
                                        	<option value="cash">Cash</option>
                                        	<option value="bank">Bank Transfer</option>
                                        	
                                        </select>
                                    </div>
                                </div>
                            </div>
											
									</div>
									<div class="modal-footer">
										<button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
										<button type="button" class="btn  btn-danger">Submit Payment</button>
									</div>
								</form>
								</div>
							</div>
						</div>
			<!-- [ varying-modal ] end -->
<!-- [ Main Content ] end -->
    <!-- Required Js -->
    <script src="assets/js/vendor-all.min.js"></script>
    <script src="assets/js/plugins/bootstrap.min.js"></script>
    <script src="assets/js/ripple.js"></script>
    <script src="assets/js/pcoded.min.js"></script>
	<!-- <script src="assets/js/menu-setting.min.js"></script> -->

<!-- datatable Js -->
<script src="assets/js/plugins/jquery.dataTables.min.js"></script>
<script src="assets/js/plugins/dataTables.bootstrap4.min.js"></script>
<script>
$(document).ready(function(){
	$(".datatable").DataTable();
})
</script>

</body>

</html>
