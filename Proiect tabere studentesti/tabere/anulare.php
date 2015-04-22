<?php
require('interog.inc');
session_start();
if (isset($_GET["idbilet"]))
	{
		$idbilet = $_GET["idbilet"];
		InterogareSQL("delete from pf_biletezbor where idbiletzbor=".$idbilet.";",$nr);
		header("location:comenzi.php?uid=".$_SESSION["userid"]);
	}
if (isset($_GET["idsolicitare"]))
	{
		$idsolicitare = $_GET["idsolicitare"];
		InterogareSQL("delete from pf_solicitarioferte where idsolicitare=".$idsolicitare.";",$nr);
		header("location:comenzi.php?uid=".$_SESSION["userid"]);
	}
if (isset($_GET["idrezervare"]))
	{
		$idrezervare = $_GET["idrezervare"];
		InterogareSQL("delete from pf_rezervari where idrezervare=".$idrezervare.";",$nr);
		header("location:comenzi.php?uid=".$_SESSION["userid"]);
	}
?>