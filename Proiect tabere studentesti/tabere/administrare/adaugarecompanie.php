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
    <li><a href="administrarerezervari.php">Rezervari</a></li>
    </ul>
    </div>
    
    </div>
    
    <div class="submenu">
    <ul>
	<li><a href="administrarecompanii.php">administrare companie</a></li>
    <li><a href="adaugarecompanie.php" class="selected">adaugare companie</a></li>
    </ul>
    </div>          
                    
    <div class="center_content">  
 
    <div id="right_wrap">
    <div id="right_content">             

    <ul id="tabsmenu" class="tabsmenu">
		<li class="active"><a href="#">Adaugare companie noua</a></li>
    </ul>
    <div id="tab1" class="tabcontent">
        <h3> </h3>
		<?php
		if (isset($_GET['salveaza']))
			{
				$numecompanie = $_GET['numecompanie'];
				$tiptransport = $_GET['tiptransport'];
				$adrimg = $_GET['adrimg'];
				InterogareSQL("insert into pf_companii(numecompanie,tiptransport,adrimg) values('".$numecompanie."','".$tiptransport."','".$adrimg."');",$nr2);
				printf("Companie adaugata!");
			}
		else
			{
		?>
		<form id="form1" method="get" target="adaugarecompanie.php">
        <div class="form">
            
            <div class="form_row">
            <label>Nume companie:</label>
            <input type="text" class="form_input" name="numecompanie" />
            </div>
             
            <div class="form_row">
            <label>Nume imagine:</label>
            <input type="text" class="form_input" name="adrimg" />
            </div>
			
			<div class="form_row">
            <label>Tip transport:</label>
            <select class="form_select" name="tiptransport">
            <option value="avion">avion</option>
			<option value="autocar">autocar</option>
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