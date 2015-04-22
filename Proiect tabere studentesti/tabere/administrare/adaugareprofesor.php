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
    <li><a href="administrarestudenti.php">Studenti</a></li>
    <li><a href="administrareprofesori.php" class="selected">Profesori</a></li>
    </ul>
    </div>
    
    </div>
    
    <div class="submenu">
    <ul>
	<li><a href="administrareprofesori.php">administrare profesori</a></li>
    <li><a href="adaugareprofesor.php" class="selected">adaugare profesor</a></li>
    </ul>
    </div>          
                    
    <div class="center_content">  
 
    <div id="right_wrap">
    <div id="right_content">             

    <ul id="tabsmenu" class="tabsmenu">
		<li class="active"><a href="#">Adaugare profesor</a></li>
    </ul>
    <div id="tab1" class="tabcontent">
        <h3> </h3>
		<?php
		if (isset($_GET['salveaza']))
			{
				$nume = $_GET["nume"];
				$prenume = $_GET["prenume"];
				$facultate = $_GET["facultate"];
				$parola = $_GET["parola"];
				InterogareSQL("insert into gc_profesori(nume,prenume,idfacultate,parola) values('$nume','$prenume',$facultate,'$parola');",$rez1);
						printf("Profesor adaugat!");
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
            <label>Parola:</label>
            <input type="password" class="form_input" name="parola" />
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