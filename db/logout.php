<?php 
session_start();
$_SESSION['active']=null;
session_destroy();
header("Location: ../index.php");
?>