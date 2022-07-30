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
<title>Meter Reading -PMS</title>
<!-- Meta -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="description" content="" />
<meta name="keywords" content="">
<meta name="author" content="Phoenixcoded" />
<!-- Favicon icon -->
<link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="assets/css/plugins/daterangepicker.css">
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
                        <h5 class="m-b-10"><i class="fas fa-gas-pump"></i> Pump Reading & Sales Calculation</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="./"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#!">Pump Reading</a></li>
                        <li class="breadcrumb-item"><a href="#!">Sales</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- [ breadcrumb ] end -->
    <!-- [ Main Content ] start -->
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
                    <!-- <i class="fas fa-gas-pump text-c-blue d-block f-40"></i> -->
                    <h4 class="m-t-20 text-c-green"><strong><?php echo strtoupper($current_price->fuel_type) ?></strong>  <br> <span class="text-c-red ml-auto">&#8358;<?php if ($current_price->fuel_type =="Gas") {
                        echo number_format($current_price->litre_price,2)."/Kg";
                    }else{
                 echo number_format($current_price->litre_price,2)."/L";        
                    } ?> </span> </h4>
                    <!-- <h5 class="m-b-20"><?php //echo date("D jS F Y")?></h5> -->
                </div>
            </div>
        </div>
                <?php 
                // code...
            }
         }
          ?>
        <!-- PMS end -->
        <!-- HTML (DOM) Sourced Data table start -->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                	<button type="button" class="btn btn-success" data-toggle="modal" data-target="#readMeterNumModal"><i class="fas fa-gas-pump"></i> Meter Allocation</button> || <a href="sales_history"><button type="button" class="btn btn-primary btn-md btn-rounded"><i class="fas fa-shopping-cart"></i> View Sales History</button></a> 
                </div>
                <div class="card-body">
                    <div class="dt-responsive table-responsive">
                        <table id="report-table" class="table table-striped nowrap">
                            <thead class="text-center">
                                <tr>
                                     <th>Attendant</th>
                                     <th>Fuel </th>
                                      <th>Pump No</th>
                                       <th>Price/L</th>
                                    <th>(Before Sales <span class="fas fa-gas-pump text-c-blue"></span>)</th>
                                   
                                    <th>(After Sales <span class="fas fa-gas-pump text-c-red"></span>)</th>
                                    <th>Sold(Ltrs)</th>
                                    <th>Amount(&#8358;)</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                  <?php $all_allocation = $Actions->fetch_all_allocation(); 

                                if ($all_allocation) {
                                    foreach ($all_allocation as $allocate) {
                                       // print_r($allocate);
                                        ?>
                                <tr>
                                    <td><?php  
                                     echo $allocate->full_name;?></td>
                                    <td><?php  
                                     echo $allocate->fuel_type;?></td>
                                     <td><?php
                                      echo ucwords($allocate->pump_desc);?></td>
                                      <td>&#8358;<?php echo number_format($allocate->price_per_litre,2);?></td>
                                    <td><?php echo $allocate->before_sales; ?></td>
                                   
                                    <td><?php if ($allocate->after_sales ==NULL): ?>
                                    <span class="badge badge-warning badge-lg">Pending</span>
                                        <?php else: ?>
                                            <?php echo $allocate->after_sales; ?>
                                    <?php endif ?> </td>
                                    <td><?php if ($allocate->volume_sold ==NULL): ?>
                                    <span class="badge badge-warning badge-lg">Pending</span>
                                        <?php else: ?>
                                            <?php echo number_format($allocate->volume_sold,2); ?>
                                    <?php endif ?></td>
                                     <td><?php if ($allocate->total_amount ==NULL): ?>
                                    <span class="badge badge-warning badge-lg">Pending</span>
                                        <?php else: ?>
                                            &#8358;<?php echo number_format($allocate->total_amount,2); ?>
                                    <?php endif ?></td>

                                    <td><?php if ($allocate->volume_sold==NULL || $allocate->volume_sold ==""): ?>
                                        <button type="button" class="btn btn-success btn-sm btn-round update_allocate_pump_btn" data-id="<?php echo $allocate->aId;?>"><i class="fas fa-binoculars"></i> Update</button>
                                    <?php else: ?>
                                         <button type="button" class="btn btn-danger btn-sm btn-round disabled" disabled style="cursor: not-allowed;"><i class="fas fa-eye-slash"></i> Update</button>
                                    <?php endif ?></td>
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
		<div class="modal fade" id="readMeterNumModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h2 class="modal-title" id="exampleModalLabel"><i class="fas fa-gas-pump"></i> Record Meter </h2>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								</div>
                                <div id="server_response_"></div>
								<form id="assign_meter_pump_form">
								<div class="modal-body">
									 <div class="row">
                            <div class="col-md-6">
                                <input type="hidden" name="action" value="assign_meter_to_staff">
                                <div class="form-group">
                                    <label for="pump">Select Pump <span class="fas fa-gas-pump"></span></label>
                                     <select name="pump_id" id="pump_id_" class="custom-select">
                                    	<option value="">Choose...</option>
                                    	<?php $Actions->fetch_pumps_in_dropdown();?>
                                    </select>
                                </div>
                            </div>
                             <div class="col-md-6">
                                <div class="form-group">
                                    <!-- fas fa-thermometer-half -->
                                    <input type="hidden" name="fuel_id" id="my_fuel_id">
                                    <label for="f_type">Fuel Type <span class="fas fa-tachometer-alt"></span></label>
                                    <input type="text" class="form-control" name="f_type" id="f_type" readonly>
                                </div>
                            </div>
                             <div class="col-md-6">
                                <div class="form-group">
                                    <!-- fas fa-thermometer-half -->
                                    <label for="per_litre_price">Today's Price <span class="fas fa-tachometer-alt"></span></label>
                                    <input type="text" class="form-control" name="fuel_price" id="per_litre_price" readonly>
                                </div>
                            </div>
                             <div class="col-md-6">
                                <div class="form-group">
                                	<!-- fas fa-thermometer-half -->
                                    <label for="cmr">Current Reading <span class="fas fa-tachometer-alt"></span></label>
                                    <input type="text" autocomplete="off" class="form-control" name="cmr" id="cmr" placeholder="current meter read">
                                </div>
                            </div>
                        
                             <div class="col-md-12">
                                <div class="form-group">
                                  <label for="attendant"><span class="text-c-red">Assign this Pump to <i class="fas fa-user-clock"></i></span></label>
                                   <select name="attendant" id="attendant" class="custom-select">
                                    	<option value="">Choose...</option>
                                    	<?php echo $Actions->staff_in_dropdown();?>
                                    </select>
                                </div>
                            </div>
                        </div>
										
								</div>
								<div class="modal-footer">
									<button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-success __loading_btn__">Submit Record</button>
								</div>
							</form>
							</div>
						</div>
					</div>
		<!-- [ varying-modal ] end -->
        <?php include_once("Inc/update_meter_reading_modal.php") ?>

<!-- Required Js -->
<script src="assets/js/vendor-all.min.js"></script>
<script src="assets/js/plugins/bootstrap.min.js"></script>
<script src="assets/js/ripple.js"></script>
<script src="assets/js/pcoded.min.js"></script>
<!-- <script src="assets/js/menu-setting.min.js"></script> -->


<!-- datatable Js -->
<script src="assets/js/plugins/jquery.dataTables.min.js"></script>
<script src="assets/js/plugins/dataTables.bootstrap4.min.js"></script>
<!-- datepicker js -->
<script src="assets/js/plugins/moment.min.js"></script>
<script src="assets/js/plugins/daterangepicker.js"></script>
<script src="assets/js/pages/ac-datepicker.js"></script>


<script src="assets/js/pages/data-source-custom.js"></script>

<script>
$(document).ready(function(){
    $("#after_sales_").on("keyup change", function(){
    let u_bsales = parseInt($("#u_bsales").val());
    let perLitre =  parseInt($("#u_litre_price").val());
    let volume_sold,amount_make,sum;
    let curReading = parseInt($(this).val());
    if (curReading.length>0 || curReading!="") {
        if ((curReading > u_bsales)) {
             volume_sold = (curReading - u_bsales);
              amount_make =(volume_sold*perLitre);
              $("#u_sold_litre").val(volume_sold);
              $("#u_money_make").val(amount_make.toFixed(2));
        //console.log(volume_sold)
         }else{
       $("#u_sold_litre").val(1*0);
        $("#u_money_make").val(1*0);
         }
    }
    })
    //update alocation
    $(".update_allocate_pump_btn").on("click", function(){
        let Id = $(this).data("id");
        let action ="fetch_allo_by_Id";
        $.ajax({
            url:"Repository/Helpers/helper",
            type:"POST",
            data:{action:action,Id:Id},
            dataType:"json",
            success:function(data_res){
                //console.log(data_res);
        $("#u_litre_price").val(data_res.price_per_litre);
        $("#u_bsales").val(data_res.before_sales);
        $("#u_fuel_type").val(data_res.fuel_type);
        $("#u_pump_desc").val(data_res.pump_desc);
        $("#u_attendant_id").val(data_res.attendant_id);
        $("#u_aid_id").val(data_res.aId);
        $("#u_fuel_id").val(data_res.fId);
        $("#u_pump_id").val(data_res.pumpId);
            $("#update_meter_reading").modal("show");
            }
        });
    })
	
    //when fuel type is selected grap the id and fetch price by it
    let pump_id_ = $("#pump_id_");
    pump_id_.on("change",function(){
        let id_val = $(this).val();
        //send to helpers/helper
        $.ajax({
            url:"Repository/Helpers/helper",
            type:"POST",
            data:{action:'show_litre_price',id:id_val},
            dataType:"json",
            success:function(data){
                if (data.fuel_type!='' && data.litre_price!="") {
                    //console.log(data);
                $("#f_type").val(data.fuel_type);
                $("#per_litre_price").val(data.litre_price);
                $("#my_fuel_id").val(data.fId);
            }else{
                $("#f_type").val('');
                $("#per_litre_price").val('');
            }
            }
        });

    });
    //when allocate btn is clicked
    //assign_meter_pump_form
     const assign_meter_pump_form =  $("#assign_meter_pump_form");
assign_meter_pump_form.on("submit",function(e){
e.preventDefault();
//send request
$(".__loading_btn__").html('<img src="asset/loaders/rolling_loader.svg" width="30" alt="loading"> Processing...');
$.post("Repository/Helpers/helper",assign_meter_pump_form.serialize(),function(result){
setTimeout(()=>{
$(".__loading_btn__").html('Submit Record');
$("#server_response_").html(result);
},2500);
})
});
//update attendant today sales
const submit_updated_sales_form =  $("#submit_updated_sales_form");
submit_updated_sales_form.on("submit",function(event){
event.preventDefault();
//send request
$(".__loading_btn__").html('<img src="asset/loaders/rolling_loader.svg" width="30" alt="loading"> Processing...');
$.post("Repository/Helpers/helper",submit_updated_sales_form.serialize(),function(data_result){
setTimeout(()=>{
$(".__loading_btn__").html('Submit Sales');
$(".server_response_").html(data_result);
},2500);
})
});
});
</script>

</body>

</html>
