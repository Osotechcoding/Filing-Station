<?php 
require_once "Repository/Classes/Session.php";
require_once "Repository/Classes/Actions.php";
@Session::init();
@Session::check_admin_token();
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Pumps - PSMS</title>
   
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
                        <h5><button type="button" class="btn btn-secondary btn-md btn-round" data-toggle="modal" data-target="#add_fuel_modal"><i class="fas fa-gas-pump"></i> Add Pump </button></h5>
                    </div>
                    <div class="card-body">
                        <div class="dt-responsive table-responsive">
                            <table class="table table-striped nowrap datatable text-center">
                                <thead>
                                    <tr>
                                    	<th>Pmup Code</th>
                                        <th>Pump Desc</th>
                                        <th>Fuel Type</th>
                                        <th> Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $pump_datas =$Actions->fetch_all_pumps(); 

                                    if ($pump_datas && $pump_datas!=null) {
                                        foreach($pump_datas as $pump_data):?>

                                             <tr>
                                        <td><?php echo strtoupper($pump_data->pcode);?></td>
                                        <td><?php echo strtoupper($pump_data->pump_desc) ?></td>
                                        <td><?php echo strtoupper($pump_data->fuel_type) ?></td>
                                        <td><?php echo date("D jS F, Y",strtotime($pump_data->created_at)) ?></td>
                                        <td><?php 
                                        if ($pump_data->status =='active') {
                                       echo '<span class="badge badge-success">Active</span>';
                                        }elseif ($pump_data->status =='pending') {
                                         echo '<span class="badge badge-warning">Pending</span>';
                                        }elseif ($pump_data->status =='faulty') {
                                       echo '<span class="badge badge-secondary">Faulty</span>';
                                        }else{
                                        echo '<span class="badge badge-danger">Damaged</span>';
                                        }
                                         ?></td>
                                        <td><button type="button" data-id="<?php echo $pump_data->pumpId?>" class="btn btn-success btn-sm show_pump_update_btn"> <i class="fas fa-edit"></i>Edit</button></td>
                                    </tr>
                                        <?php endforeach; 
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
							<div class="modal-dialog modal-dialog-centered modal-md" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h2 class="modal-title" id="exampleModalLabel"><i class="fas fa-gas-pump"></i> Add Pump </h2>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                       
									</div>
                                     <div class="text-center mt-1" id="server-response"></div>
									 <form id="create_pump_form">
                                    <div class="modal-body">
                                         <div class="row">
                                <div class="col-md-6">
                                    <input type="hidden" name="action" value="create_pump_now">
                                    <div class="form-group">
                                        <!-- fas fa-thermometer-half -->
                                        <label for="pump_name">Pump Desc <span class="fas fa-gas-pump"></span></label> 
                                        <input type="text" autocomplete="off" class="form-control" name="pump_name" id="pump_name" placeholder="Pump Name">
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <!-- fas fa-thermometer-half -->
                                        <label for="fid">Fuel Type <span class="fas fa-user-plus"></span></label>
                                        <select name="fid" autocomplete="off" id="fid" class="custom-select">
                                            <option value="">Choose...</option>
                                            <?php echo $Actions->fuel_in_dropdown();?>
                                        </select>
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                    	<!-- fas fa-thermometer-half -->
                                        <label for="pstatus">Pump Status <span class="fas fa-user-plus"></span></label>
                                        <select name="pstatus" id="pstatus" class="custom-select">
                                            <option value="">Choose...</option>
                                            <option value="active">Active</option>
                                            <option value="pending">Pending</option>
                                            <option value="faulty">Faulty</option>
                                            <option value="damaged">Damaged</option>
                                        </select>
                                    </div>
                                </div>
                                
                                 <div class="col-md-6">
                                    <div class="form-group">
                                    	<!-- fas fa-thermometer-half -->
                                        <label for="price">Pump Code <span class="fas fa-diagnoses"></span></label>
                                        <input type="text" autocomplete="off" class="form-control" name="pcode" id="pcode" placeholder="XGT-09">
                                    </div>
                                </div>
                            </div>
											
									</div>
									<div class="modal-footer">
										<button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
										<button type="submit" class="btn  btn-success mb-1 __loading_btn__">Submit </button>
									</div>
								</form>
								</div>
							</div>
						</div>
			<!-- [ varying-modal ] end -->


            <!-- update pump details modal -->
            <!-- [ varying-modal ] start -->
            <div class="modal fade" id="update_pump_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h2 class="modal-title" id="exampleModalLabel"><i class="fas fa-gas-pump"></i> Update Pump </h2>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <div id="server_response_"></div>
                                    <form id="update_pump_form">
                                    <div class="modal-body">
                                <div class="row" id="pump_details">
                                
                                </div>
                                            
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn  btn-success mb-1 __loading_btn__">Save Change </button>
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

    //when submit pump btn is clicked
    //create_pump_form
    const create_pump_form =  $("#create_pump_form");
create_pump_form.on("submit",function(e){
e.preventDefault();
//send request
$(".__loading_btn__").html('<img src="asset/loaders/rolling_loader.svg" width="30" alt="loading"> Processing...');
$.post("Repository/Helpers/helper",create_pump_form.serialize(),function(res){
setTimeout(()=>{
$(".__loading_btn__").html('Submit');
$("#server-response").html(res);
},2500);
})
});
//when edit pump btn is clicked
$(".show_pump_update_btn").on("click", function(){
    let action ='show_pump_update';
    let pump_id = $(this).data("id");
    const pump_data ={action:action,pump_id:pump_id}
    // console.log(action+" "+ pump_id);
    $.post("Repository/Helpers/helper",pump_data,function(data){
        $("#pump_details").html(data);
        $("#update_pump_modal").modal('show');
    })

});

//when save change btn is clicked
//update_pump_form
  const update_pump_form =  $("#update_pump_form");
update_pump_form.on("submit",function(e){
e.preventDefault();
//send request
$(".__loading_btn__").html('<img src="asset/loaders/rolling_loader.svg" width="30" alt="loading"> Processing...');
$.post("Repository/Helpers/helper",update_pump_form.serialize(),function(res){
setTimeout(()=>{
$(".__loading_btn__").html('Save Chnage');
$("#server_response_").html(res);
},2500);
})
});
})
</script>
<!-- https://www.youtube.com/watch?v=TJF4ldO91n4 -->
</body>

</html>
