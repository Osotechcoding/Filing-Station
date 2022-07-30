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
    <title>Staff -PMS</title>
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
                            <h5 class="m-b-10">PSMS STAFF</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index-2.html"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">STAFF LIST</a></li>
                            <li class="breadcrumb-item"><a href="#!">MANAGE STAFF</a></li>
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
                        <h5><button type="button" class="btn btn-secondary btn-md btn-rounded" data-toggle="modal" data-target="#add_staff_modal"><i class="fas fa-user-edit"></i> Add New Staff</button></h5>
                    </div>
                    <div class="card-body">
                        <div class="dt-responsive table-responsive">
                            <table class="table table-striped table-bordered nowrap datatable text-center">
                                <thead>
                                    <tr>
                                    	<th>Staff Id</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Position</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $get_staffs = $Actions->get_all_staff();
                                    if ($get_staffs!=false) {
                                        foreach ($get_staffs as $get_staff) {?>
                                             <tr>
                                        <td><?php echo $get_staff->regNo;?></td>
                                        <td><?php echo ucwords($get_staff->full_name);?></td>
                                        <td><?php echo $get_staff->phone;?></td>
                                        <td><?php echo $get_staff->email;?></td>
                                        <td><?php echo $get_staff->address;?></td>
                                        <td><h5><span class="badge badge-primary badge-lg"><?php echo $get_staff->designation;?></span></h5></td>
                                        <td><div class="btn-group" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle btn-round" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Action
                                </button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                    <a class="dropdown-item edit_staff_btn" href="javascript:void(0);" data-staff="<?php echo $get_staff->staff_id;?>"><i class="fas fa-edit"></i> Edit Details</a>
                                    <a class="dropdown-item text-c-red" href="#!"><i class="fas fa-trash"></i> Remove</a>
                                </div>
                            </div></td>
                                    </tr>
                                            <?php
                                            
                                        }
                                    }
                                     ?>
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
										<h2 class="modal-title" id="exampleModalLabel"><i class="fas fa-user-plus"></i> Enter Staff Details </h2>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									</div>
                                    <div id="server_response_"></div>
									<form id="create_staff_now_form">
									<div class="modal-body">
										 <div class="row">
                                <div class="col-md-6">
                                    <input type="hidden" name="action" value="create_staff_now">
                                    <div class="form-group">
                                        <label for="Email">Designation <span class="fas fa-briefcase"></span></label>
                                        <select name="designation" id="" class="custom-select">
                                         	<option value="">Choose...</option>
                                        	<option value="Manager">Manager</option>
                                        	<option value="Attendant">Attendant</option>
                                        	<option value="Messenger">Messenger</option>
                                        	<option value="Security">Security</option>
                                        </select>
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                    	<!-- fas fa-thermometer-half -->
                                        <label for="fullname">Fullname <span class="fas fa-user-secret"></span></label>
                                        <input type="text" autocomplete="off" class="form-control" id="fullname" placeholder="Adeola Adewumi" name="fullname">
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                    	<!-- fas fa-thermometer-half -->
                                        <label for="phoneno">Phone Number <span class="fas fa-phone"></span></label>
                                        <input type="text" class="form-control" name="phoneno" id="phoneno" placeholder="080******09">
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                    	<!-- fas fa-thermometer-half -->
                                        <label for="email">Email <span class="fas fa-envelope-open"></span></label>
                                        <input type="text" autocomplete="off" class="form-control" id="email" placeholder="staff@psms.com" name="email">
                                    </div>
                                </div>
                               
                                <div class="col-md-6">
                                    <div class="form-group">
                                    	<!-- fas fa-thermometer-half -->
                                        <label for="address">Address <span class="fas fa-map-marker-alt"></span></label>
                                        <textarea name="address" autocomplete="off" id="address" class="form-control" placeholder="xyz  sample street nowhere"></textarea>
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="qualification"><span class="text-c-red"> Qualification <i class="fas fa-graduation-cap"></i></span></label>
                                       <select name="qualification" id="qualification" class="custom-select">
                                        	<option>Phd Holder</option>
                                        	<option>BSc Holder</option>
                                        	<option>Degree Holder</option>
                                        	<option>HND Holder</option>
                                        	<option>OND Holder</option>
                                        	<option>NCE Holder</option>
                                        	<option>WASSCE Holder</option>
                                        	<option>PRY SCHOOL CERT</option>
                                        </select>
                                    </div>
                                </div>
                            </div>	
									</div>
									<div class="modal-footer">
										<button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
										<button type="submit" class="btn  btn-success mb-1 __loading_btn__">Submit</button>
									</div>
								</form>
								</div>
							</div>
						</div>
			<!-- [ varying-modal ] end -->

			<!-- [ varying-modal ] start -->
			<div class="modal fade" id="edit_staff_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h2 class="modal-title" id="exampleModalLabel"><i class="fas fa-user-plus"></i> Edit Staff Details </h2>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									</div>
                                    <div id="_server_response__"></div>
									<form id="save_edited_staff_form">
									<div class="modal-body">
                                        <input type="hidden" name="action" value="update_staff_now">
										 <div class="row" id="_show_staff_details">
                                
                                         </div>
											
									</div>
									<div class="modal-footer">
										<button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
										<button type="submit" class="btn  btn-success mb-1 __loading_rolling__">Save Changes</button>
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
//create_staff_now_form
     const create_staff_now_form =  $("#create_staff_now_form");
create_staff_now_form.on("submit",function(e){
e.preventDefault();
//send request
$(".__loading_btn__").html('<img src="asset/loaders/rolling_loader.svg" width="30" alt="loading"> Processing...');
$.post("Repository/Helpers/helper",create_staff_now_form.serialize(),function(result){
setTimeout(()=>{
$(".__loading_btn__").html('Submit');
$("#server_response_").html(result);
},2500);
})
});
//when edit staff btn is clicked
let edit_btn =$(".edit_staff_btn");
edit_btn.on("click", function(){
    let staff_id = $(this).data("staff"),action="show_edit_staff_form";
    //send to server
    $.ajax({
        url:"Repository/Helpers/helper",
        type:"POST",
        data:{action:action,staff_id:staff_id},
        success:function(result){
            console.log(result);
            $("#_show_staff_details").html(result);
            $("#edit_staff_modal").modal("show");
        }
    });
})

//when save edit staff form is submitted
const save_edited_staff_form = $("#save_edited_staff_form");
save_edited_staff_form.on("submit",function(event){
event.preventDefault();
//send request
$(".__loading_rolling__").html('<img src="asset/loaders/rolling_loader.svg" width="30" alt="loading"> Processing...');
$.post("Repository/Helpers/helper",save_edited_staff_form.serialize(),function(result){
setTimeout(()=>{
$(".__loading_rolling__").html('Save Change');
$("#_server_response__").html(result);
},2500);
})
});

 $(".datatable").DataTable();
})
</script>

</body>

</html>
