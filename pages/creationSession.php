<?php
session_start();
if (isset($_POST['login']) && isset($_POST['password']) && isset($_POST['statut'])) {
			$_SESSION['login']=$_POST['login'];
			$_SESSION['password']=$_POST['password'];
			$_SESSION['statut']=$_POST['statut'];
			header("Location:../index.php");
}else{
			header("Location:logout.php");
}


?>