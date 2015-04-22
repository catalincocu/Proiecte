<?php
require('interog.inc');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="author" content="Prelipcean Florin Vasile" />
<meta name="description" content="Aplicatie web pentru agentie de turism" />
<meta name="keywords" content="aplicatie web,agentie de turism,turism,aplicatie web pentru agentie de turism" />
<title>Aplicatie web pentru agentie de turism</title>
<link rel="stylesheet" type="text/css" media="all" href="style.css" />
<link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.flexslider-min.js"></script>
<script type="text/javascript" charset="utf-8">
var $ = jQuery.noConflict();
  $(window).load(function() {
    $('.flexslider').flexslider({
          animation: "slide"
    });
  });
</script>
</head>
<body>

  <div id="header">
        <div class="header_content">
      
		<div class="conectare">
		<a href="login.php">Conectare</a>
		<a href="inregistrare.php">Inregistrare</a>
		</div>
		
       <div class="logo"><a href="index.php">Agentie de turism</a></div>
        
        <div class="menu">
            <ul>
                <li><a href="index.php">Acasa</a></li>
                <li><a href="hoteluri.php">Hoteluri</a></li>
				<li><a href="oferte.php">Oferte</a></li>
				<li><a href="transport.php">Transport</a></li>
            </ul>
         </div>
         
        </div> 
  </div><!-- End of Header-->

<div id="page_wrap">	  
   
  <div class="center_content">
			<div class="page_title">
            <h1>Inregistrare</h1>
            </div>
            <div class="section_full">
				<?php
					if (isset($_POST["inregistreaza"]))
						{
							$utilizator = $_POST["utilizator"];
							$parola = $_POST["parola"];
							$nume = $_POST["nume"];
							$prenume = $_POST["prenume"];
							$strada = $_POST["strada"];
							$nr = $_POST["nr"];
							$ap = $_POST["ap"];
							$telefon = $_POST["telefon"];
							$mail = $_POST["mail"];
							$localitate = $_POST["localitate"];
							$judet = $_POST["judet"];
							InterogareSQL("insert into pf_utilizatori(username,parola) values('$utilizator','$parola');",$rez);
							if (($nr2 = InterogareSQL("select idutilizator from pf_utilizatori where username='".$utilizator."';",$rez2)) != 0)
								{
									$linie2 = CitesteLinie($rez2,0);
									$cod = $linie2[0];
									InterogareSQL("insert into pf_datepersonale(nume,prenume,strada,nr,ap,telefon,email,localitate,judet,idutilizator) values('$nume','$prenume','$strada','$nr',$ap,$telefon,'$mail','$localitate','$judet',$cod);",$rez1);
									printf("Utilizator inregistrat!");
								}
						}
					else
						{
				?>
				<form method="post" action="inregistrare.php">
				<div class="section_13">
					<div class="feat_details">
					<font size="3">
					<table width="300" height="300">
					<tr><td><font size="4">Date conectare</font></td></tr>
					<tr><td>Utilizator:</td>
					<td><input type="text" name="utilizator" value="" /></td></tr>
					<tr><td>Parola:</td>
					<td><input type="password" name="parola" value="" /></td></tr>
					<tr><td>Confirmare parola:</td>
					<td><input type="password" name="parola2" value="" /></td></tr>
					<tr><td><img src="images/register.jpg" width="170"></td></tr>
					<tr><td><input type="submit" name="inregistreaza" value="Inregistrare" class="order_button"/></td></tr>
					</table>
					</font>
					</div>
				</div>
				<div class="section_13">
					<div class="feat_details">
					<font size="3">
					<table width="300" height="350">
					<tr><td><font size="4">Date personale</font></td></tr>
					<tr><td>Nume:</td>
					<td><input type="text" name="nume" value="" /></td></tr>
					<tr><td>Prenume:</td>
					<td><input type="text" name="prenume" value="" /></td></tr>
					<tr><td>Strada:</td>
					<td><input type="text" name="strada" value="" /></td></tr>
					<tr><td>Nr:</td>
					<td><input type="text" name="nr" value="" /></td></tr>
					<tr><td>Ap:</td>
					<td><input type="text" name="ap" value="" /></td></tr>
					<tr><td>Telefon:</td>
					<td><input type="text" name="telefon" value="" /></td></tr>
					<tr><td>E-mail:</td>
					<td><input type="text" name="mail" value="" /></td></tr>
					<tr><td>Localitate:</td>
					<td><input type="text" name="localitate" value="" /></td></tr>
					<tr><td>Judet:</td>
					<td><input type="text" name="judet" value="" /></td></tr>
					</table>
					</font>
					</div>
				</div>
				</form> 	
				<?php
						}
					?>
            </div>
				
			<div class="section_23">
              <h2> </h2>
              <p>
	
			  </p>     
			  <br><br>
			<h2> </h2>
              <p>
				
			  </p>    			  
            </div>
			
            <div class="section_13">
              <h2></h2>
              <p>
				
              </p>             
            </div>
			
  <div class="clear"></div>     
  </div>
  
  
</div>   
<div id="footer">
	<div class="footer_content">
        <div class="footer_bottom">
            <div class="copyrights">
            Prelipcean Florin Vasile - Universitatea Stefan cel Mare Suceava - Facultatea de Inginerie Electrica si Stiinta Calculatoarelor 
            </div>
        </div>
</div>
 
</body>
</html>
