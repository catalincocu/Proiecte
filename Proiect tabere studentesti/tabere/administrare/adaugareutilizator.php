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
    <li><a href="administrarelocalitati.php" class="selected">Localitati</a></li>
    <li><a href="administrarecompanii.php">Companii</a></li>
	<li><a href="administrarebileteavion.php">Bilete achizitionate</a></li>
    <li><a href="administrarerezervari.php">Rezervari</a></li>
    </ul>
    </div>
    
    </div>
    
    <div class="submenu">
    <ul>
	<li><a href="administrareutilizatori.php">administrare utilizatori</a></li>
    <li><a href="adaugareutilizator.php" class="selected">adaugare utilizator</a></li>
    </ul>
    </div>          
                    
    <div class="center_content">  
 
    <div id="right_wrap">
    <div id="right_content">             

    <ul id="tabsmenu" class="tabsmenu">
		<li class="active"><a href="#">Adaugare localitate noua</a></li>
    </ul>
    <div id="tab1" class="tabcontent">
        <h3> </h3>
		<?php
		if (isset($_GET['salveaza']))
			{
				$utilizator = $_GET["utilizator"];
				$parola = $_GET["parola"];
				$nume = $_GET["nume"];
				$prenume = $_GET["prenume"];
				$strada = $_GET["strada"];
				$nr = $_GET["nr"];
				$ap = $_GET["ap"];
				$telefon = $_GET["telefon"];
				$mail = $_GET["mail"];
				$localitate = $_GET["localitate"];
				$judet = $_GET["judet"];
				InterogareSQL("insert into pf_utilizatori(username,parola) values('$utilizator','$parola');",$rez);
				if (($nr2 = InterogareSQL("select idutilizator from pf_utilizatori where username='".$utilizator."';",$rez2)) != 0)
					{
						$linie2 = CitesteLinie($rez2,0);
						$cod = $linie2[0];
						InterogareSQL("insert into pf_datepersonale(nume,prenume,strada,nr,ap,telefon,email,localitate,judet,idutilizator) values('$nume','$prenume','$strada','$nr',$ap,$telefon,'$mail','$localitate','$judet',$cod);",$rez1);
						printf("Utilizator adaugat!");
					}
			}
		else
			{
		?>
		<form id="form1" method="get" target="adaugareutilizator.php">
        <div class="form">
            
            <div class="form_row">
            <label>Utilizator:</label>
            <input type="text" class="form_input" name="utilizator" />
            </div>
             
            <div class="form_row">
            <label>Parola:</label>
            <input type="text" class="form_input" name="parola" />
            </div>
			 
            <div class="form_row">
            <label>Nume:</label>
            <input type="text" class="form_input" name="nume" />
            </div> 
			
            <div class="form_row">
            <label>Prenume:</label>
            <input type="text" class="form_input" name="prenume" />
            </div> 
			
            <div class="form_row">
            <label>Strada:</label>
            <input type="text" class="form_input" name="strada" />
            </div>
			
            <div class="form_row">
            <label>Nr:</label>
            <input type="text" class="form_val" name="nr" />
            </div>
			
            <div class="form_row">
            <label>Ap:</label>
            <input type="text" class="form_val" name="ap" />
            </div>
			
            <div class="form_row">
            <label>Telefon:</label>
            <input type="text" class="form_val" name="telefon" />
            </div>
			
            <div class="form_row">
            <label>Email:</label>
            <input type="text" class="form_input" name="mail" />
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