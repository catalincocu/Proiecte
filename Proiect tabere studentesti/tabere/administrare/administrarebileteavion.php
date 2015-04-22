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
    <li><a href="administrareutilizatori.php" class="selected">Utilizatori</a></li>
    <li><a href="administrarelocalitati.php">Localitati</a></li>
    <li><a href="administrarecompanii.php">Companii</a></li>
	<li><a href="administrarebileteavion.php">Bilete achizitionate</a></li>
    </ul>
    </div>
    </div>
    <div class="submenu">
    <ul>
	<li><a href="administrarebileteavion.php" class="selected">administrare bilete calatori</a></li>
    </ul>
    </div>                       
    <div class="center_content">  
<?php
 if (isset($_GET['sterge']))
			{
				$idbilet = $_GET['idbilet'];
				InterogareSQL("delete from pf_biletezbor where idbiletzbor=".$idbilet.";",$rez1);
			} ?>
    <div id="right_wrap">
    <div id="right_content">     
	
    <h2>Lista biletelor de transport achizitionate</h2> 
<table id="rounded-corner">
    <thead>
    	<tr>
        	<th></th>
            <th>Username</th>
            <th>Nume</th>
            <th>Prenume</th>
			<th>Data achizitie</th>
            <th>Data plecare</th>
            <th>Plecare</th>
			<th>Destinatie</th>
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
			if (($nr1 = InterogareSQL("select c.idbiletzbor,a.nume,a.prenume,b.username,c.dataachizitie,c.dataplecare,d.nume,e.nume from pf_datepersonale a,pf_utilizatori b,pf_biletezbor c,pf_localitati d,pf_localitati e,pf_ofertebiletezbor f where c.idofertazbor=f.idofertazbor and c.idutilizator=b.idutilizator and a.idutilizator=c.idutilizator and d.idlocalitate=f.idlocplecare and e.idlocalitate=f.idlocsosire;",$rez1)) != 0)
					{
						for ($i=0;$i<$nr1;$i++)
							{
								$linie1 = CitesteLinie($rez1,$i);
								printf("<tr class=\"odd\">");
								printf("<td><input type=\"checkbox\" name=\"checkbox\" value=\"%s\" /></td>",$linie1[0]);
								printf("<td>%s</td>",$linie1[3]);
								printf("<td>%s</td>",$linie1[1]);
								printf("<td>%s</td>",$linie1[2]);
								printf("<td>%s</td>",$linie1[4]);
								printf("<td>%s</td>",$linie1[5]);
								printf("<td>%s</td>",$linie1[6]);
								printf("<td>%s</td>",$linie1[7]);
								printf("<td><a href=\"administrarebileteavion.php?sterge=1&idbilet=%s\"><img src=\"images/trash.gif\" border=\"0\" /></a></td>",$linie1[0]);
								printf("</tr>");
							}
					} ?>
    </tbody>
</table>
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