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
    <title>Credit Customers -PMS</title>
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
                            <h5 class="m-b-10">Credit Customers</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!"> Customers</a></li>
                            <li class="breadcrumb-item"><a href="#!">Creditors</a></li>
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
                        <h5><button type="button" class="btn btn-warning btn-md btn-rounded" data-toggle="modal" data-target="#add_customer_modal"><i class="fas fa-user-edit"></i> Add Credit Customers</button> || <?php if ($Actions->show_creditor_btn()): ?>
                            <button type="button" class="btn btn-danger btn-md btn-rounded" data-toggle="modal" data-target="#add_credit_sold_modal"><i class="fas fa-money-bill"></i> Add Credit Sales</button>
                        <?php endif ?> </h5>
                    </div>
                    <div class="card-body">
                        <div class="server_result"></div>
                        <div class="dt-responsive table-responsive">
                            <table class="table table-striped datatable text-center">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Client</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     <?php
                                      $get_creditors = $Actions->get_all_creditors();
                                    if ($get_creditors!=false) {
                                        foreach ($get_creditors as $get_creditor) {?>
                                    <tr>
                                        <td><?php echo strtoupper($get_creditor->name);?></td>
                                        <td><?php echo ($get_creditor->phone);?></td>
                                        <td><?php echo ($get_creditor->email);?></td>
                                        <td><?php echo ($get_creditor->address);?></td>
                                        <td><?php echo strtoupper($get_creditor->user_type);?></td>
                                        <td><div class="btn-group" role="group">
								<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Action
								</button>
								<div class="dropdown-menu">
									<a class="dropdown-item" href="creditor_purchase_history?cId=<?php echo ($get_creditor->cId);?>"><i class="fas fa-chart-line"></i> Purchases</a>
									<a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#edit_customer_modal"><i class="fas fa-edit"></i> Edit</a>
									<a class="dropdown-item text-c-red remove_btn" data-customer="<?php echo ($get_creditor->cId);?>" href="javascript:void(0)"><i class="fas fa-trash"></i> Remove</a>
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
			<div class="modal fade" id="add_customer_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h2 class="modal-title" id="exampleModalLabel"><i class="fas fa-user-plus"></i> Enter Creditor's Details </h2>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									</div>
                                    <div id="server_result"></div>
									<form id="add_creditor_form">
									<div class="modal-body">
										 <div class="row">
                                <div class="col-md-6">
                                    <input type="hidden" name="action" value="add_creditor_now">
                                    <div class="form-group">
                                        <label for="type">Type <span class="fas fa-briefcase"></span></label>
                                         <select name="ctype" id="type" class="custom-select">
                                         	<option value="">Choose...</option>
                                        	<option value="Indvidual">Indvidual</option>
                                        	<option value="Government">Government</option>
                                        	<option value="Company">Company</option>
                                        </select>
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                    	<!-- fas fa-thermometer-half -->
                                        <label for="fullname">Fullname <span class="fas fa-user-secret"></span></label>
                                        <input type="text" autocomplete="off" class="form-control" id="fullname" name="fullname" placeholder="Adeola Adewumi">
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                    	<!-- fas fa-thermometer-half -->
                                        <label for="phone">Phone Number <span class="fas fa-phone"></span></label>
                                        <input type="text" autocomplete="off" class="form-control" id="phone" name="phone" placeholder="080******09">
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                    	<!-- fas fa-thermometer-half -->
                                        <label for="email">Email <span class="fas fa-envelope-open"></span></label>
                                        <input type="text" autocomplete="off" name="email" class="form-control" id="email" placeholder="example@psms.com">
                                    </div>
                                </div>
                               
                                <div class="col-md-12">
                                    <div class="form-group">
                                    	<!-- fas fa-thermometer-half -->
                                        <label for="address">Address <span class="fas fa-map-marker-alt"></span></label>
                                        <textarea name="address" id="address" class="form-control" placeholder="xyz  sample street nowhere"></textarea>
                                    </div>
                                </div>
                                
                            </div>
											
									</div>
									<div class="modal-footer">
										<button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
										<button type="submit" class="btn btn-success mb-1 __loading_btn">Submit</button>
									</div>
								</form>
								</div>
							</div>
						</div>
			<!-- [ varying-modal ] end -->

			<!-- [ varying-modal ] start -->
			<div class="modal fade" id="edit_customer_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h2 class="modal-title" id="exampleModalLabel"><i class="fas fa-user-plus"></i> Edit Creditor's Information </h2>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									</div>
									<form>
                                    <div class="modal-body">
                                         <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="type">Type <span class="fas fa-briefcase"></span></label>
                                         <select name="type" id="type" class="custom-select">
                                            <option value="">Choose...</option>
                                            <option value="Indvidual" selected>Indvidual</option>
                                            <option value="Government">Government</option>
                                            <option value="Company">Company</option>
                                        </select>
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <!-- fas fa-thermometer-half -->
                                        <label for="fullname">Fullname <span class="fas fa-user-secret"></span></label>
                                        <input type="text" autocomplete="off" class="form-control" id="fullname" name="fullname" value="Adeola Adewumi">
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <!-- fas fa-thermometer-half -->
                                        <label for="phone">Phone Number <span class="fas fa-phone"></span></label>
                                        <input type="text" autocomplete="off" class="form-control" id="phone" name="phone" value="080******09">
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <!-- fas fa-thermometer-half -->
                                        <label for="email">Email <span class="fas fa-envelope-open"></span></label>
                                        <input type="text" autocomplete="off" name="email" class="form-control" id="email" value="080******09">
                                    </div>
                                </div>
                               
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <!-- fas fa-thermometer-half -->
                                        <label for="address">Address <span class="fas fa-map-marker-alt"></span></label>
                                        <textarea name="address" id="address" class="form-control" placeholder="xyz  sample street nowhere">xyz  sample street nowhere</textarea>
                                    </div>
                                </div>
                                
                            </div>
                                            
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary mb-1 __loading_btn__">Submit</button>
                                    </div>
                                </form>
								</div>
							</div>
						</div>
			<!-- [ varying-modal ] end -->
            <?php include_once("Inc/credit_sales_modal.php") ?>
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
    let remove_btn =$(".remove_btn");
    remove_btn.on("click", function(){
        if (confirm("Do you really want to delete this Client Permanenlty?")) {
            let cId = $(this).data("customer");
            alert(cId);
            //send request
            $.post("Repository/Helpers/helper",{action:"remove_customer",cId:cId},function(res){
                $(".server_result").html(res);
            });
        }else 
        return false;
    });
//let's calculate
    let action = $("#_litre_");
        let k ="keyup";
        action.on(k,calculate);
    //when fuel type is selected grap the id and fetch price by it
    $("#__fuel_id").on("change",function(){
        let epo = $(this).val();
        //send to helpers/helper
        $.ajax({
            url:"Repository/Helpers/helper",
            type:"POST",
            data:{action:'fetch_price_now',fuelId:epo},
            success:function(data){
                if (data) {
                console.log(data);
            $("#price_of_litre").val(data);
            }else{
            $("#price_of_litre").val(0);
            }
            }
        });
    });

//add_credit_sales_form starts

//add_credit_sales_form
     const add_credit_sales_form =  $("#add_credit_sales_form");
add_credit_sales_form.on("submit",function(e){
e.preventDefault();
//send request
$(".__loading_rolling__").html('<img src="asset/loaders/rolling_loader.svg" width="30" alt="loading"> Processing...');
$.post("Repository/Helpers/helper",add_credit_sales_form.serialize(),function(result){
setTimeout(()=>{
$(".__loading_btn__").html('Submit');
$("#_server_result_").html(result);
},2500);
})
});

//add credit sales form ends

    //add_creditor_form
     const add_creditor_form =  $("#add_creditor_form");
add_creditor_form.on("submit",function(e){
e.preventDefault();
//send request
$(".__loading_btn").html('<img src="asset/loaders/rolling_loader.svg" width="30" alt="loading"> Processing...');
$.post("Repository/Helpers/helper",add_creditor_form.serialize(),function(result){
setTimeout(()=>{
$(".__loading_btn").html('Submit');
$("#server_result").html(result);
},2500);
})
});

	$(".datatable").DataTable();
});

function calculate(){
            let price = $("#price_of_litre").val();
            let qty = $("#_litre_").val();
            let total = $("#sold_amount");
            //let calculate 
            if (qty.length > 0 || qty!="") {
                total.val((price*qty));
            }else{
                total.val(0);
            }
        }
</script>

</body>

</html>
