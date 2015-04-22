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
				<li class="selected"><a href="oferte.php">Oferte</a></li>
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
            <h1>Oferta</h1>
            </div>
            <div class="section_23">
              <h2>Sejururi</h2>
              <p>
				<?php
				if (isset($_GET['btncauta']))
						{
							$localitateplecare = $_GET["localitateplecare"];
							$localitatesosire = $_GET["localitatesosire"];
							$pret = $_GET["pret"];
							$interogaresql = "select c.idoferta,a.nume,b.nume,c.pret,c.inceputperioada,c.sfarsitperioada,c.adrimg from pf_localitati a,pf_localitati b,pf_oferteexcursii c where a.idlocalitate=c.idlocplecare and b.idlocalitate=c.idlocsosire";
							if ($localitateplecare <> "-")
								$interogaresql = $interogaresql . " and c.idlocplecare=" . $localitateplecare;
							if ($localitatesosire <> "-")
								$interogaresql = $interogaresql . " and c.idlocsosire=" . $localitatesosire;
							if ($pret <> "-")
								$interogaresql = $interogaresql . " and c.pret<=" . $pret;
							$interogaresql = $interogaresql . ";";
							if (($nr1 = InterogareSQL($interogaresql,$rez1)) !=0 )
								{
									printf("<div class=\"section_13\">");
										for ($i=0;$i<$nr1;$i++)
											{
												$linie1 = CitesteLinie($rez1,$i);
												printf("<table height=\"160\">");
												printf("<img src=\"imgoferteexcursii/%s\" width=\"240\" height=\"150\" border=\"1\" class=\"feat_thumb\" />",$linie1[6]);
												printf("<div class=\"feat_details\">");
												printf("<tr><td><b><font size=\"2\">%s - %s</font></b></td><td><b><a href=\"#\" class=\"order_button_rosu\"><font size=\"3\">%s€</font></a></b></td></tr>",$linie1[1],$linie1[2],$linie1[3]);
												printf("<tr><td>Perioada %s - %s</td><td></td></tr>",$linie1[4],$linie1[5]);
												printf("<tr><td><a href=\"detaliioferta.php?id=%s\" class=\"order_button\">Vezi detalii</a></td><br>",$linie1[0]);
												printf("</div>");
												printf("</table>");
											}
									printf("</div>");
								}
						}
				else
				if (($nr1 = InterogareSQL("select c.idoferta,a.nume,b.nume,c.pret,c.inceputperioada,c.sfarsitperioada,c.adrimg from pf_localitati a,pf_localitati b,pf_oferteexcursii c where a.idlocalitate=c.idlocplecare and b.idlocalitate=c.idlocsosire;",$rez1)) != 0)
					{
						printf("<div class=\"section_13\">");
						for ($i=0;$i<$nr1;$i++)
							{
								$linie1 = CitesteLinie($rez1,$i);
								printf("<table height=\"160\">");
								printf("<img src=\"imgoferteexcursii/%s\" width=\"240\" height=\"150\" border=\"1\" class=\"feat_thumb\" />",$linie1[6]);
								printf("<div class=\"feat_details\">");
								printf("<tr><td><b><font size=\"2\">%s - %s</font></b></td><td><b><a href=\"#\" class=\"order_button_rosu\"><font size=\"3\">%s€</font></a></b></td></tr>",$linie1[1],$linie1[2],$linie1[3]);
								printf("<tr><td>Perioada %s - %s</td><td></td></tr>",$linie1[4],$linie1[5]);
								printf("<tr><td><a href=\"detaliioferta.php?id=%s\" class=\"order_button\">Vezi detalii</a></td><br>",$linie1[0]);
								printf("</div>");
								printf("</table>");
							}
						printf("</div>");
					}
				?>
			  </p>             
            </div>
            <div class="section_13">
              <img src="images/search.png" width="70" alt="" title="" border="0" class="feat_thumb" />
              <div class="feat_details">
              <h2>Cauta oferta</h2>
              <p>
				<form id="form2" method="get" target="oferte.php">
					<table width="300">
						<tr>
						<td><font size="3">plecare din</font></td>
						<td>
						<select id="select1" name="localitateplecare" class="order_button">
						<option value="-">-</option>
						<?php
						if (($nr2 = InterogareSQL("select idlocalitate,nume from pf_localitati where idlocalitate in (select idlocplecare from pf_oferteexcursii);",$rez2)) != 0)
							{
								for ($i=0;$i<$nr2;$i++)
								{
									$linie2 = CitesteLinie($rez2,$i);
									printf("<option value=\"%s\">%s</option>",$linie2[0],$linie2[1]);
								}
							}
						?>
						</select>
						</td>
						</tr>
						<tr>
						<td><font size="3">destinatia</font></td>
						<td>
						<select id="select2" name="localitatesosire" class="order_button">
						<option value="-">-</option>
						<?php
						if (($nr3 = InterogareSQL("select idlocalitate,nume from pf_localitati where idlocalitate in (select idlocsosire from pf_oferteexcursii);",$rez3)) != 0)
							{
								for ($i=0;$i<$nr3;$i++)
								{
									$linie3 = CitesteLinie($rez3,$i);
									printf("<option value=\"%s\">%s</option>",$linie3[0],$linie3[1]);
								}
							}
						?>
						</select>
						</td>
						<tr>
						<td><font size="3">pret sub</font></td>
						<td>
						<select id="select3" name="pret" class="order_button">
						<option value="-">-</option>
						<?php
								for ($i=60;$i>40;$i--)
								{
									printf("<option value=\"%s\">%s EUR</option>",$i,$i);
								}
						?>
						</select>
						</td>
						</tr>
						</tr>
					</table>
					<input id="btncauta" type="submit" name="btncauta" class="order_button" value="Cauta" onclick="this.form.target='_self';return true;"/>
				</form>
              </p>             
              </div>
            </div>
			<?php
			if (($nr3 = InterogareSQL("select c.idofertazbor,a.nume,a.tara,b.nume,b.tara from pf_localitati a,pf_localitati b,pf_ofertebiletezbor c where c.idlocplecare=a.idlocalitate and c.idlocsosire=b.idlocalitate;",$rez3)) != 0)
				{
					printf("<div class=\"section_13\">");
					printf("<img src=\"images/fly.gif\" width=\"70\" border=\"0\" class=\"feat_thumb\" />");
					printf("<div class=\"feat_details\">");
					printf("<h2><font color=\"blue\">Oferta bilete calatorie pe traseele</font></h2>");
					printf("<table height=\"300\" border=\"0\">");
						for ($i=0;$i<$nr3;$i++)
							{
								$linie3 = CitesteLinie($rez3,$i);
								if (isset($_SESSION["userid"]))
									{
										printf("<tr><td><a href=\"achizitionare.php?id=%s&uid=%s\">%s(%s)</a></td><td><a href=\"achizitionare.php?id=%s&uid=%s\">%s(%s)</a></td></tr>",$linie3[0],$_SESSION["userid"],$linie3[1],$linie3[2],$linie3[0],$_SESSION["userid"],$linie3[3],$linie3[4]);
									}
								else
									{
										printf("<tr><td><a href=\"achizitionare.php?id=%s\">%s(%s)</a></td><td><a href=\"achizitionare.php?id=%s\">%s(%s)</a></td></tr>",$linie3[0],$linie3[1],$linie3[2],$linie3[0],$linie3[3],$linie3[4]);
									}
							}
					printf("</table>");
					printf("</div>");
					printf("</div>");
				}
			?>
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
</div>
</body>
</html>
