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
	<li><a href="administrarestudenti.php">administrare studenti</a></li>
    <li><a href="adaugarestudent.php" class="selected">adaugare student</a></li>
    </ul>
    </div>          
                    
    <div class="center_content">  
 
    <div id="right_wrap">
    <div id="right_content">             

    <ul id="tabsmenu" class="tabsmenu">
		<li class="active"><a href="#">Adaugare student</a></li>
    </ul>
    <div id="tab1" class="tabcontent">
        <h3> </h3>
		<?php
		if (isset($_GET['salveaza']))
			{
				$nume = $_GET["nume"];
				$prenume = $_GET["prenume"];
				$seriebi = $_GET["seriebi"];
				$nrbi = $_GET["nrbi"];
				$cnp = $_GET["cnp"];
				$localitate = $_GET["localitate"];
				$judet = $_GET["judet"];
				$mail = $_GET["mail"];
				$facultate = $_GET["facultate"];
				$specializare = $_GET["specializare"];
				InterogareSQL("insert into gc_studenti(nume,prenume,seriebi,nrbi,cnp,localitate,judet,email,idfacultate,idspecializare) values('$nume','$prenume','$seriebi','$nrbi','$cnp','$localitate','$judet','$mail',$facultate,$specializare);",$rez1);
						printf("Student adaugat!");
			}
		else
			{
		?>
		<form id="form1" method="get" target="adaugareutilizator.php">
        <div class="form">
			 
            <div class="form_row">
            <label>Nume:</label>
            <input type="text" class="form_input" name="nume" />
            </div> 
			
            <div class="form_row">
            <label>Prenume:</label>
            <input type="text" class="form_input" name="prenume" />
            </div> 
			
            <div class="form_row">
            <label>Serie B.I.:</label>
            <input type="text" class="form_val" name="seriebi" />
            </div>
			
            <div class="form_row">
            <label>Nr B.I.:</label>
            <input type="text" class="form_val" name="nrbi" />
            </div>
			
			<div class="form_row">
            <label>CNP:</label>
            <input type="text" class="form_input" name="cnp" />
            </div>
			
            <div class="form_row">
            <label>Localitate:</label>
            <input type="text" class="form_input" name="localitate" />
            </div>
			
            <div class="form_row">
            <label>Judet:</label>
            <input type="text" class="form_input" name="judet" />
            </div>
			
			<div class="form_row">
            <label>Email:</label>
            <input type="text" class="form_input" name="mail" />
            </div>
			
			<div class="form_row">
            <label>Facultate:</label>
            <select class="form_select" name="facultate">
            <?php
						if (($nr2 = InterogareSQL("select idfacultate,denumirefacultate from gc_facultati;",$rez2)) != 0)
							{
								for ($i=0;$i<$nr2;$i++)
								{
									$linie2 = CitesteLinie($rez2,$i);
									printf("<option value=\"%s\">%s</option>",$linie2[0],$linie2[1]);
								}
							}
						?>
            </select>
            </div>
			
			<div class="form_row">
            <label>Specializare:</label>
            <select class="form_select" name="specializare">
            <?php
						if (($nr2 = InterogareSQL("select idspecializare,denumirespecializare from gc_specializari;",$rez2)) != 0)
							{
								for ($i=0;$i<$nr2;$i++)
								{
									$linie2 = CitesteLinie($rez2,$i);
									printf("<option value=\"%s\">%s</option>",$linie2[0],$linie2[1]);
								}
							}
						?>
            </select>
            </div>
			
            <div class="form_row">
            <input type="submit" class="form_submit" name="salveaza" value="Salveaza" onclick="this.form.target='_self';return true;" />
            </div> 
            <div class="clear"></div>
        </div>
		</form>
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