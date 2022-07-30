<?php 
require_once 'Repository/Classes/Session.php';
require_once 'Repository/Classes/Actions.php';
@Session::init();
$Actions = new Actions();
if (isset($_GET['action'])) {
    // code...
    if ($_GET['action'] ==="logout") {
        // code...
        $Actions->logout();
    }
    else{
        $Actions->url_redirect_root('./?logout-failed');
        //echo $Actions->alert_msg("Error:","<h3 style='color:red'>Logout Failed, Please try again...</h3> <a href='./'>Go Home</a>","danger");
    }
}

// to be downloaded=> https://www.youtube.com/watch?v=JLnsWkQ-iB8