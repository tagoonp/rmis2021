<?php 
session_start();
header('Location: ./application/html/core/system/continuing/'.$_SESSION['rmis_role'].'/');
?>