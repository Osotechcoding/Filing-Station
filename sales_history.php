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
    <title>Sales History -PMS</title>
 
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
                            <h5 class="m-b-10"><i class="fas fa-chart-line"></i> PSMS SALES REPORT</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index-2.html"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">SALES REPORT</a></li>
                            <li class="breadcrumb-item"><a href="#!">SEARCH SALES REPORT</a></li>
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
                        <h2><i class="fas fa-shopping-cart"></i> Daily Transaction History</h2>
                        <h5><a href="reading"><button type="button" class="btn btn-secondary btn-md btn-rounded"><i class="fas fa-gas-pump"></i> Allocate Attendant</button></a></h5>
                    </div>
                   
                    <div class="form" style="margin: 1rem;padding: 1rem;" style="width: 100%;">
                         <h3 class="text-muted">You can search Sales based on Date Sold</h3>
                          <form action="sales_history" class="form-inline" method="post" style="width: 100%;">
                            <span class="text-c-red"><b> From: </b></span> <input type="date" name="from_date" class="form-control"> ||
                              <span class="text-c-red"><b> To: </b></span> <input type="date" name="to_date" class="form-control">
                            <button type="submit" name="search_by_date" class="btn btn-success btn-md"><i class="fas fa-search"></i> Search </button>
                        </form>
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
                                        <th>Litres Sold</th>
                                        <th>Total Amount</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- filter_sales_history_by_date -->
                                    <?php if (isset($_POST['search_by_date'])): ?>
                                        <?php 
                                         $from_date = $_POST['from_date'];
                                        $to_date = $_POST['to_date'];
                                    $filter_sales = $Actions->filter_sales_history_by_date($from_date,$to_date);
                                    if ($filter_sales!=false) {
                                        foreach ($filter_sales as $filter_sale) {?>
                                     <tr>
                                        <td><?php echo strtoupper($filter_sale->full_name);?></td>
                                        <td><?php echo strtoupper($filter_sale->fuel_type);?></td>
                                        <td><?php echo $filter_sale->pump_desc;?></td>
                                        <td><?php echo number_format($filter_sale->litre_price,2);?>/Ltrs</td>
                                        <td><?php echo number_format($filter_sale->litre_sold,1);?>Ltrs</td>
                                        <td>&#8358;<?php echo number_format($filter_sale->total,2)?></td>
                                        <td><?php echo date("D jS F Y",strtotime($filter_sale->created));?></td>
                                    </tr>
                                            <?php
                                            
                                        }
                                    }

                                     ?>
                                        <?php else: ?>
                                            <?php 
                                    $sales_history = $Actions->show_sales_history();
                                    if ($sales_history!=false) {
                                        foreach ($sales_history as $sales) {?>
                                            <?php// print_r($sales) ?>
                                     <tr>
                                        <td><?php echo strtoupper($sales->full_name);?></td>
                                        <td><?php echo strtoupper($sales->fuel_type);?></td>
                                        <td><?php echo $sales->pump_desc;?></td>
                                        <td><?php echo number_format($sales->litre_price,2);?>/Ltrs</td>
                                        <td><?php echo number_format($sales->litre_sold,1);?>Ltrs</td>
                                        <td>&#8358;<?php echo number_format($sales->total,2)?></td>
                                        <td><?php echo date("D jS F Y",strtotime($sales->created));?></td>
                                    </tr>
                                            <?php
                                            
                                        }
                                    }

                                     ?>
                                    <?php endif ?>
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
