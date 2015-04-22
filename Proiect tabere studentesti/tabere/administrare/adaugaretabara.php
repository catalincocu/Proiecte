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
    <li><a href="administraretabere.php" class="selected">Tabere</a></li>
    <li><a href="administrarestudenti.php">Studenti</a></li>
    <li><a href="administrareprofesori.php">Profesori</a></li>
    </ul>
    </div>
    
    </div>
    
    <div class="submenu">
    <ul>
	<li><a href="administraretabere.php">administrare tabere</a></li>
    <li><a href="adaugaretabara.php" class="selected">adaugare tabara</a></li>
    </ul>
    </div>          
                    
    <div class="center_content">  
 
    <div id="right_wrap">
    <div id="right_content">             

    <ul id="tabsmenu" class="tabsmenu">
		<li class="active"><a href="#">Adaugare tabara noua</a></li>
    </ul>
    <div id="tab1" class="tabcontent">
        <h3> </h3>
		<?php
		if (isset($_GET['salveaza']))
			{
				$numetabara = $_GET['numetabara'];
				$adresa = $_GET['adresa'];
				$contact = $_GET['descriere'];
				$descriere = $_GET['descriere'];
				$adrimg = $_GET['adrimg'];
				InterogareSQL("insert into gc_tabere(numetabara,adresa,contact,descriere,numeimgjpg) values('".$numetabara."','".$adresa."','".$contact."','".$descriere."','".$adrimg."');",$nr2);
				printf("Hotel adaugat!");
			}
		else
			{
		?>
		<form id="form1" method="get" target="adaugarehotel.php">
        <div class="form">
            
            <div class="form_row">
            <label>Nume tabara:</label>
            <input type="text" class="form_input" name="numetabara" />
            </div>
             
            <div class="form_row">
            <label>Adresa:</label>
            <input type="text" class="form_input" name="adresa" />
            </div>
            
            <div class="form_row">
            <label>Contact:</label>
            <input type="text" class="form_input" name="contact" />
            </div>
            
			<div class="form_row">
            <label>Descriere:</label>
            <input type="text" class="form_input" name="descriere" />
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