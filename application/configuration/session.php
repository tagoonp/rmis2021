<?php 
if(!isset($_SESSION['rmis_uid'])){
    header('Location: '.RMIS_DOMAIN );
}

if($_SESSION['rmis_id'] != session_id()){
    header('Location: '.RMIS_DOMAIN );
}
?>