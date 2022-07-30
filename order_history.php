<?php 
require_once "Repository/Classes/Session.php";
require_once "Repository/Classes/Actions.php";
@Session::init();
@Session::check_admin_token();
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Ablepro v8.0 bootstrap admin template by Phoenixcoded</title>
   
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
                            <h5 class="m-b-10">Sources DataTable</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Data Table</a></li>
                            <li class="breadcrumb-item"><a href="#!">Sources Initialization</a></li>
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
                        <h5><a href="fuel_list"><button type="button" class="btn btn-primary btn-md btn-round"><i class="fas fa-eye"></i> View Fuel </button></a></h5>
                    </div>
                    <div class="card-body">
                        <div class="dt-responsive table-responsive">
                            <table class="table table-striped nowrap datatable text-center">
                                <thead>
                                    <tr>
                                    	<th>Fuel Type</th>
                                        <th>Total Litres Supplied</th>
                                        <th>Cost</th>
                                        <th>Supplier</th>
                                        <th> Date</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                     $order_lists = $Actions->fetch_all_order(); 

                                    if ($order_lists!=NULL) {
                                        foreach ($order_lists as $olist) {?>
                                      <tr>
                                       <td><h5><?php echo ucfirst($olist->fuel_type);?></h5></td>
                                      <td><h5><?php echo number_format($olist->litres,2);?> <span class="badge badge-danger">Ltrs</span></h5> </td>
                                        <td><h5><span class="badge badge-secondary">&#8358; </span><?php echo number_format($olist->cost_amount,2);?> </h5></td>
                                        <td>Adeola adewumi</td>
                                        <td><?php echo date("D jS F, Y" ,strtotime($olist->created_at)) ?></td>
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
