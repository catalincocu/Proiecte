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
    <li><a href="administrarehoteluri.php" class="selected">Hoteluri</a></li>
    <li><a href="administrareoferte.php">Oferte</a></li>
    <li><a href="administrareutilizatori.php">Utilizatori</a></li>
    <li><a href="administrarelocalitati.php">Localitati</a></li>
    <li><a href="administrarecompanii.php">Companii</a></li>
	<li><a href="administrarebileteavion.php">Bilete achizitionate</a></li>
    </ul>
    </div>
    </div>
    <div class="submenu">
    <ul>
	<li><a href="administrareoferte.php" class="selected">excursii</a></li>
    <li><a href="administrareofertebilete.php">bilete calatorie</a></li>
    </ul>
    </div>                       
    <div class="center_content">  
<?php
 if (isset($_GET['sterge']))
			{
				$idoferta = $_GET['idoferta'];
				InterogareSQL("delete from pf_oferteexcursii where idoferta=".$idoferta.";",$rez1);
			} ?>
    <div id="right_wrap">
    <div id="right_content">     
<?php
if (!isset($_GET['editeaza']))
	{ ?>	
    <h2>Oferta excursii</h2> 
<table id="rounded-corner">
    <thead>
    	<tr>
        	<th></th>
            <th>Plecare</th>
            <th>Destinatie</th>
            <th>Pret</th>
            <th>Data de inceput</th>
            <th>Sfarsitul perioadei</th>
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
			if (($nr1 = InterogareSQL("select a.idoferta,b.nume,c.nume,a.pret,a.inceputperioada,a.sfarsitperioada from pf_oferteexcursii a,pf_localitati b,pf_localitati c where b.idlocalitate=a.idlocplecare and c.idlocalitate=a.idlocsosire;",$rez1)) != 0)
					{
						for ($i=0;$i<$nr1;$i++)
							{
								$linie1 = CitesteLinie($rez1,$i);
								printf("<tr class=\"odd\">");
								printf("<td><input type=\"checkbox\" name=\"checkbox\" value=\"%s\" /></td>",$linie1[0]);
								printf("<td>%s</td>",$linie1[1]);
								printf("<td>%s</td>",$linie1[2]);
								printf("<td>%s euro</td>",$linie1[3]);
								printf("<td>%s</td>",$linie1[4]);
								printf("<td>%s</td>",$linie1[5]);
								printf("<td><a href=\"administrareoferte.php?sterge=1&idoferta=%s\"><img src=\"images/trash.gif\" border=\"0\" /></a></td>",$linie1[0]);
								printf("</tr>");
							}
					} ?>
    </tbody>
</table>
	<?php
		}
		if (isset($_GET['salveaza']))
			{ 
			$numehotel = $_GET['numehotel'];
			$descriere = $_GET['descriere'];
			$dotari = $_GET['dotari'];
			$totcamsingle = $_GET['totcamsingle'];
			$camocupsingle = $_GET['camocupsingle'];
			$pretcamsingle = $_GET['pretcamsingle'];
			$totcamdubla = $_GET['totcamdubla'];
			$camocupdubla = $_GET['camocupdubla'];
			$pretcamdubla = $_GET['pretcamdubla'];
			$idhotel = $_GET['idhotel'];
			InterogareSQL("update pf_hoteluri set numehotel='".$numehotel."',descriere='".$descriere."',dotari='".$dotari."',totalcamsingle=".$totcamsingle.",camocupatetsingle=".$camocupsingle.",pretcamsingle=".$pretcamsingle.",totalcamtwin=".$totcamdubla.",camocupatetwin=".$camocupdubla.",pretcamtwin=".$pretcamdubla." where idhotel=".$idhotel.";",$nr2);
			} 
		if (isset($_GET['editeaza']))
			{ ?>
		<ul id="tabsmenu" class="tabsmenu">
        <li class="active"><a href="#">Editare hotel</a></li>
		</ul>
		<div id="tab1" class="tabcontent">
        <h3> </h3>
		<form id="form1" method="get" target="administrarehoteluri.php">
        <div class="form">
		<?php
				$idhotel = $_GET['idhotel'];
				if (($nr1 = InterogareSQL("select a.idhotel,a.numehotel,a.descriere,a.dotari,a.totalcamsingle,a.camocupatetsingle,a.pretcamsingle,a.totalcamtwin,a.camocupatetwin,a.pretcamtwin from pf_hoteluri a where a.idhotel=".$idhotel.";",$rez1)) != 0)
				{
					$linie1 = CitesteLinie($rez1,0);
					printf("<div class=\"form_row\">");
					printf("<label>Nume:</label>");
					printf("<input type=\"text\" class=\"form_input\" name=\"numehotel\" value=\"%s\" />",$linie1[1]);
					printf("</div>");
					printf("<div class=\"form_row\">");
					printf("<label>Descriere:</label>");
					printf("<input type=\"text\" class=\"form_input\" name=\"descriere\" value=\"%s\" />",$linie1[2]);
					printf("</div>");
					printf("<div class=\"form_row\">");
					printf("<label>Dotari:</label>");
					printf("<input type=\"text\" class=\"form_input\" name=\"dotari\" value=\"%s\" />",$linie1[3]);
					printf("</div>");
					printf("<div class=\"form_row\">");
					printf("<label>Nr cam single:</label>");
					printf("<input type=\"text\" class=\"form_val\" name=\"totcamsingle\" value=\"%s\" />",$linie1[4]);
					printf("</div>");
					printf("<div class=\"form_row\">");
					printf("<label>Cam. single ocupate:</label>");
					printf("<input type=\"text\" class=\"form_val\" name=\"camocupsingle\" value=\"%s\" />",$linie1[5]);
					printf("</div>");
					printf("<div class=\"form_row\">");
					printf("<label>Pret cam single:</label>");
					printf("<input type=\"text\" class=\"form_val\" name=\"pretcamsingle\" value=\"%s\" />",$linie1[6]);
					printf("</div>");
					printf("<div class=\"form_row\">");
					printf("<label>Nr cam duble:</label>");
					printf("<input type=\"text\" class=\"form_val\" name=\"totcamdubla\" value=\"%s\" />",$linie1[7]);
					printf("</div>");
					printf("<div class=\"form_row\">");
					printf("<label>Cam. duble ocupate:</label>");
					printf("<input type=\"text\" class=\"form_val\" name=\"camocupdubla\" value=\"%s\" />",$linie1[8]);
					printf("</div>");
					printf("<div class=\"form_row\">");
					printf("<label>Pret cam dubla:</label>");
					printf("<input type=\"text\" class=\"form_val\" name=\"pretcamdubla\" value=\"%s\" />",$linie1[9]);
					printf("<input type=\"hidden\" class=\"form_val\" name=\"idhotel\" value=\"%s\" />",$linie1[0]);
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