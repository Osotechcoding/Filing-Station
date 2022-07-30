<?php 
require_once "Repository/Classes/Session.php";
require_once "Repository/Classes/Actions.php";
Session::init();
Session::check_admin_token();
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
                            <h5 class="m-b-10">Bank Savings</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Savings</a></li>
                            <li class="breadcrumb-item"><a href="#!">Bank Savings Management </a></li>
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
                        <h5><button type="button" class="btn btn-secondary btn-md btn-rounded" data-toggle="modal" data-target="#add_bank_saving_modal"><i class="fas fa-money-bill"></i> Bank Saving</button></h5>
                    </div>
                    <div class="card-body">
                        <div class="dt-responsive table-responsive">
                            <table class="table table-striped table-bordered nowrap datatable text-center">
                                <thead>
                                    <tr>
                                    	<th>S/N</th>
                                        <th>Amount</th>
                                        <th>Bank Desc</th>
                                        <th>Short Note</th>
                                        <th>Date</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 

                                    $all_monies = $Actions->fetch_all_saved_money();
                                    if (!empty($all_monies)) {
                                        $cnt =0;
                                        // code...
                                        foreach ($all_monies as $money) {
                                            $cnt++;
                                            ?>
                                             <tr>
                                        <td><?php echo $cnt; ?></td>
                                        <td><?php echo number_format($money->amount,2) ?></td>
                                        <td><?php echo strtoupper($money->bank);?></td>
                                        <td><?php echo ucwords($money->note) ?></td>
                                        <td><?php echo date("D jS F Y",strtotime($money->created_at));?></td>
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
			<div class="modal fade" id="add_bank_saving_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h2 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Enter Details </h2>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									</div>
                                    <div id="server_response"></div>
									<form id="submit_saving_form">
									<div class="modal-body">
									<div class="row">
                                <div class="col-md-6">
                                    <input type="hidden" name="action" value="save_money_now">
                                    <input type="hidden" name="adId" value="<?php echo $_SESSION['ADMIN_ID'] ?>">
                                    <div class="form-group">
                                    <label for="bank_name">Bank Desc <span class="fas fa-briefcase"></span></label>
                                         <select name="bank_name" id="bank_name" class="custom-select">
                                         	<option value="">Choose...</option>
                                        	<option value="First Bank Plc">First Bank Plc</option>
                                        	<option value="UBA Plc">UBA Plc</option>
                                        	<option value="Access Bank Plc">Access Bank Plc</option>
                                        	<option value="GTBank Plc">GTBank Plc</option>
                                        </select>
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                    	<!-- fas fa-thermometer-half -->
                                        <label for="amount_to_bank">Amount taking to Bank <span class="fas fa-money-bill"></span></label>
                                        <input type="text" name="amount_to_bank" class="form-control" id="amount_to_bank" placeholder="Enter Amount Taking to Bank">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    	<!-- fas fa-thermometer-half -->
                                        <label for="note">Note <span class="fas fa-map-marker-alt"></span></label>
                                        <textarea name="note" id="note" class="form-control" placeholder="write note here..."></textarea>
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <!-- fas fa-thermometer-half -->
                                        <label for="passcode">PassCode <span class="fas fa-lock"></span></label>
                                        <input type="text" class="form-control" id="passcode" name="passcode" placeholder="****">
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

    const submit_saving_form =$("#submit_saving_form");

    submit_saving_form.on("submit", function(e){
        e.preventDefault();

       $(".__loading_btn__").html('<img src="asset/loaders/rolling_loader.svg" width="30" alt="loading"> Processing...');
$.post("Repository/Helpers/helper",submit_saving_form.serialize(),function(result){
setTimeout(()=>{
$(".__loading_btn__").html('Submit');
$("#server_response").html(result);
},2500);
})
    })
	$(".datatable").DataTable();
})
</script>

</body>

</html>
