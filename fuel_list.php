<?php 
require_once "Repository/Classes/Session.php";
require_once "Repository/Classes/Actions.php";
@Session::init();
@Session::check_admin_token();
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Fuel List - PSMS</title>
   
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
                            <h5 class="m-b-10">PSMS FUEL LIST</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">FUEL</a></li>
                            <li class="breadcrumb-item"><a href="#!">MANAGE FUEL</a></li>
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
                        <h5><button type="button" class="btn btn-secondary btn-md btn-round" data-toggle="modal" data-target="#add_fuel_modal"><i class="fas fa-truck"></i> Add New Order </button> <a href="order_history"><button type="button" class="btn btn-primary btn-md btn-round"><i class="fas fa-eye"></i> View Order History </button></a></h5>
                    </div>
                    <div class="card-body">
                        <div class="dt-responsive table-responsive">
                            <table class="table table-striped nowrap datatable text-center">
                                <thead>
                                    <tr>
                                    	<th>Fuel Type</th>
                                        <th>Available Litres</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $fuel_lists = $Actions->fetch_all_fuel(); 

                                    if ($fuel_lists!=NULL) {
                                        foreach ($fuel_lists as $flist) {?>
                                      <tr>
                                        <td><h5><?php echo ucfirst($flist->fuel_type);?></h5></td>
                                        <td><h5><?php echo number_format($flist->litres,2);?> <span class="badge badge-primary">Ltrs</span></h5> </td>
                                        <td><h5><span class="badge badge-success">Active</span></h5></td>
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
			<div class="modal fade" id="add_fuel_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h2 class="modal-title" id="exampleModalLabel"><i class="fas fa-gas-pump"></i> Enter Order Details </h2>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									</div>
                                    <div id="server_response_"></div>
									<form id="create_fuel_form">
									<div class="modal-body">
										 <div class="row">
                                <div class="col-md-6">
                                    <input type="hidden" name="action" value="create_fuel_now">
                                    <div class="form-group">
                                        <label for="Email">Fuel Type <span class="fas fa-gas-pump"></span></label>
                                         <select name="fuel" class="custom-select">
                                         	<option value="">Choose...</option>
                                            <?php echo $Actions->fuel_in_dropdown(); ?>
                                        </select>
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                    	<!-- fas fa-thermometer-half -->
                                        <label for="supplier">Supplier <span class="fas fa-user-plus"></span></label>
                                        <select name="supplier" id="supplier" class="custom-select">
                                            <option value="">Choose...</option>
                                            <option value="1">NNPC</option>
                                            <option value="2">AP</option>
                                            <option value="3">BOVAS</option>
                                            <option value="4">OANDO</option>
                                           
                                        </select>
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                    	<!-- fas fa-thermometer-half -->
                                        <label for="total_litre">Total Litres <span class="fas fa-thermometer-half"></span></label>
                                        <input type="text" autocomplete="off" class="form-control" name="total_litre" placeholder="109">
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                    	<!-- fas fa-thermometer-half -->
                                        <label for="price">Total Cost <span class="fas fa-money-bill"></span></label>
                                        <input type="number" autocomplete="off" class="form-control" name="cost_price" id="price" placeholder="&#8358;300,900.00">
                                    </div>
                                </div>
                            </div>
											
									</div>
									<div class="modal-footer">
										<button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
										<button type="submit" class="btn  btn-success mb-1 __loading_btn__">Submit Order</button>
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
    //create_fuel_form
  const create_fuel_form =  $("#create_fuel_form");
create_fuel_form.on("submit",function(e){
e.preventDefault();
//send request
$(".__loading_btn__").html('<img src="asset/loaders/rolling_loader.svg" width="30" alt="loading"> Processing...');
$.post("Repository/Helpers/helper",create_fuel_form.serialize(),function(res){
setTimeout(()=>{
$(".__loading_btn__").html('Submit Order');
$("#server_response_").html(res);
},2500);
})
});
})
</script>

</body>

</html>
