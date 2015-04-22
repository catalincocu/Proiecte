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
                <li class="selected"><a href="hoteluri.php">Hoteluri</a></li>
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
            <h1>Oferta</h1>
            </div>
			<div class="section_23">
              <h2>Hoteluri</h2>
              <p>
				<?php
			if (isset($_GET['btncauta']))
						{
							$localitatea = $_GET["localitate"];
							$pret = $_GET["pret"];
							$interogaresql = "select a.numehotel,a.descriere,a.adrimg,a.idhotel from pf_hoteluri a where a.idhotel>0";
							if ($localitatea <> "-")
								$interogaresql = $interogaresql . " and a.idlocalitate=" . $localitatea;
							if ($pret <> "-")
								$interogaresql = $interogaresql . " and a.pretcamsingle<=" . $pret;
							$interogaresql = $interogaresql . ";";
							if (($nr1 = InterogareSQL($interogaresql,$rez1)) !=0 )
								{
									printf("<div class=\"section_13\">");
										for ($i=0;$i<$nr1;$i++)
											{
												$linie1 = CitesteLinie($rez1,$i);
												printf("<table height=\"160\">");
												printf("<img src=\"imghoteluri/%s\" width=\"240\" height=\"150\" border=\"1\" class=\"feat_thumb\" />",$linie1[2]);
												printf("<div class=\"feat_details\">");
												printf("<tr><td><b><font size=\"2\">HOTEL %s</font></b></td></tr><tr><td>%s</td></tr>",$linie1[0],$linie1[1]);
												printf("<tr><td><a href=\"detaliihotel.php?id=%s\" class=\"order_button\">Vezi detalii</a></td><br>",$linie1[3]);
												printf("</div>");
												printf("</table>");
											}
									printf("</div>");
								}
						}
			else
				if (($nr1 = InterogareSQL("select a.numehotel,a.descriere,a.adrimg,a.idhotel from pf_hoteluri a;",$rez1)) != 0)
					{
						printf("<div class=\"section_13\">");
						for ($i=0;$i<$nr1;$i++)
							{
								$linie1 = CitesteLinie($rez1,$i);
								printf("<table height=\"160\">");
								printf("<img src=\"imghoteluri/%s\" width=\"240\" height=\"150\" border=\"1\" class=\"feat_thumb\" />",$linie1[2]);
								printf("<div class=\"feat_details\">");
								printf("<tr><td><b><font size=\"2\">HOTEL %s</font></b></td></tr><tr><td>%s</td></tr>",$linie1[0],$linie1[1]);
								printf("<tr><td><a href=\"detaliihotel.php?id=%s\" class=\"order_button\">Vezi detalii</a></td><br>",$linie1[3]);
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
              <h2>Cautare hotel</h2>
              <p>
				<form id="form2" method="get" target="hoteluri.php">
					<table width="300">
						<tr>
						<td><font size="3">localitate</font></td>
						<td>
						<select id="select1" name="localitate" class="order_button">
						<option value="-">-</option>
						<?php
						if (($nr2 = InterogareSQL("select idlocalitate,nume from pf_localitati where idlocalitate in (select idlocalitate from pf_hoteluri);",$rez2)) != 0)
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
						<td><font size="3">pret maxim/cam/noapte</font></td>
						<td>
						<select id="select3" name="pret" class="order_button">
						<option value="-">-</option>
						<?php
								for ($i=60;$i>40;$i--)
								{
									printf("<option value=\"%s\">%s</option>",$i,$i);
								}
						?>
						</select>
						</td>
						</tr>
					</table>
					<input id="btncauta" type="submit" name="btncauta" class="order_button" value="Cauta" onclick="this.form.target='_self';return true;"/>
				</form>
              </p>             
              </div>
            </div>
			<?php
			if (($nr3 = InterogareSQL("select c.idoferta,a.nume,a.tara,b.nume,b.tara from pf_localitati a,pf_localitati b,pf_oferteexcursii c where c.idlocplecare=a.idlocalitate and c.idlocsosire=b.idlocalitate;",$rez3)) != 0)
				{
					printf("<div class=\"section_13\">");
					printf("<img src=\"images/visit.png\" width=\"70\" border=\"0\" class=\"feat_thumb\" />");
					printf("<div class=\"feat_details\">");
					printf("<h2><font color=\"blue\">Oferte sejururi</font></h2>");
					printf("<table height=\"300\" border=\"0\">");
						for ($i=0;$i<$nr3;$i++)
							{
								$linie3 = CitesteLinie($rez3,$i);
								printf("<tr><td><a href=\"detaliioferta.php?id=%s\">%s(%s)</a></td><td><a href=\"detaliioferta.php?id=%s\">%s(%s)</a></td></tr>",$linie3[0],$linie3[1],$linie3[2],$linie3[0],$linie3[3],$linie3[4]);
							}
					printf("</table>");
					printf("</div>");
					printf("<img src=\"images/animatie1.gif\" width=\"420\" height=\"180\" border=\"1\" />");
					printf("</div>");
				}
			?>
			<div class="section_13">
              <a href="transport.php"><img src="images/bileteavionromania.jpg" width="420" height="70"/></a>
			</div>
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
