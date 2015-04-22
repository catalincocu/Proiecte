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
    <li><a href="administrarerezervari.php">Rezervari</a></li>
    </ul>
    </div>
    
    </div>
    
    <div class="submenu">
    <ul>
	<li><a href="administrarehoteluri.php">administrare hoteluri</a></li>
    <li><a href="adaugarehotel.php" class="selected">adaugare hotel</a></li>
    </ul>
    </div>          
                    
    <div class="center_content">  
 
    <div id="right_wrap">
    <div id="right_content">             

    <ul id="tabsmenu" class="tabsmenu">
		<li class="active"><a href="#">Adaugare hotel nou</a></li>
    </ul>
    <div id="tab1" class="tabcontent">
        <h3> </h3>
		<?php
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
				$idlocalitate = $_GET['localitate'];
				$adrimg = $_GET['adrimg'];
				InterogareSQL("insert into pf_hoteluri(numehotel,descriere,dotari,totalcamsingle,camocupatetsingle,pretcamsingle,totalcamtwin,camocupatetwin,pretcamtwin,idlocalitate,adrimg) values('".$numehotel."','".$descriere."','".$dotari."',".$totcamsingle.",".$camocupsingle.",".$pretcamsingle.",".$totcamdubla.",".$camocupdubla.",".$pretcamdubla.",".$idlocalitate.",'".$adrimg."');",$nr2);
				printf("Hotel adaugat!");
			}
		else
			{
		?>
		<form id="form1" method="get" target="adaugarehotel.php">
        <div class="form">
            
            <div class="form_row">
            <label>Nume hotel:</label>
            <input type="text" class="form_input" name="numehotel" />
            </div>
             
            <div class="form_row">
            <label>Descriere:</label>
            <input type="text" class="form_input" name="descriere" />
            </div>
            
            <div class="form_row">
            <label>Dotari:</label>
            <input type="text" class="form_input" name="dotari" />
            </div>
            
			<div class="form_row">
            <label>Localitate:</label>
            <select class="form_select" name="localitate">
            <?php
						if (($nr2 = InterogareSQL("select idlocalitate,nume from pf_localitati;",$rez2)) != 0)
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
            <label>Nr cam single:</label>
            <input type="text" class="form_val" name="totcamsingle" />
            </div>
			
			<div class="form_row">
            <label>Cam. single ocupate:</label>
            <input type="text" class="form_val" name="camocupsingle" />
            </div>
			
			<div class="form_row">
            <label>Pret cam single:</label>
            <input type="text" class="form_val" name="pretcamsingle" />
            </div>
			
			<div class="form_row">
            <label>Nr cam duble:</label>
            <input type="text" class="form_val" name="totcamdubla" />
            </div>
			
			<div class="form_row">
            <label>Cam. duble ocupate:</label>
            <input type="text" class="form_val" name="camocupdubla" />
            </div>
			
			<div class="form_row">
            <label>Pret cam dubla:</label>
            <input type="text" class="form_val" name="pretcamdubla" />
            </div>
			
			<div class="form_row">
            <label>nume imagine:</label>
            <input type="text" class="form_input" name="adrimg" />
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