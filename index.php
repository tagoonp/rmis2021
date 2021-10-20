<?php 
session_start();
header('Location: ./application/html/core/'.$_SESSION['rmis_role'].'/');
?>