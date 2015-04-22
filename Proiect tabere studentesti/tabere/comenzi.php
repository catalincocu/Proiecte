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
            <h1>Comenzile mele</h1>
            </div>
				<?php
				if (!isset($_SESSION["ok"]))
							{
								printf("<center><font size=\"4\">Trebuie sa fii autentificat pentru a putea vizualiza comenzile</font></center><br>");
								printf("<center><img src=\"images/blocat.jpg\" width=\"350\" height=\"250\"></center>");
							}
				else
						{
							$idutilizator=$_GET["uid"];
							$comenzi = 0;
							if (($nr1 = InterogareSQL("select a.idbiletzbor,a.dataachizitie,a.dataplecare,b.adrimg,c.nume,d.nume from pf_biletezbor a,pf_ofertebiletezbor b,pf_localitati c,pf_localitati d where b.idlocplecare=c.idlocalitate and b.idlocsosire=d.idlocalitate and a.idofertazbor=b.idofertazbor and a.idutilizator=".$idutilizator.";",$rez1)) != 0)
							{	
								$comenzi = 1;
								for ($i=0;$i<$nr1;$i++)
									{
										$linie1 = CitesteLinie($rez1,$i);
										printf("<div class=\"section_full\">");
										printf("<p>");
										printf("<h2>Bilet - <font size=\"5\" color=\"red\"><b>%s - %s</b></font></h2>",$linie1[4],$linie1[5]);
										printf("<img src=\"imgofertezbor/%s\" width=\"350\" height=\"160\" border=\"0\" class=\"feat_thumb\" />",$linie1[3]);
										printf("<div class=\"feat_details\">");
										printf("<h2><center><font size=\"4\"><b>INFORMATII</b></font></center></h2>");
										printf("<table width=\"450\">");
										printf("<tr><td><b><font size=\"3\">Data achizitie</font></b></td><td><font size=\"3\">%s</font></td></tr>",$linie1[1]);
										printf("<tr><td><b><font size=\"3\">Data plecare</font></b></td><td><font size=\"3\">%s</font></td></tr>",$linie1[2]);
										printf("<tr><td><img src=\"images/buy.jpg\" width=\"50\"></td><td><a href=\"anulare.php?idbilet=%s\" class=\"order_button\">Anuleaza</a></td></tr>",$linie1[0]);
										printf("</table>");
										printf("</p>");
										printf("</div>");
										printf("</div>");
									}
							}
							if (($nr1 = InterogareSQL("select a.idsolicitare,a.dataachizitie,a.dataplecare,b.adrimg,c.nume,d.nume from pf_solicitarioferte a,pf_oferteexcursii b,pf_localitati c,pf_localitati d where b.idlocplecare=c.idlocalitate and b.idlocsosire=d.idlocalitate and a.idoferta=b.idoferta and a.idutilizator=".$idutilizator.";",$rez1)) != 0)
							{
								$comenzi = 1;
								for ($i=0;$i<$nr1;$i++)
									{
										$linie1 = CitesteLinie($rez1,$i);
										printf("<div class=\"section_full\">");
										printf("<p>");
										printf("<h2>Oferta - <font size=\"5\" color=\"red\"><b>%s - %s</b></font></h2>",$linie1[4],$linie1[5]);
										printf("<img src=\"imgoferteexcursii/%s\" width=\"350\" height=\"160\" border=\"0\" class=\"feat_thumb\" />",$linie1[3]);
										printf("<div class=\"feat_details\">");
										printf("<h2><center><font size=\"4\"><b>INFORMATII</b></font></center></h2>");
										printf("<table width=\"450\">");
										printf("<tr><td><b><font size=\"3\">Data achizitie</font></b></td><td><font size=\"3\">%s</font></td></tr>",$linie1[1]);
										printf("<tr><td><b><font size=\"3\">Data plecare</font></b></td><td><font size=\"3\">%s</font></td></tr>",$linie1[2]);
										printf("<tr><td><img src=\"images/buy.jpg\" width=\"50\"></td><td><a href=\"anulare.php?idsolicitare=%s\" class=\"order_button\">Anuleaza</a></td></tr>",$linie1[0]);
										printf("</table>");
										printf("</p>");
										printf("</div>");
										printf("</div>");
									}
							}
							if (($nr1 = InterogareSQL("select a.idrezervare,a.datarezervare,a.cost,b.numehotel,b.adrimg from pf_rezervari a,pf_hoteluri b where a.idhotel=b.idhotel and a.idutilizator=".$idutilizator.";",$rez1)) != 0)
							{
								$comenzi = 1;
								for ($i=0;$i<$nr1;$i++)
									{
										$linie1 = CitesteLinie($rez1,$i);
										printf("<div class=\"section_full\">");
										printf("<p>");
										printf("<h2>Rezervare hotel - <font size=\"5\" color=\"red\"><b>%s</b></font></h2>",$linie1[3]);
										printf("<img src=\"imghoteluri/%s\" width=\"350\" height=\"160\" border=\"0\" class=\"feat_thumb\" />",$linie1[4]);
										printf("<div class=\"feat_details\">");
										printf("<h2><center><font size=\"4\"><b>INFORMATII</b></font></center></h2>");
										printf("<table width=\"450\">");
										printf("<tr><td><b><font size=\"3\">Data rezervare</font></b></td><td><font size=\"3\">%s</font></td></tr>",$linie1[1]);
										printf("<tr><td><b><font size=\"3\">Cost</font></b></td><td><font size=\"3\">%s</font><font size=\"3\" color=\"red\"><b>EUR</b></font></td></tr>",$linie1[2]);
										printf("<tr><td><img src=\"images/buy.jpg\" width=\"50\"></td><td><a href=\"anulare.php?idrezervare=%s\" class=\"order_button\">Anuleaza</a></td></tr>",$linie1[0]);
										printf("</table>");
										printf("</p>");
										printf("</div>");
										printf("</div>");
									}
							}
							
							if ($comenzi == 0)
								{
									printf("<center><font size=\"4\">Nu ai nicio comanda efectuata pana acum!</font></center><br>");
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