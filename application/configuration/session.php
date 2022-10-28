<?php 
if(!isset($_SESSION['rmis_uid'])){
    header('Location: '.RMIS_DOMAIN );
    // echo "UID";
    die();
}

if($_SESSION['rmis_id'] != session_id()){
    header('Location: '.RMIS_DOMAIN );
    // echo "SID";
    die();
}

if(!$_SESSION['rmis_role']){
    header('Location: '.RMIS_DOMAIN );
    // echo "ROLE";
    die();
}


?>