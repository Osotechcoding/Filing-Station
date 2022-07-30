<?php 
require_once "Repository/Classes/Session.php";
require_once "Repository/Classes/Actions.php";
@Session::init();
@Session::check_admin_token();
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Pump Allocation -PMS</title>
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
                            <h5 class="m-b-10">Submit Total Sales Today</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Transaction</a></li>
                            <li class="breadcrumb-item"><a href="#!">Submit Sales</a></li>
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
                        <h5 class="text-primary text-bold">REMIT TODAY SALES TRANSACTIONS</h5>
                    </div>
                    <div class="card-body">
                        <div class="dt-responsive table-responsive">
                            <table class="table table-striped nowrap">
                                <thead class="text-center">
                                    <tr>
                                        <th>FUEL</th>
                                        <th>TOTAL VOLUME SOLD (LITRES)</th>
                                        <th>TOTAL SALES (&#8358;)</th>
                                        <th>ACCESS KEY</th>
                                       
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <form id="remit_form">
                                    <?php 
            $fuel_lists = $Actions->fetch_all_fuel();
            if ($fuel_lists!=NULL) {
                foreach ($fuel_lists as $klist) {?>
                     
                                <?php switch ($klist->fId) {
                                    case '1':
                                        // code...
                                    $amount =$Actions->get_petrol_transaction_today();
                                        break;

                                         case '2':
                                        // code...
                                    $amount =$Actions->get_diesel_transaction_today();
                                        break;

                                         case '3':
                                        // code...
                                    $amount =$Actions->get_gas_transaction_today();
                                        break;
                                    
                                    default:
                                     $amount =$Actions->get_kerosene_transaction_today();
                                        break;
                                } ?>
                                    <tr>
                                        <td><input type="hidden" name="fuel_id[]" value="<?php echo $klist->fId;?>"> <?php echo strtoupper($klist->fuel_type);?></td>
                                        <td><input type="text" name="sum_litres[]" class="form-control" id="price_per_litre" value="<?php echo number_format($amount->litres,2) ?>" readonly></td>
                                         <td><input type="text" name="sum_sales[]" id="total_sales" class="form-control" readonly value="<?php echo number_format($amount->amount,2) ?>"></td>
                                      
                                        <td><input type="password" autocomplete="off" id="access_code" class="form-control" name="access_code" placeholder="Access Code"></td>
                                       
                                        <td><button type="button" class="btn btn-success"><i class="feather icon-check-circle"></i> Submit</button></td>
                                    </tr>
                                     <?php
                    // code...
                }
            }
             ?>
             </form>
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
<script src="assets/js/pages/data-source-custom.js"></script>
<script>
	$(document).ready(function(){
		let action = $("#qty_sold");
		let k ="keyup";
		action.on(k,calculate);
		//$("#qty_sold").on("keyup",calculate);
	})
	function calculate(){
			let price = $("#price_per_litre").val();
			let qty = $("#qty_sold").val();
			let total = $("#total_sales");
			//let calculate 
			if (qty.length > 0 || qty!="") {
				total.val((price*qty).toFixed(2));
			}else{
				total.val(0);
			}
		}
</script>

</body>

</html>
