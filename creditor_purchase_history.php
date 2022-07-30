<?php 
 // error_reporting(1);
require_once "Repository/Classes/Session.php";
require_once "Repository/Classes/Actions.php";
@Session::init();
@Session::check_admin_token();
?>
<?php 

if (isset($_REQUEST['cId']) && $_REQUEST['cId'] !='') {
    $cid = $Actions->clean_string($_REQUEST['cId']);
    $cust_data = $Actions->get_customer_by_id($cid);
    // code...
}else{
    header("Location: customers");
    exit();
}

 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo strtoupper($cust_data->name) ?> - PSMS</title>
 
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
                            <h5 class="m-b-10"><?php echo strtoupper($cust_data->name) ?> Purchase History</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!"><?php echo strtoupper($cust_data->name) ?> Purchase History</a></li>
                            <li class="breadcrumb-item"><a href="#!">Manage Sales History</a></li>
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
                        <h2 class="text-c-red"><i class="fas fa-hospital"></i> <?php echo strtoupper($cust_data->name) ?> Purchase History</h2>
                        <h5><a href="customers"><button type="button" class="btn btn-warning btn-md btn-rounded"><i class="fas fa-users"></i> View Creditors</button></a></h5>
                    </div>
                    <div class="card-body">
                        <div class="dt-responsive table-responsive">
                            <table class="table table-striped table-bordered nowrap datatable text-center">
                                <thead>
                                    <tr>
                                    	<th>Attendant</th>
                                        <th>Fuel</th>
                                        <th>Pump</th>
                                        <th>Price/L</th>
                                        <th>Litres</th>
                                        <th>Total</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $sales_history = $Actions->show_credit_sales_history();
                                    if ($sales_history!=false) {
                                        foreach ($sales_history as $sales) {?>
                                            <?php// print_r($sales) ?>
                                     <tr>
                                        <td><?php echo strtoupper($sales->full_name);?></td>
                                        <td><?php echo strtoupper($sales->fuel_type);?></td>
                                        <td><?php echo $sales->pump_desc;?></td>
                                        <td><?php echo number_format($sales->price,2);?>/Ltrs</td>
                                        <td><?php echo number_format($sales->litre,1);?>Ltrs</td>
                                    <td>&#8358;<?php echo number_format($sales->amount,2)?></td>
                                        <td><?php echo date("D jS F Y",strtotime($sales->sold_date));?></td>
                                        <td><?php if ($sales->pstatus==1) {
                                            echo'<i class="fas fa-check text-c-green"></i>';
                                        } else{
                                            echo'<i class="fas fa-times text-c-red"></i>';
                                        }
                                        ?>
                                        </td>
                                        <td><button type="button" class="btn btn-warning btn-sm"><i class="fas fa-edit fa-1x"></i> Update</button></td>
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