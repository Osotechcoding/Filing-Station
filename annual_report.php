<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from ableproadmin.com/bootstrap/default/invoice-list.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 21 Jan 2022 10:43:22 GMT -->
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
<section class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Invoice List</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index-2.html"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Invoice</a></li>
                            <li class="breadcrumb-item"><a href="#!">Invoice List</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
           
            <!-- [ Invoice-right ] start -->
            <div class="col-xl-12 col-lg-12 filter-bar invoice-list">
                <nav class="navbar m-b-30 p-10">
                    <ul class="nav">
                        <li class="nav-item f-text active">
                            <a class="nav-link text-secondary" href="#!">Filter: <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-secondary" href="#" id="bydate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="far fa-clock"></i> By Date</a>
                            <div class="dropdown-menu" aria-labelledby="bydate">
                                <a class="dropdown-item" href="#!">Show all</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#!">Today</a>
                                <a class="dropdown-item" href="#!">Yesterday</a>
                                <a class="dropdown-item" href="#!">This week</a>
                                <a class="dropdown-item" href="#!">This month</a>
                                <a class="dropdown-item" href="#!">This year</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-secondary" href="#" id="bystatus" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-chart-line"></i> By Status</a>
                            <div class="dropdown-menu" aria-labelledby="bystatus">
                                <a class="dropdown-item" href="#!">Show all</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#!">Open</a>
                                <a class="dropdown-item" href="#!">On hold</a>
                                <a class="dropdown-item" href="#!">Resolved</a>
                                <a class="dropdown-item" href="#!">Closed</a>
                                <a class="dropdown-item" href="#!">Dublicate</a>
                                <a class="dropdown-item" href="#!">Wontfix</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-secondary" href="#" id="bypriority" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-list-ol"></i> By Priority</a>
                            <div class="dropdown-menu" aria-labelledby="bypriority">
                                <a class="dropdown-item" href="#!">Show all</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#!">Highest</a>
                                <a class="dropdown-item" href="#!">High</a>
                                <a class="dropdown-item" href="#!">Normal</a>
                                <a class="dropdown-item" href="#!">Low</a>
                            </div>
                        </li>
                    </ul>
                    <div class="nav-item nav-grid f-view">
                        <span class="m-r-15">View Mode: </span>
                        <button type="button" class="btn waves-effect waves-light btn-primary btn-icon m-0" data-toggle="tooltip" data-placement="top" title="list view">
                            <i class="fas fa-list-ul"></i>
                        </button>
                        <button type="button" class="btn waves-effect waves-light btn-primary btn-icon m-0" data-toggle="tooltip" data-placement="top" title="grid view">
                            <i class="fas fa-th-large"></i>
                        </button>
                    </div>
                </nav>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="card card-border-c-blue">
                            <div class="card-body">
                                <div class="mb-3">
                                    <h5 class="d-inline-block m-b-10">John Doe</h5>
                                    <div class="dropdown-secondary dropdown float-right">
                                        <span>Status : </span>
                                        <button class="btn waves-effect waves-light btn-primary btn dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Overdue</button>
                                        <div class="dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                            <a class="dropdown-item" href="#!">Pending</a>
                                            <a class="dropdown-item" href="#!">Paid</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item active" href="#!">On Hold</a>
                                            <a class="dropdown-item" href="#!">Canceled</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <ul class="list list-unstyled">
                                            <li>Invoice #: &nbsp;0028</li>
                                            <li>Issued on: <span class="text-semibold">2015/01/25</span></li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-6">
                                        <ul class="list list-unstyled text-right">
                                            <li>$8,750</li>
                                            <li>Method: <span class="text-semibold">SWIFT</span></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="m-t-30">
                                    <div class="task-list-table">
                                        <p class="task-due"><strong> Due : </strong><strong class="label label-primary">23 hours</strong></p>
                                    </div>
                                    <div class="task-board m-0 float-right">
                                        <a href="invoice.html" class="btn waves-effect waves-light btn-primary"><i class="fas fa-eye m-0"></i></a>
                                        <div class="dropdown-secondary dropdown d-inline">
                                            <button class="btn waves-effect waves-light btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-bars"></i></button>
                                            <div class="dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                                <a class="dropdown-item" href="#!"><i class="fas fa-bell mr-2"></i>Print Invoice</a>
                                                <a class="dropdown-item" href="#!"><i class="fas fa-download mr-2"></i>Download invoice</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="#!"><i class="fas fa-edit mr-2"></i>Edit Invoice</a>
                                                <a class="dropdown-item" href="#!"><i class="fas fa-trash mr-2"></i>Remove Invoice</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="card card-border-c-green">
                            <div class="card-body">
                                <div class="mb-3">
                                    <h5 class="d-inline-block m-b-10">John Doe</h5>
                                    <div class="dropdown-secondary dropdown float-right">
                                        <span>Status : </span>
                                        <button class="btn waves-effect waves-light btn-success btn dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Overdue</button>
                                        <div class="dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                            <a class="dropdown-item" href="#!">Pending</a>
                                            <a class="dropdown-item" href="#!">Paid</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item active" href="#!">On Hold</a>
                                            <a class="dropdown-item" href="#!">Canceled</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <ul class="list list-unstyled">
                                            <li>Invoice #: &nbsp;0028</li>
                                            <li>Issued on: <span class="text-semibold">2015/01/25</span></li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-6">
                                        <ul class="list list-unstyled text-right">
                                            <li>$8,750</li>
                                            <li>Method: <span class="text-semibold">Payoneer</span></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="m-t-30">
                                    <div class="task-list-table">
                                        <p class="task-due"><strong> Due : </strong><strong class="label label-success">23 hours</strong></p>
                                    </div>
                                    <div class="task-board m-0 float-right">
                                        <a href="invoice.html" class="btn waves-effect waves-light btn-success"><i class="fas fa-eye m-0"></i></a>
                                        <div class="dropdown-secondary dropdown d-inline">
                                            <button class="btn waves-effect waves-light btn-success dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-bars"></i></button>
                                            <div class="dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                                <a class="dropdown-item" href="#!"><i class="fas fa-bell mr-2"></i>Print Invoice</a>
                                                <a class="dropdown-item" href="#!"><i class="fas fa-download mr-2"></i>Download invoice</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="#!"><i class="fas fa-edit mr-2"></i>Edit Invoice</a>
                                                <a class="dropdown-item" href="#!"><i class="fas fa-trash mr-2"></i>Remove Invoice</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="card card-border-c-red">
                            <div class="card-body">
                                <div class="mb-3">
                                    <h5 class="d-inline-block m-b-10">John Doe</h5>
                                    <div class="dropdown-secondary dropdown float-right">
                                        <span>Status : </span>
                                        <button class="btn waves-effect waves-light btn-danger btn dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Overdue</button>
                                        <div class="dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                            <a class="dropdown-item" href="#!">Pending</a>
                                            <a class="dropdown-item" href="#!">Paid</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item active" href="#!">On Hold</a>
                                            <a class="dropdown-item" href="#!">Canceled</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <ul class="list list-unstyled">
                                            <li>Invoice #: &nbsp;0028</li>
                                            <li>Issued on: <span class="text-semibold">2015/01/25</span></li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-6">
                                        <ul class="list list-unstyled text-right">
                                            <li>$8,750</li>
                                            <li>Method: <span class="text-semibold">Paypal</span></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="m-t-30">
                                    <div class="task-list-table">
                                        <p class="task-due"><strong> Due : </strong><strong class="label label-danger">23 hours</strong></p>
                                    </div>
                                    <div class="task-board m-0 float-right">
                                        <a href="invoice.html" class="btn waves-effect waves-light btn-danger"><i class="fas fa-eye m-0"></i></a>
                                        <div class="dropdown-secondary dropdown d-inline">
                                            <button class="btn waves-effect waves-light btn-danger dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-bars"></i></button>
                                            <div class="dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                                <a class="dropdown-item" href="#!"><i class="fas fa-bell mr-2"></i>Print Invoice</a>
                                                <a class="dropdown-item" href="#!"><i class="fas fa-download mr-2"></i>Download invoice</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="#!"><i class="fas fa-edit mr-2"></i>Edit Invoice</a>
                                                <a class="dropdown-item" href="#!"><i class="fas fa-trash mr-2"></i>Remove Invoice</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="card card-border-c-yellow">
                            <div class="card-body">
                                <div class="mb-3">
                                    <h5 class="d-inline-block m-b-10">John Doe</h5>
                                    <div class="dropdown-secondary dropdown float-right">
                                        <span>Status : </span>
                                        <button class="btn waves-effect waves-light btn-warning btn dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Overdue</button>
                                        <div class="dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                            <a class="dropdown-item" href="#!">Pending</a>
                                            <a class="dropdown-item" href="#!">Paid</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item active" href="#!">On Hold</a>
                                            <a class="dropdown-item" href="#!">Canceled</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <ul class="list list-unstyled">
                                            <li>Invoice #: &nbsp;0028</li>
                                            <li>Issued on: <span class="text-semibold">2015/01/25</span></li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-6">
                                        <ul class="list list-unstyled text-right">
                                            <li>$8,750</li>
                                            <li>Method: <span class="text-semibold">Paypal</span></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="m-t-30">
                                    <div class="task-list-table">
                                        <p class="task-due"><strong> Due : </strong><strong class="label label-warning">23 hours</strong></p>
                                    </div>
                                    <div class="task-board m-0 float-right">
                                        <a href="invoice.html" class="btn waves-effect waves-light btn-warning"><i class="fas fa-eye m-0"></i></a>
                                        <div class="dropdown-secondary dropdown d-inline">
                                            <button class="btn waves-effect waves-light btn-warning dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-bars"></i></button>
                                            <div class="dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                                <a class="dropdown-item" href="#!"><i class="fas fa-bell mr-2"></i>Print Invoice</a>
                                                <a class="dropdown-item" href="#!"><i class="fas fa-download mr-2"></i>Download invoice</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="#!"><i class="fas fa-edit mr-2"></i>Edit Invoice</a>
                                                <a class="dropdown-item" href="#!"><i class="fas fa-trash mr-2"></i>Remove Invoice</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="card card-border-c-green">
                            <div class="card-body">
                                <div class="mb-3">
                                    <h5 class="d-inline-block m-b-10">John Doe</h5>
                                    <div class="dropdown-secondary dropdown float-right">
                                        <span>Status : </span>
                                        <button class="btn waves-effect waves-light btn-success btn dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Overdue</button>
                                        <div class="dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                            <a class="dropdown-item" href="#!">Pending</a>
                                            <a class="dropdown-item" href="#!">Paid</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item active" href="#!">On Hold</a>
                                            <a class="dropdown-item" href="#!">Canceled</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <ul class="list list-unstyled">
                                            <li>Invoice #: &nbsp;0028</li>
                                            <li>Issued on: <span class="text-semibold">2015/01/25</span></li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-6">
                                        <ul class="list list-unstyled text-right">
                                            <li>$8,750</li>
                                            <li>Method: <span class="text-semibold">Payoneer</span></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="m-t-30">
                                    <div class="task-list-table">
                                        <p class="task-due"><strong> Due : </strong><strong class="label label-success">23 hours</strong></p>
                                    </div>
                                    <div class="task-board m-0 float-right">
                                        <a href="invoice.html" class="btn waves-effect waves-light btn-success"><i class="fas fa-eye m-0"></i></a>
                                        <div class="dropdown-secondary dropdown d-inline">
                                            <button class="btn waves-effect waves-light btn-success dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-bars"></i></button>
                                            <div class="dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                                <a class="dropdown-item" href="#!"><i class="fas fa-bell mr-2"></i>Print Invoice</a>
                                                <a class="dropdown-item" href="#!"><i class="fas fa-download mr-2"></i>Download invoice</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="#!"><i class="fas fa-edit mr-2"></i>Edit Invoice</a>
                                                <a class="dropdown-item" href="#!"><i class="fas fa-trash mr-2"></i>Remove Invoice</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="card card-border-c-blue">
                            <div class="card-body">
                                <div class="mb-3">
                                    <h5 class="d-inline-block m-b-10">John Doe</h5>
                                    <div class="dropdown-secondary dropdown float-right">
                                        <span>Status : </span>
                                        <button class="btn waves-effect waves-light btn-primary btn dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Overdue</button>
                                        <div class="dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                            <a class="dropdown-item" href="#!">Pending</a>
                                            <a class="dropdown-item" href="#!">Paid</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item active" href="#!">On Hold</a>
                                            <a class="dropdown-item" href="#!">Canceled</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <ul class="list list-unstyled">
                                            <li>Invoice #: &nbsp;0028</li>
                                            <li>Issued on: <span class="text-semibold">2015/01/25</span></li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-6">
                                        <ul class="list list-unstyled text-right">
                                            <li>$8,750</li>
                                            <li>Method: <span class="text-semibold">SWIFT</span></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="m-t-30">
                                    <div class="task-list-table">
                                        <p class="task-due"><strong> Due : </strong><strong class="label label-primary">23 hours</strong></p>
                                    </div>
                                    <div class="task-board m-0 float-right">
                                        <a href="invoice.html" class="btn waves-effect waves-light btn-primary"><i class="fas fa-eye m-0"></i></a>
                                        <div class="dropdown-secondary dropdown d-inline">
                                            <button class="btn waves-effect waves-light btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-bars"></i></button>
                                            <div class="dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                                <a class="dropdown-item" href="#!"><i class="fas fa-bell mr-2"></i>Print Invoice</a>
                                                <a class="dropdown-item" href="#!"><i class="fas fa-download mr-2"></i>Download invoice</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="#!"><i class="fas fa-edit mr-2"></i>Edit Invoice</a>
                                                <a class="dropdown-item" href="#!"><i class="fas fa-trash mr-2"></i>Remove Invoice</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Invoice-right ] end -->
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

<!-- invoice-list js -->
<script src="assets/js/pages/invoice-list.js"></script>

</body>
</html>
