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
            <h1>Rezervare hotel</h1>
            </div>
				<?php
					if (isset($_POST["inregistreaza"]))
						{
							$idutilizator = $_POST["iduser"];
							$idoferta = $_POST["idoferta"];
							$datasolicitare = date('Y-m-d', time());
							$dataplecare = "";
							$dataluna = $_POST["dataluna"];
							$dataziua = $_POST["dataziua"];
							if ($dataluna == "-" or $dataziua == "-")
								{
									printf("<div class=\"section_full\">");
									printf("<h2>Data incorecta!</h2>");
									printf("<img src=\"images/error.png\" width=\"250\" height=\"200\"><a href=\"solicitare.php?id=%s&uid=%s\" class=\"order_button\">Inapoi</a>",$idoferta,$idutilizator);
									printf("</div>");
								}
							else
								{
									$dataplecare = "2013-" . $dataluna . "-" . $dataziua;
									InterogareSQL("insert into pf_solicitarioferte(idutilizator,dataachizitie,dataplecare,idoferta) values(".$idutilizator.",'".$datasolicitare."','".$dataplecare."',".$idoferta.");",$rez1);
									printf("<div class=\"section_full\">");
									printf("<h3>Solicitare efectuata!</h3>");
									printf("<a href=\"solicitare.php?id=%s&uid=%s\" class=\"order_button\">Inapoi</a>",$idoferta,$idutilizator);
									printf("</div>");
								}
						}
					else
							if (!isset($_SESSION["ok"]))
							{
								printf("<center><font size=\"4\">Trebuie sa fii autentificat pentru a putea face rezervari</font></center><br>");
								printf("<center><img src=\"images/blocat.jpg\" width=\"350\" height=\"250\"></center>");
							}
							else
							{
								$idof=$_GET["id"];
								$idusr=$_GET["uid"];
								printf("<form name=\"f1\" method=\"post\" action=\"solicitare.php\">");
								if (($nr1 = InterogareSQL("select c.idoferta,a.nume,b.nume,c.pret from pf_localitati a,pf_localitati b,pf_oferteexcursii c where a.idlocalitate=c.idlocplecare and b.idlocalitate=c.idlocsosire and c.idoferta=".$idof.";",$rez1)) != 0)
									{
										$linie1 = CitesteLinie($rez1,0);
										printf("<div class=\"section_full\">");
										printf("<div class=\"section_53\">");
										printf("<div class=\"feat_details\">");
										printf("<h2>Oferta sejur</h2>");
										printf("<div class=\"form_row\">");
										printf("<label>Plecare din:</label>");
										printf("<input type=\"text\" class=\"form_val\" name=\"locplecare\" value=\"%s\" readonly/>",$linie1[1]);
										printf("</div>");
										printf("<div class=\"form_row\">");
										printf("<label>Destinatie:</label>");
										printf("<input type=\"text\" class=\"form_val\" name=\"locsosire\" value=\"%s\" readonly/>",$linie1[2]);
										printf("</div>");
										printf("<div class=\"form_row\">");
										printf("<label>Pretul ofertei:</label>");
										printf("<input type=\"text\" class=\"form_val\" name=\"pret\" value=\"%s\" readonly/>",$linie1[3]);
										printf("</div>");
										printf("<div class=\"form_row\">");
										printf("<label>Data plecarii:</label>");
										printf("<select id=\"select1\" name=\"dataziua\" class=\"form_data\">");
										printf("<option value=\"-\">zi</option>");
											for ($i=1;$i<=31;$i++)
											{
												printf("<option value=\"%s\">%s</option>",$i,$i);
											}
										printf("</select>");
										printf("<select id=\"select2\" name=\"dataluna\" class=\"form_data\">");
										printf("<option value=\"-\">luna</option>");
											for ($i=1;$i<=12;$i++)
											{
												printf("<option value=\"%s\">%s</option>",$i,$i);
											}
										printf("</select>");
										printf("</div>");
										printf("<div class=\"form_row\">");
										printf("<input type=\"submit\" name=\"inregistreaza\" value=\"Trimite\" class=\"order_button\"/>");
										printf("</div>");
										printf("<input type=\"hidden\" name=\"idoferta\" value=\"%s\">",$linie1[0]);
										printf("</div>");
									}
								if (($nr2 = InterogareSQL("select * from pf_datepersonale where idutilizator=".$idusr.";",$rez2)) != 0)
									{
										$linie2 = CitesteLinie($rez2,0);
										printf("<div class=\"test_right2\">");
										printf("<h2>Date personale</h2>");
										printf("<div class=\"form_row\">");
										printf("<label>Nume:</label>");
										printf("<input type=\"text\" class=\"form_val\" name=\"nume\" value=\"%s\" readonly/>",$linie2[1]);
										printf("</div>");
										printf("<div class=\"form_row\">");
										printf("<label>Prenume:</label>");
										printf("<input type=\"text\" class=\"form_val\" name=\"prenume\" value=\"%s\" readonly/>",$linie2[2]);
										printf("</div>");
										printf("<div class=\"form_row\">");
										printf("<label>Strada:</label>");
										printf("<input type=\"text\" class=\"form_val\" name=\"strada\" value=\"%s\" readonly/>",$linie2[3]);
										printf("</div>");
										printf("<div class=\"form_row\">");
										printf("<label>Nr:</label>");
										printf("<input type=\"text\" class=\"form_val\" name=\"nr\" value=\"%s\" readonly/>",$linie2[4]);
										printf("</div>");
										printf("<div class=\"form_row\">");
										printf("<label>Ap:</label>");
										printf("<input type=\"text\" class=\"form_val\" name=\"ap\" value=\"%s\" readonly/>",$linie2[5]);
										printf("</div>");
										printf("<div class=\"form_row\">");
										printf("<label>Telefon:</label>");
										printf("<input type=\"text\" class=\"form_val\" name=\"telefon\" value=\"%s\" readonly/>",$linie2[6]);
										printf("</div>");
										printf("<div class=\"form_row\">");
										printf("<label>Email:</label>");
										printf("<input type=\"text\" class=\"form_val\" name=\"email\" value=\"%s\" readonly/>",$linie2[7]);
										printf("</div>");
										printf("<div class=\"form_row\">");
										printf("<label>Localitate:</label>");
										printf("<input type=\"text\" class=\"form_val\" name=\"localitate\" value=\"%s\" readonly/>",$linie2[8]);
										printf("</div>");
										printf("<div class=\"form_row\">");
										printf("<label>Judet:</label>");
										printf("<input type=\"text\" class=\"form_val\" name=\"judet\" value=\"%s\" readonly/>",$linie2[9]);
										printf("</div>");
										printf("<input type=\"hidden\" name=\"iduser\" value=\"%s\">",$linie2[10]);
										printf("</div>");
										printf("</div>");
									}
								printf("</div>");
								printf("</form>");
							}
				?>
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
