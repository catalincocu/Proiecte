<?phprequire('interog.inc');session_start();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>Administrare - Aplicatie web pentru agentie de turism</title><link rel="stylesheet" type="text/css" href="style.css" /><link href='http://fonts.googleapis.com/css?family=Belgrano' rel='stylesheet' type='text/css'><!-- jQuery file --><script src="js/jquery.min.js"></script><script src="js/jquery.tabify.js" type="text/javascript" charset="utf-8"></script><script type="text/javascript">var $ = jQuery.noConflict();$(function() {$('#tabsmenu').tabify();$(".toggle_container").hide(); $(".trigger").click(function(){	$(this).toggleClass("active").next().slideToggle("slow");	return false;});});</script></head><body><div id="panelwrap">  		<div class="header">    <div class="title"><a href="panou.php">Panou de administrare</a></div>        <div class="header_right">	<?php				if (isset($_SESSION["okadmin"]))				{				printf("<a href=\"profil.php\">Buna %s,</a>",$_SESSION["useradmin"]);				printf("<a href=\"logout.php\" class=\"logout\">Deconectare</a>");				}		?> 	</div>    <div class="menu">    <ul>    <li><a href="administrarehoteluri.php">Hoteluri</a></li>    <li><a href="administrareoferte.php">Oferte</a></li>    <li><a href="administrareutilizatori.php">Utilizatori</a></li>    <li><a href="administrarelocalitati.php" class="selected">Localitati</a></li>    <li><a href="administrarecompanii.php">Companii</a></li>	<li><a href="administrarebileteavion.php">Bilete achizitionate</a></li>    </ul>    </div>    </div>    <div class="submenu">    <ul>	<li><a href="administrarelocalitati.php" class="selected">administrare localitati</a></li>    <li><a href="adaugarelocalitate.php">adaugare localitate</a></li>    </ul>    </div>                           <div class="center_content">  <?php if (isset($_GET['sterge']))			{				$idlocalitate = $_GET['idlocalitate'];				if (($nr1 = InterogareSQL("select idlocalitate from pf_hoteluri where idlocalitate=".$idlocalitate.";",$rez1)) != 0)					printf("<h3>Localitatea nu poate fi stearsa! Numele localitatii este folosit in adresa unui hotel!</h3>");				else					{						if (($nr1 = InterogareSQL("select idlocplecare,idlocsosire from pf_oferteexcursii where idlocplecare=".$idlocalitate." or idlocsosire=".$idlocalitate.";",$rez1)) != 0)							printf("<h3>Localitatea nu poate fi stearsa! Numele localitatii este folosit in traseul unei oferte!</h3>");						else							InterogareSQL("delete from pf_localitati where idlocalitate=".$idlocalitate.";",$rez1);					}			} ?>    <div id="right_wrap">    <div id="right_content">     <?phpif (!isset($_GET['editeaza']))	{ ?>	    <h2>Lista localitatilor</h2> <table id="rounded-corner">    <thead>    	<tr>        	<th></th>            <th>Nume</th>            <th>Tara</th>            <th>Editare</th>            <th>Stergere</th>        </tr>    </thead>    <tfoot>    	<tr>        	<td colspan="12"> </td>        </tr>    </tfoot>    <tbody>		<?php			if (($nr1 = InterogareSQL("select a.idlocalitate,a.nume,a.tara from pf_localitati a;",$rez1)) != 0)					{						for ($i=0;$i<$nr1;$i++)							{								$linie1 = CitesteLinie($rez1,$i);								printf("<tr class=\"odd\">");								printf("<td><input type=\"checkbox\" name=\"checkbox\" value=\"%s\" /></td>",$linie1[0]);								printf("<td>%s</td>",$linie1[1]);								printf("<td>%s</td>",$linie1[2]);								printf("<td><a href=\"administrarelocalitati.php?editeaza=1&idlocalitate=%s\"><img src=\"images/edit.png\" border=\"0\" /></a></td>",$linie1[0]);								printf("<td><a href=\"administrarelocalitati.php?sterge=1&idlocalitate=%s\"><img src=\"images/trash.gif\" border=\"0\" /></a></td>",$linie1[0]);								printf("</tr>");							}					} ?>    </tbody></table>	<?php		}		if (isset($_GET['salveaza']))			{ 			$numelocalitate = $_GET['numelocalitate'];			$tara = $_GET['tara'];			$idlocalitate = $_GET['idlocalitate'];			InterogareSQL("update pf_localitati set nume='".$numelocalitate."',tara='".$tara."' where idlocalitate=".$idlocalitate.";",$nr2);			} 		if (isset($_GET['editeaza']))			{ ?>		<ul id="tabsmenu" class="tabsmenu">        <li class="active"><a href="#">Editare localitate</a></li>		</ul>		<div id="tab1" class="tabcontent">        <h3> </h3>		<form id="form1" method="get" target="administrarelocalitati.php">        <div class="form">		<?php				$idlocalitate = $_GET['idlocalitate'];				if (($nr1 = InterogareSQL("select a.idlocalitate,a.nume,a.tara from pf_localitati a where a.idlocalitate=".$idlocalitate.";",$rez1)) != 0)				{					$linie1 = CitesteLinie($rez1,0);					printf("<div class=\"form_row\">");					printf("<label>Nume:</label>");					printf("<input type=\"text\" class=\"form_input\" name=\"numelocalitate\" value=\"%s\" />",$linie1[1]);					printf("</div>");					printf("<div class=\"form_row\">");					printf("<label>Tara:</label>");					printf("<input type=\"text\" class=\"form_input\" name=\"tara\" value=\"%s\" />",$linie1[2]);					printf("<input type=\"hidden\" class=\"form_val\" name=\"idlocalitate\" value=\"%s\" />",$linie1[0]);					printf("</div>");				} ?>                 <input type="submit" name="salveaza" class="form_submit" value="Salveaza" onclick="this.form.target='_self';return true;" />        </div> 		</form>        <div class="clear"></div>        </div>		<?php			} 			?>    </div>    </div>  </div><!-- end of right content-->     <div class="clear"></div>    </div> <!--end of center_content-->        <div class="footer">Prelipcean Florin Vasile - Universitatea Stefan cel Mare Suceava - Facultatea de Inginerie Electrica si Stiinta Calculatoarelor </div></div></body></html>