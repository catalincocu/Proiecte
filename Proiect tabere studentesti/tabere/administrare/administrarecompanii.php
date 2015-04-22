<?php
require('interog.inc');
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administrare - Aplicatie web pentru agentie de turism</title>
<link rel="stylesheet" type="text/css" href="style.css" />
<link href='http://fonts.googleapis.com/css?family=Belgrano' rel='stylesheet' type='text/css'>
<!-- jQuery file -->
<script src="js/jquery.min.js"></script>
<script src="js/jquery.tabify.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
var $ = jQuery.noConflict();
$(function() {
$('#tabsmenu').tabify();
$(".toggle_container").hide(); 
$(".trigger").click(function(){
	$(this).toggleClass("active").next().slideToggle("slow");
	return false;
});
});
</script>
</head>
<body>
<div id="panelwrap">
  	
	<div class="header">
    <div class="title"><a href="panou.php">Panou de administrare</a></div>
    
    <div class="header_right">
	<?php
				if (isset($_SESSION["okadmin"]))
				{
				printf("<a href=\"profil.php\">Buna %s,</a>",$_SESSION["useradmin"]);
				printf("<a href=\"logout.php\" class=\"logout\">Deconectare</a>");
				}
		?> 
	</div>
    <div class="menu">
    <ul>
    <li><a href="administrarehoteluri.php">Hoteluri</a></li>
    <li><a href="administrareoferte.php">Oferte</a></li>
    <li><a href="administrareutilizatori.php">Utilizatori</a></li>
    <li><a href="administrarelocalitati.php">Localitati</a></li>
    <li><a href="administrarecompanii.php" class="selected">Companii</a></li>
	<li><a href="administrarebileteavion.php">Bilete achizitionate</a></li>
    </ul>
    </div>
    </div>
    <div class="submenu">
    <ul>
	<li><a href="administrarecompanii.php" class="selected">administrare companie</a></li>
    <li><a href="adaugarecompanie.php">adaugare companie</a></li>
    </ul>
    </div>                       
    <div class="center_content">  
<?php
 if (isset($_GET['sterge']))
			{
				$idcompanie = $_GET['idcompanie'];
				if (($nr1 = InterogareSQL("select idcompanie from pf_oferteexcursii where idcompanie=".$idcompanie.";",$rez1)) != 0)
					printf("<h3>Companie nu poate fi stearsa! Numele companiei este folosit in optiunea unei oferte!</h3>");
				else
					InterogareSQL("delete from pf_companii where idcompanie=".$idcompanie.";",$rez1);
			} ?>
    <div id="right_wrap">
    <div id="right_content">     
<?php
if (!isset($_GET['editeaza']))
	{ ?>	
    <h2>Lista localitatilor</h2> 
<table id="rounded-corner">
    <thead>
    	<tr>
        	<th></th>
            <th>Nume</th>
			<th>Tip transport</th>
            <th>Editare</th>
            <th>Stergere</th>
        </tr>
    </thead>
    <tfoot>
    	<tr>
        	<td colspan="12"> </td>
        </tr>
    </tfoot>
    <tbody>
		<?php
			if (($nr1 = InterogareSQL("select a.idcompanie,a.numecompanie,a.tiptransport from pf_companii a;",$rez1)) != 0)
					{
						for ($i=0;$i<$nr1;$i++)
							{
								$linie1 = CitesteLinie($rez1,$i);
								printf("<tr class=\"odd\">");
								printf("<td><input type=\"checkbox\" name=\"checkbox\" value=\"%s\" /></td>",$linie1[0]);
								printf("<td>%s</td>",$linie1[1]);
								printf("<td>%s</td>",$linie1[2]);
								printf("<td><a href=\"administrarecompanii.php?editeaza=1&idcompanie=%s\"><img src=\"images/edit.png\" border=\"0\" /></a></td>",$linie1[0]);
								printf("<td><a href=\"administrarecompanii.php?sterge=1&idcompanie=%s\"><img src=\"images/trash.gif\" border=\"0\" /></a></td>",$linie1[0]);
								printf("</tr>");
							}
					} ?>
    </tbody>
</table>
	<?php
		}
		if (isset($_GET['salveaza']))
			{ 
			$numecompanie = $_GET['numecompanie'];
			$tiptransport = $_GET['tiptransport'];
			$idcompanie = $_GET['idcompanie'];
			InterogareSQL("update pf_companii set numecompanie='".$numecompanie."',tiptransport='".$tiptransport."' where idcompanie=".$idcompanie.";",$nr2);
			} 
		if (isset($_GET['editeaza']))
			{ ?>
		<ul id="tabsmenu" class="tabsmenu">
        <li class="active"><a href="#">Editare companie</a></li>
		</ul>
		<div id="tab1" class="tabcontent">
        <h3> </h3>
		<form id="form1" method="get" target="administrarecompanii.php">
        <div class="form">
		<?php
				$idcompanie = $_GET['idcompanie'];
				if (($nr1 = InterogareSQL("select a.idcompanie,a.numecompanie from pf_companii a where a.idcompanie=".$idcompanie.";",$rez1)) != 0)
				{
					$linie1 = CitesteLinie($rez1,0);
					printf("<div class=\"form_row\">");
					printf("<label>Nume:</label>");
					printf("<input type=\"text\" class=\"form_input\" name=\"numecompanie\" value=\"%s\" />",$linie1[1]);
					printf("</div>");
					printf("<div class=\"form_row\">");
					printf("<label>Tip transport:</label>");
					printf("<select class=\"form_select\" name=\"tiptransport\">");
					printf("<option value=\"avion\">avion</option>");
					printf("<option value=\"autocar\">autocar</option>");
					printf("</select>");
					printf("<input type=\"hidden\" class=\"form_val\" name=\"idcompanie\" value=\"%s\" />",$linie1[0]);
					printf("</div>");
				} ?>         
        <input type="submit" name="salveaza" class="form_submit" value="Salveaza" onclick="this.form.target='_self';return true;" />
        </div> 
		</form>
        <div class="clear"></div>
        </div>
		<?php
			} 
			?>
    </div>
    </div>
  </div><!-- end of right content--> 

    <div class="clear"></div>
    </div> <!--end of center_content-->
    
    <div class="footer">
Prelipcean Florin Vasile - Universitatea Stefan cel Mare Suceava - Facultatea de Inginerie Electrica si Stiinta Calculatoarelor 
</div>

</div>

</body>
</html>