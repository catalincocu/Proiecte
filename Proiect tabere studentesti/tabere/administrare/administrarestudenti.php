<?php
require('interog.inc');
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administrare - Tabere de odihna - 2013</title>
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
    <li><a href="administraretabere.php">Tabere</a></li>
    <li><a href="administrarestudenti.php" class="selected">Studenti</a></li>
    <li><a href="administrareprofesori.php">Profesori</a></li>
    </ul>
    </div>
    </div>
    <div class="submenu">
    <ul>
	<li><a href="administrarestudenti.php" class="selected">administrare studenti</a></li>
    <li><a href="adaugarestudent.php">adaugare student</a></li>
    </ul>
    </div>                       
    <div class="center_content">  
<?php
 if (isset($_GET['sterge']))
			{
				$idstudent = $_GET['idstudent'];
				InterogareSQL("delete from gc_studenti where idstudent=".$idstudent.";",$rez1);
			} ?>
    <div id="right_wrap">
    <div id="right_content">     
<?php
if (!isset($_GET['editeaza']))
	{ ?>	
    <h2>Lista studentilor</h2> 
<table id="rounded-corner">
    <thead>
    	<tr>
        	<th></th>
            <th>Nume</th>
            <th>Prenume</th>
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
			if (($nr1 = InterogareSQL("select idstudent,nume,prenume from gc_studenti;",$rez1)) != 0)
					{
						for ($i=0;$i<$nr1;$i++)
							{
								$linie1 = CitesteLinie($rez1,$i);
								printf("<tr class=\"odd\">");
								printf("<td><input type=\"checkbox\" name=\"checkbox\" value=\"%s\" /></td>",$linie1[0]);
								printf("<td>%s</td>",$linie1[1]);
								printf("<td>%s</td>",$linie1[2]);
								printf("<td><a href=\"administrarestudenti.php?sterge=1&idstudent=%s\"><img src=\"images/trash.gif\" border=\"0\" /></a></td>",$linie1[0]);
								printf("</tr>");
							}
					} ?>
    </tbody>
</table>
	<?php
		}
		if (isset($_GET['salveaza']))
			{ 
			$idutilizator = $_GET['idutilizator'];
			$username = $_GET['username'];
			$nume = $_GET['nume'];
			$prenume = $_GET['prenume'];
			$strada = $_GET['strada'];
			$nr = $_GET['nr'];
			$ap = $_GET['ap'];
			$telefon = $_GET['telefon'];
			$email = $_GET['email'];
			$localitate = $_GET['localitate'];
			$judet = $_GET['judet'];
			InterogareSQL("update pf_datepersonale set nume='".$nume."',prenume='".$prenume."',strada='".$strada."',nr='".$nr."',ap=".$ap.",telefon='".$telefon."',email='".$email."',localitate='".$localitate."',judet='".$judet."' where idutilizator=".$idutilizator.";",$nr2);
			InterogareSQL("update pf_utilizatori set username='".$username."' where idutilizator=".$idutilizator.";",$nr2);
			} 
		if (isset($_GET['editeaza']))
			{ ?>
		<ul id="tabsmenu" class="tabsmenu">
        <li class="active"><a href="#">Editare date utilizator</a></li>
		</ul>
		<div id="tab1" class="tabcontent">
        <h3> </h3>
		<form id="form1" method="get" target="administrareutilizatori.php">
        <div class="form">
		<?php
				$idutilizator = $_GET['idutilizator'];
				if (($nr1 = InterogareSQL("select a.idutilizator,a.username,b.nume,b.prenume,b.strada,b.nr,b.ap,b.telefon,b.email,b.localitate,b.judet from pf_utilizatori a,pf_datepersonale b where a.idutilizator=b.idutilizator and a.idutilizator=".$idutilizator.";",$rez1)) != 0)
				{
					$linie1 = CitesteLinie($rez1,0);
					printf("<div class=\"form_row\">");
					printf("<label>Utilizator:</label>");
					printf("<input type=\"text\" class=\"form_input\" name=\"username\" value=\"%s\" />",$linie1[1]);
					printf("</div>");
					printf("<div class=\"form_row\">");
					printf("<label>Nume:</label>");
					printf("<input type=\"text\" class=\"form_input\" name=\"nume\" value=\"%s\" />",$linie1[2]);
					printf("</div>");
					printf("<div class=\"form_row\">");
					printf("<label>Prenume:</label>");
					printf("<input type=\"text\" class=\"form_input\" name=\"prenume\" value=\"%s\" />",$linie1[3]);
					printf("</div>");
					printf("<div class=\"form_row\">");
					printf("<label>Strada:</label>");
					printf("<input type=\"text\" class=\"form_input\" name=\"strada\" value=\"%s\" />",$linie1[4]);
					printf("</div>");
					printf("<div class=\"form_row\">");
					printf("<label>Nr:</label>");
					printf("<input type=\"text\" class=\"form_val\" name=\"nr\" value=\"%s\" />",$linie1[5]);
					printf("</div>");
					printf("<div class=\"form_row\">");
					printf("<label>Ap:</label>");
					printf("<input type=\"text\" class=\"form_val\" name=\"ap\" value=\"%s\" />",$linie1[6]);
					printf("</div>");
					printf("<div class=\"form_row\">");
					printf("<label>Telefon:</label>");
					printf("<input type=\"text\" class=\"form_val\" name=\"telefon\" value=\"%s\" />",$linie1[7]);
					printf("</div>");
					printf("<div class=\"form_row\">");
					printf("<label>E-mail:</label>");
					printf("<input type=\"text\" class=\"form_input\" name=\"email\" value=\"%s\" />",$linie1[8]);
					printf("</div>");
					printf("<div class=\"form_row\">");
					printf("<label>Localitate:</label>");
					printf("<input type=\"text\" class=\"form_input\" name=\"localitate\" value=\"%s\" />",$linie1[9]);
					printf("</div>");
					printf("<div class=\"form_row\">");
					printf("<label>Judet:</label>");
					printf("<input type=\"text\" class=\"form_input\" name=\"judet\" value=\"%s\" />",$linie1[10]);
					printf("<input type=\"hidden\" class=\"form_val\" name=\"idutilizator\" value=\"%s\" />",$linie1[0]);
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