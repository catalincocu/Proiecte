<?php
session_start();
session_destroy();
if (isset($_GET['pgid']))
	$pgid = $_GET['pgid'];
if ($pgid == 'm')
	header("location:manastiri.php");
if ($pgid == 'mz')
	header("location:muzee.php");
if ($pgid == 'rz')
	header("location:rezervatii.php");
if ($pgid == 'p')
	header("location:pensiuni.php");
if ($pgid == 'r')
	header("location:restaurante.php");
if ($pgid == 'i')
	header("location:index.php");
?>