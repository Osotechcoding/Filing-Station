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
    <title>Suppliers - PMS</title>
 
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
                            <h5 class="m-b-10">SUPPLIERS</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index-2.html"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">PSMS SUPPLIERS</a></li>
                            <li class="breadcrumb-item"><a href="#!">MANAGE SUPPLIERS</a></li>
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
                        <h5><button type="button" class="btn btn-secondary btn-md btn-rounded" data-toggle="modal" data-target="#add_staff_modal"><i class="fas fa-truck"></i> Add Supplier</button></h5>
                    </div>
                    <div class="card-body">
                        <div class="dt-responsive table-responsive">
                            <table class="table table-striped table-bordered nowrap datatable text-center">
                                <thead>
                                    <tr>
                                    	<th>Company</th>
                                        <th>Representative</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    	<td>NNPC</td>
                                        <td>Adeola Adewumi</td>
                                        <td>080*****090</td>
                                        <td>example@gmail.com</td>
                                        <td>xyz street, Nowhere</td>
                                        <td><h6><span class="badge badge-success">Active</span></h6></td>
                                        <td><div class="btn-group" role="group">
								<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Action
								</button>
								<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
									<a class="dropdown-item" href="#!"><i class="fas fa-chart-line"></i> History</a>
									<a class="dropdown-item" href="#!" data-toggle="modal" data-target="#edit_staff_modal"><i class="fas fa-edit"></i> Edit</a>
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
			<div class="modal fade" id="add_staff_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h2 class="modal-title" id="exampleModalLabel"><i class="fas fa-user-plus"></i> Enter Supplier Details </h2>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									</div>
									<form>
									<div class="modal-body">
										 <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="company">Company Name <span class="fas fa-briefcase"></span></label>
                                          <input type="text" class="form-control" name="company" id="company" placeholder="e.g NNPC">
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                    	<!-- fas fa-thermometer-half -->
                                        <label for="fullname">Representative <span class="fas fa-user-secret"></span></label>
                                        <input type="text" class="form-control" name="rep_name" id="rep_name" placeholder="Mr. Adeola Adewumi">
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                    	<!-- fas fa-thermometer-half -->
                                        <label for="cphone">Phone Number <span class="fas fa-phone"></span></label>
                                        <input type="text" name="cphone" class="form-control" id="cphone" placeholder="080******09">
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                    	<!-- fas fa-thermometer-half -->
                                        <label for="cemail">Email <span class="fas fa-envelope-open"></span></label>
                                        <input type="text" class="form-control" name="cemail" id="cemail" placeholder="manager@nnpc.com.ng">
                                    </div>
                                </div>
                               
                                <div class="col-md-6">
                                    <div class="form-group">
                                    	<!-- fas fa-thermometer-half -->
                                        <label for="caddress">Office Address <span class="fas fa-map-marker-alt"></span></label>
                                        <textarea name="caddress" id="caddress" class="form-control" placeholder="xyz  sample street nowhere"></textarea>
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="status"><span class="text-c-red"> Status <i class="fas fa-graduation-cap"></i></span></label>
                                       <select name="status" id="status" class="custom-select">
                                            <option value="">Choose...</option>
                                        	<option value="Active">Active</option>
                                        	<option value="Pending">Pending</option>
                                        	<option value="Block">Terminated</option>
                                        	
                                        </select>
                                    </div>
                                </div>
                            </div>
											
									</div>
									<div class="modal-footer">
										<button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
										<button type="button" class="btn  btn-primary mb-1">Submit</button>
									</div>
								</form>
								</div>
							</div>
						</div>
			<!-- [ varying-modal ] end -->

			!-- [ varying-modal ] start -->
			<div class="modal fade" id="edit_staff_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h2 class="modal-title" id="exampleModalLabel"><i class="fas fa-user-plus"></i> Edit Staff Details </h2>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									</div>
									<form>
									<div class="modal-body">
										 <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Email">Designation <span class="fas fa-briefcase"></span></label>
                                         <select name="" id="" class="custom-select">
                                         	<option value="">Choose...</option>
                                        	<option value="1" selected>Manager</option>
                                        	<option value="2">Attendant</option>
                                        	<option value="3">Messenger</option>
                                        	<option value="4">Security</option>
                                        </select>
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                    	<!-- fas fa-thermometer-half -->
                                        <label for="fullname">Fullname <span class="fas fa-user-secret"></span></label>
                                        <input type="text" class="form-control" id="fullname" value="Adeola Adewumi">
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                    	<!-- fas fa-thermometer-half -->
                                        <label for="price">Phone Number <span class="fas fa-phone"></span></label>
                                        <input type="text" class="form-control" id="price" value="080******09">
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                    	<!-- fas fa-thermometer-half -->
                                        <label for="price">Email <span class="fas fa-envelope-open"></span></label>
                                        <input type="text" class="form-control" id="price" value="example@gmail.com">
                                    </div>
                                </div>
                               
                                <div class="col-md-6">
                                    <div class="form-group">
                                    	<!-- fas fa-thermometer-half -->
                                        <label for="price">Address <span class="fas fa-map-marker-alt"></span></label>
                                        <textarea name="" id="" class="form-control">xyz  sample street nowhere</textarea>
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="attendant"><span class="text-c-red"> Qualification <i class="fas fa-graduation-cap"></i></span></label>
                                       <select name="" id="attendant" class="custom-select">
                                        	<option value="3">Phd Holder</option>
                                        	<option value="4" selected>BSc Holder</option>
                                        	<option value="5">Degree Holder</option>
                                        	<option value="6">HND Holder</option>
                                        	<option value="7">OND Holder</option>
                                        	<option value="8">NCE Holder</option>
                                        	<option value="9">WASSCE Holder</option>
                                        	<option value="10">PRY SCHOOL LEAVING CERT</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
											
									</div>
									<div class="modal-footer">
										<button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
										<button type="button" class="btn  btn-warning mb-1">Save Changes</button>
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
<!-- 	<script src="assets/js/menu-setting.min.js"></script> -->

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
