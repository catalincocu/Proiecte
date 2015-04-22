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
                <li><a href="index.php">Acasa</a></li>
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
            <h1>Solicitare oferta sejur</h1>
            </div>
				<?php
				if (!isset($_SESSION["ok"]))
							{
								printf("<center><font size=\"4\">Trebuie sa fii autentificat pentru a putea face rezervari</font></center><br>");
								printf("<center><img src=\"images/blocat.jpg\" width=\"350\" height=\"250\"></center>");
							}
				else
						{
							$idoferta=$_GET["id"];
							if (($nr1 = InterogareSQL("select a.nume,b.nume,c.pret,c.inceputperioada,c.sfarsitperioada,c.adrimg from pf_localitati a,pf_localitati b,pf_oferteexcursii c where a.idlocalitate=c.idlocplecare and b.idlocalitate=c.idlocsosire and c.idoferta=".$idoferta.";",$rez1)) != 0)
							{
								for ($i=0;$i<$nr1;$i++)
									{
										$linie1 = CitesteLinie($rez1,$i);
										printf("<div class=\"section_full\">");
										printf("<p>");
										printf("<h2><font size=\"4\"><b>%s - %s</b></font></h2>",$linie1[0],$linie1[1]);
										printf("<img src=\"imgoferteexcursii/%s\" width=\"450\" height=\"280\" border=\"0\" class=\"feat_thumb\" />",$linie1[5]);
										printf("<div class=\"feat_details\">");
										printf("<h2><center><font size=\"4\"><b>INFORMATII</b></font></center></h2>");
										printf("<table width=\"450\">");
										printf("<tr><td><b><font size=\"3\">DE LA</font></b></td><td><font size=\"3\">%s</font><font color=\"red\" size=\"3\"><b> EUR </b></font><font size=\"3\">/persoana</font></td></tr>",$linie1[2]);
										printf("<tr><td><b><font size=\"3\">PERIOADA</font></b></td><td><font size=\"3\">%s - %s</font></td></tr>",$linie1[3],$linie1[4]);
										printf("<tr><td><img src=\"images/buy.jpg\" width=\"50\"></td><td><a href=\"solicitare.php?id=%s&uid=%s\" class=\"order_button\">SOLICITA OFERTA</a></td></tr>",$idoferta,$_SESSION["userid"]);
										printf("</table>");
										printf("</p>");
										printf("</div>");
										printf("</div>");
									}
							}
						}
				?>
            </div>
            
  <div class="center_content">

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
</div>
 
</body>
</html>