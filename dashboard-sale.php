<!DOCTYPE html>
<html lang="en">

<head>
    <title>Ablepro v8.0 bootstrap admin template by Phoenixcoded</title>
    <!-- HTML5 Shim and Respond.js IE11 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 11]>
    	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    	<![endif]-->
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
                            <h5 class="m-b-10">Dashboard sale</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index-2.html"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Dashboard sale</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- seo analytics start -->
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3>20500</h3>
                        <p class="text-muted">PMS Analysis</p>
                        <div id="seo-anlytics1"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3>20500</h3>
                        <p class="text-muted">AGO Analysis</p>
                        <div id="seo-anlytics2"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3>28000</h3>
                        <p class="text-muted">DPK Analysis</p>
                        <div id="seo-anlytics3"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3>59600</h3>
                        <p class="text-muted">OTHERS Analysis</p>
                        <div id="seo-anlytics4"></div>
                    </div>
                </div>
            </div>
            <!-- seo analytics end -->
           
            <div class="col-lg-12 col-md-12">
                <div class="card table-card latest-activity-card">
                    <div class="card-header">
                        <h5>Today's Sales History</h5>
                        <div class="card-header-right">
                            <div class="btn-group card-option">
                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="feather icon-more-horizontal"></i>
                                </button>
                                <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                    <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i> maximize</span><span style="display:none"><i class="feather icon-minimize"></i> Restore</span></a></li>
                                    <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i> collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a></li>
                                    <li class="dropdown-item reload-card"><a href="#!"><i class="feather icon-refresh-cw"></i> reload</a></li>
                                    <li class="dropdown-item close-card"><a href="#!"><i class="feather icon-trash"></i> remove</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover table-borderless mb-0">
                                <thead>
                                    <tr>
                                        <th>Pump No</th>
                                        <th>Attendant</th>
                                        <th>Type</th>
                                        <th>Start</th>
                                        <th>Current</th>
                                        <th>Per Litre</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>John Deo</td>
                                        <td>#814123</td>
                                        <td>#814123</td>
                                        <td><img src="assets/images/widget/PHONE1.jpg" alt="" class="img-fluid"></td>
                                        <td>Moto G5</td>
                                        <td>10</td>
                                      
                                        <td><label class="badge badge-light-warning">Pending</label></td>
                                        <td><a href="#!"><i class="icon feather icon-edit f-w-600 f-16 m-r-15 text-c-green"></i></a><a href="#!"><i class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i></a></td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Latest Order end -->
            <!-- order  start -->
            <div class="col-md-12 col-xl-4">
                <div class="card bg-c-yellow order-card">
                    <div class="card-body">
                        <h6 class="text-white">Revenue</h6>
                        <h2 class="text-white">$42,562</h2>
                        <p class="m-b-0">$5,032 <i class="feather icon-arrow-up m-l-10"></i></p>
                        <i class="card-icon feather icon-filter"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card bg-c-blue order-card">
                    <div class="card-body">
                        <h6 class="text-white">Orders Received</h6>
                        <h2 class="text-white">486</h2>
                        <p class="m-b-0">$5,032 <i class="feather icon-arrow-up m-l-10 m-r-10"></i>$1,055 <i class="feather icon-arrow-down"></i></p>
                        <i class="card-icon feather icon-users"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card bg-c-green order-card">
                    <div class="card-body">
                        <h6 class="text-white">Total Sales</h6>
                        <h2 class="text-white">1641</h2>
                        <p class="m-b-0">$5,032 <i class="feather icon-arrow-down m-l-10 m-r-10"></i>$1,055 <i class="feather icon-arrow-up"></i></p>
                        <i class="card-icon feather icon-radio"></i>
                    </div>
                </div>
            </div>
            <!-- order  end -->

            <!-- Latest Customers end -->
        </div>
        <!-- [ Main Content ] end -->

    </div>
</div>
<!-- [ Main Content ] end -->


    <!-- Required Js -->
    <script src="assets/js/vendor-all.min.js"></script>
    <script src="assets/js/plugins/bootstrap.min.js"></script>
    <script src="assets/js/ripple.js"></script>
    <script src="assets/js/pcoded.min.js"></script>
	<!-- <script src="assets/js/menu-setting.min.js"></script> -->

<!-- Apex Chart -->
<script src="assets/js/plugins/apexcharts.min.js"></script>


<!-- custom-chart js -->
<script src="assets/js/pages/dashboard-sale.js"></script>
</body>

</html>
