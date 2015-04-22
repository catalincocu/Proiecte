<?php
require('interog.inc');
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administrare - Obiective turistice din Bucovina - 2014</title>
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
    <div class="title"><a href="#">Panou de administrare</a></div>
    
    <div class="header_right">
	<?php
				if (isset($_SESSION["okadmin"]))
				{
				printf("<a href=\"#\">Buna %s,</a>",$_SESSION["useradmin"]);
				printf("<a href=\"logout.php\" class=\"logout\">Deconectare</a>");
				}
		?> 
	</div>
    <div class="menu">
    <ul>
    <li><a href="administrareobiective.php" class="selected">Obiective</a></li>
    <li><a href="administrareutilizatori.php">Utilizatori</a></li>
    <li><a href="administrarecomentarii.php">Comentarii</a></li>
    </ul>
    </div>
    
    </div>
    
    <div class="submenu">
    <ul>
	<li><a href="administrareobiective.php">administrare obiectiv</a></li>
    <li><a href="adaugareobiectiv.php" class="selected">adaugare obiectiv</a></li>
    </ul>
    </div>          
                    
    <div class="center_content">  
 
    <div id="right_wrap">
    <div id="right_content">             

    <ul id="tabsmenu" class="tabsmenu">
		<li class="active"><a href="#">Adaugare obiectiv nou</a></li>
    </ul>
    <div id="tab1" class="tabcontent">
        <h3> </h3>
		<?php
		if (isset($_GET['salveaza']))
			{
				$nume = $_GET['nume'];
				$tip = $_GET['tip'];
				$localitate = $_GET['localitate'];
				$descriere = $_GET['descriere'];
				InterogareSQL("insert into t_obiective(nume,tip,localitate,descriere) values('".$nume."','".$tip."','".$localitate."','".$descriere."');",$rez2);
				printf("Obiectiv adaugat!");
			}
		else
			{
		?>
		<form id="form1" method="get" target="adaugareobiectiv.php">
        <div class="form">
            
            <div class="form_row">
            <label>Nume obiectiv:</label>
            <input type="text" class="form_input" name="nume" />
            </div>
             
            <div class="form_row">
            <label>Tip:</label>
            <input type="text" class="form_input" name="tip" />
            </div>
            
            <div class="form_row">
            <label>Localitate:</label>
            <input type="text" class="form_input" name="localitate" />
            </div>
            
			<div class="form_row">
            <label>Descriere:</label>
            <input type="text" class="form_input" name="descriere" />
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
Spiridon Anca - Universitatea Stefan cel Mare Suceava - Facultatea de Inginerie Electrica si Stiinta Calculatoarelor 
</div>

</div>

    	
</body>
</html>