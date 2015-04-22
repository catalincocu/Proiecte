<?php
require('interog.inc');
session_start();
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
		<?php
				if (!isset($_SESSION["ok"]))
				{
		?>
				<a href="login.php">Conectare</a>
				<a href="inregistrare.php">Inregistrare</a>
		<?php
				}
				else
				{
				printf("<a href=\"profil.php\">Buna %s,</a>",$_SESSION["user"]);
				printf("<a href=\"logout.php\">Deconectare</a>");
				}
		?>
		</div>
		<div class="logo"><a href="index.php">Agentie de turism</a></div>
        <div class="menu">
            <ul>
                <li class="selected"><a href="index.php">Acasa</a></li>
                <li><a href="hoteluri.php">Hoteluri</a></li>
				<li><a href="oferte.php">Oferte</a></li>
				<li><a href="transport.php">Transport</a></li>
				<?php
					if (isset($_SESSION["ok"]))
						{
							printf("<li><a href=\"comenzi.php?uid=%s\">Comenzile mele</a></li>",$_SESSION["userid"]);
						}
				?>
            </ul>
         </div>
        </div> 
  </div><!-- End of Header-->

<div id="page_wrap">	  
   
  <div class="center_content">
			<div class="page_title">
            <h1>Despre noi</h1>
            </div>
            
            <div class="section_full">
              <h2>Profil de companie</h2>
              <p>
				Fondata în anul 1993 la Cluj Napoca, Compania a cunoscut o dezvoltare continua, extinzandu-si reteaua de agentii proprii in oraşe importante din Romania si devenind una dintre cele mai importante companii de turism din Romania.
			 Cu sprijinul si increderea acordata de clientii si partenerii nostri, astazi, la 20 ani de la infiinţare, reteaua este formata din 26 de agentii de calatorie, 14 agenţii proprii şi 12 agentii francizate in oraşele: Bucureşti, Iaşi, Mediaş, Alba Iulia, Bistriţa, Tirgu Mureş, Craiova, Galaţi,  Braşov, Pitesti si Braila.
			 Cifra de afaceri în anul 2012 a depăşit 35 milioane de EUR, în creştere cu 16% faţă de anul 2011.
              </p>             
            </div>
				<div class="slider">
					<div class="flexslider">
					<ul class="slides">
						<li><a href="hoteluri.php"><img src="imghoteluri/augustapalace.jpg" alt="" title="" border="0" width="750" height="450"/></a>
						</li>
						<li><a href="hoteluri.php"><img src="imghoteluri/lucia.jpg" alt="" title="" border="0" width="750" height="450"/></a>
						</li>
						<li><a href="hoteluri.php"><img src="imghoteluri/ibissainthecatherine.jpg" alt="" title="" border="0" width="750" height="450"/></a>
						</li>
						<li><a href="hoteluri.php"><img src="imghoteluri/sheratondiagonal.jpg" alt="" title="" border="0" width="750" height="450"/></a>
						</li>
						<li><a href="hoteluri.php"><img src="imghoteluri/grandturin.jpg" alt="" title="" border="0" width="750" height="450"/></a>
						</li>
					</ul>
					</div>
				</div>
 
				<div class="subslider_details">
				<h2>Beneficiezi de cele mai mici tarife la pachete turistice </h2>
				<a href="oferte.php" class="order_button">Vezi oferta pentru excursii</a>
				</div>
				<br><br>
			<div class="section_23">
              <h2>Parteneriate furnizori</h2>
              <p>
				Serviciile de rezervare pentru calatorii de afaceri, personale si turistice in Romania se asigura in baza contractelor pe care agentia noastra le detine cu peste 400 unităţi hoteliere din România, incluse în cea mai complexă bază de date de acest tip, disponibilă pe pagina web a companiei.
				Serviciile de ticketing, rezervare şi emitere de bilete de avion, se asigură în baza parteneriatelor cu cele două sisteme de rezervări (GDS`s) prezente în România , acreditarii I.A.T.A. şi parteneriatelor cu toate companiile aeriene de linie şi low-cost care operează zboruri din şi înspre România.
			  </p>     
			  <br><br>
			<h2>Echipa noastra</h2>
              <p>
				Echipa noastra este alcătuită în majoritate din tineri, motivaţi şi pregătiţi în concordanţă cu reguli şi standarde bine definite, alături de un nucleu de profesionişti cu experienţă şi numără în prezent peste 135 de persoane, cu diferite calificări.
				O parte dintre agenţii noştri activează în colectivele specializate pentru turism de afaceri / business travel de la Bucureşti, Cluj Napoca, Timişoara şi Sibiu, în calitate de consultanţi de călătorie profesionişti, capabili să ofere servicii personalizate şi dedicate, în funcţie de nevoile specifice ale corporaţiilor client.
			  </p>    			  
            </div>
			
            <div class="section_13">
              <h2></h2>
              <p>
					<img src="images/imgdescriereagentie.jpg" width="400">
					<img src="images/hartaromania.jpg" width="400">
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
