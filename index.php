<?php 
require_once "Repository/Classes/Session.php";
require_once "Repository/Classes/Actions.php";
@Session::init();
@Session::check_admin_token();
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard - PMS</title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <meta name="author" content="Phoenixcoded" />
    <!-- Favicon icon -->
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
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
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Dashboard Analytics</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Dashboard</a> </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="mb-2">
        		<button type="button" class="btn btn-secondary btn-sm btn-round" data-toggle="modal" data-target="#set_price_modal"><i class="fas fa-edit"></i> Price Control</button>
        	</div>
            <?php if (isset($_REQUEST['logout-failed'])): ?>
                                <?php echo $Actions->alert_msg("Error:","<span style='color:red'>Logout Failed, Please try again...</span>","danger"); ?>
                            <?php endif ?>
        <div class="row">
        	 <!-- PMS start -->
             <?php 
             $current_prices = $Actions->fetch_fuel_price();
             if ($current_prices!=NULL) {
                 // code...
                foreach ($current_prices as $current_price) {?>
                     <div class="col-md-4 col-lg-3">
                <div class="card">
                    <div class="card-body text-center">
                         <h5 class="m-b-20 text-c-blue"><?php echo date("D jS F Y")?></h5>
                        <i class="fas fa-gas-pump text-c-blue d-block f-40"></i>
                        <p style="font-size: 20px;"><strong><?php echo strtoupper($current_price->fuel_type) ?></strong> </p>
                        <h4 class="text-c-green"><span class="text-c-red ml-auto">&#8358;<?php if ($current_price->fuel_type =="Gas") {
                            echo number_format($current_price->litre_price,2)."<small>/Kg</small>";
                        }else{
                     echo number_format($current_price->litre_price,2)."<small>/L</small>";        
                        } ?> </span> </h4>
                       
                    </div>
                </div>
            </div>
                    <?php 
                    // code...
                }
             }
              ?>
            <!-- PMS end -->


             <!-- PMS start -->
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
                     <div class="col-md-4 col-lg-3">
                <div class="card">
                    <div class="card-body text-center">
                         <h5 class="m-b-20">TODAY'S SALES</h5>
                        <i class="fas fa-gas-pump text-c-green d-block f-40"></i>
                        <p style="font-size: 20px;"><strong><?php echo strtoupper($klist->fuel_type) ?></strong> </p>
                        <h4 class="text-c-green"><span class="text-c-green ml-auto">&#8358;<?php echo number_format( $amount->amount,2) ?> </span> </h4>
                       
                    </div>
                </div>
            </div>
                    <?php 
                    // code...
                }
             }
              ?>
            <!-- PMS end -->
            <!-- OUTSTANDING DEBT -->

             <?php 
             $fuel_lists = $Actions->fetch_all_fuel();
            if ($fuel_lists!=NULL) {
                foreach ($fuel_lists as $klist) {?>

                    <?php switch ($klist->fId) {
                                    case '1':
                                        // code...
                                    $credit =$Actions->get_petrol_credit_transaction_today();
                                        break;

                                         case '2':
                                        // code...
                                    $credit =$Actions->get_diesel_credit_transaction_today();
                                        break;

                                         case '3':
                                        // code...
                                    $credit =$Actions->get_gas_credit_transaction_today();
                                        break;
                                    
                                    default:
                                     $credit =$Actions->get_kerosene_credit_transaction_today();
                                        break;
                                } ?>
                     <div class="col-md-4 col-lg-3">
                <div class="card">
                    <div class="card-body text-center">
                          <h5 class="m-b-20 text-c-red">OUTSTANDING</h5>
                        <!-- <i class="fas fa-gas-pump text-c-red d-block f-40"></i> -->
                        <p style="font-size: 20px;"><strong><?php echo strtoupper($klist->fuel_type) ?></strong> </p>
                        <h4 class="text-c-red"><span class="text-c-red ml-auto">&#8358;<?php echo number_format( $credit->amount,2) ?> </span> </h4>
                      
                    </div>
                </div>
            </div>
                    <?php 
                    // code...
                }
             }
              ?>
           <!-- OUTSTANDING DEBT /-->
            
            <!-- PMS start -->
              <?php 
            $ava_litres = $Actions->fetch_all_fuel();
            if ($ava_litres!=NULL) {
                foreach ($ava_litres as $fvalue) {?>
            <div class="col-md-4 col-lg-3">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="fas fa-gas-pump text-c-yellow d-block f-40"></i>
                        <p><?php echo strtoupper($fvalue->fuel_type) ?></p>
                        <h4 class="m-t-20">Available <br><span class="text-c-red ml-auto"><?php if ($fvalue->fuel_type =="Gas") {
                            echo number_format($fvalue->litres,1)."<small>/Kg</small>";
                        }else{
                     echo number_format($fvalue->litres,1)."<small>/L</small>";        
                        } ?></span> </h4>
                        <h5 class="m-b-20"><?php echo date("D jS F Y")?></h5>
                    </div>
                </div>
            </div>
              <?php
                    // code...
                }
            }
             ?>
            <!-- PMS end -->

             <!-- seo start -->

            <!-- seo end -->

            <!-- Latest Customers end -->
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
<!-- Button trigger modal -->
<!-- set price modal -->
<?php include_once("Inc/set_price.php");?>
    <!-- Required Js -->
    <script src="assets/js/vendor-all.min.js"></script>
    <script src="assets/js/plugins/bootstrap.min.js"></script>
    <script src="assets/js/ripple.js"></script>
    <script src="assets/js/pcoded.min.js"></script>
	<!-- <script src="assets/js/menu-setting.min.js"></script> -->

<!-- Apex Chart -->
<script src="assets/js/plugins/apexcharts.min.js"></script>
<!-- custom-chart js -->
<script src="assets/js/pages/dashboard-main.js"></script>
<script>
    //price_update_form
    $(document).ready(function(){
        //when update price submit btn is clicked
        const price_update_form =  $("#price_update_form");
price_update_form.on("submit",function(e){
e.preventDefault();
//send request
$(".__loading_btn__").html('<img src="asset/loaders/rolling_loader.svg" width="30" alt="loading"> Processing...');
$.post("Repository/Helpers/helper",price_update_form.serialize(),function(res){
setTimeout(()=>{
$(".__loading_btn__").html('<i class="fas fa-retweet"></i> Update Price');
$("#server_response_").html(res);
},2500);
})
})
    })
</script>
</body>

</html>
