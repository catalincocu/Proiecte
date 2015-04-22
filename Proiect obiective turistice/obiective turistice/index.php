<?php
require('interog.inc');
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Obiectivele turistice din Bucovina</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="styles.css" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Quintessential' rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="nivo-slider.css" type="text/css" media="screen" />
</head>
<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div id="mainbg">
<div id="main">
<!-- header begins -->
<div id="logo"><a href="#">Obiectivele turistice din Bucovina</a>
		<?
		if (isset($_SESSION['user']))
		{
			$numeutilizator = $_SESSION['user'];
			$id = $_SESSION['id'];
			printf("<small><a href=\"utilizator.php?uid=$id\">$numeutilizator</a>| <a href=\"logout.php?pgid=m\">Deconectare</a></small></div>");
		}
	else
		{ ?>
			<small><a href="login.php?pgid=i">Login</a> | <a href="inregistrare.php?pgid=i">Inregistrare</a></small></div>
		<?php
		} ?>
<div id="header">

    <div id="slider-wrapper">        
            <div id="slider" class="nivoSlider">
                <img src="images/header.jpg" alt="" />
                <img src="images/header2.jpg" alt=""/>
                <img src="images/header3.jpg" alt="" />
				<img src="images/header4.jpg" alt="" />
            </div>        
        </div>

<script type="text/javascript" src="js/jquery-1.4.3.min.js"></script>
    <script type="text/javascript" src="js/jquery.nivo.slider.pack.js"></script>
    <script type="text/javascript">
    $(window).load(function() {
        $('#slider').nivoSlider();
    });
    </script>

</div>
	<div id="buttons">
		<ul>
			<li class="first"><a href="index.php"  title="">Home</a></li>
			<li><a href="manastiri.php" title="">Manastiri</a></li>
			<li><a href="muzee.php" title="">Muzee</a></li>
			<li><a href="rezervatii.php" title="">Rezervatii naturale</a></li>
			<li><a href="pensiuni.php" title="">Pensiuni</a></li>
			<li><a href="restaurante.php" title="">Restaurante</a></li>
		</ul>
</div>
<!-- header ends -->
<!-- content begins -->
<div id="content_bg">
  <div id="content">
	<div id="right">
		<h2>Unitati de cazare</h2>
		<?php
			$interogare1 = "select * from t_obiective where tip='pensiune'";
			if (($nr2 = InterogareSQL($interogare1,$rezultat2)) != 0)
								{
											$linie2 = CitesteLinie($rezultat2,0);
											$id = $linie2[0];
											$nume = $linie2[1];
											$localitate = $linie2[3];
											$fotografie1 = $linie2[5];
											printf("<table><tr>");
											printf("<td style=\"font-size:9px;\"><a href='pensiuni.php?p=%s'><img src=\"foto/%s\" style=\"width:100px;height:55px;\" /></a><br>%s<br>%s</td>",$id,$fotografie1,$nume,$localitate);
											$linie2 = CitesteLinie($rezultat2,1);
											$id = $linie2[0];
											$nume = $linie2[1];
											$localitate = $linie2[3];
											$fotografie1 = $linie2[5];
											printf("<td style=\"font-size:9px;\"><a href='pensiuni.php?p=%s'><img src=\"foto/%s\" style=\"width:100px;height:55px;\" /></a><br>%s<br>%s</td>",$id,$fotografie1,$nume,$localitate);
											printf("</tr></table>");
								}
		?>
		<h2>Restaurante recomandate</h2>
		<?php
			$interogare1 = "select * from t_obiective where tip='restaurant'";
			if (($nr2 = InterogareSQL($interogare1,$rezultat2)) != 0)
								{
											$linie2 = CitesteLinie($rezultat2,0);
											$id = $linie2[0];
											$nume = $linie2[1];
											$localitate = $linie2[3];
											$fotografie1 = $linie2[5];
											printf("<table><tr>");
											printf("<td style=\"font-size:9px;\"><a href='restaurante.php?r=%s'><img src=\"foto/%s\" style=\"width:100px;height:55px;\" /></a><br>%s<br>%s</td>",$id,$fotografie1,$nume,$localitate);
											$linie2 = CitesteLinie($rezultat2,1);
											$id = $linie2[0];
											$nume = $linie2[1];
											$localitate = $linie2[3];
											$fotografie1 = $linie2[5];
											printf("<td style=\"font-size:9px;\"><a href='restaurante.php?r=%s'><img src=\"foto/%s\" style=\"width:100px;height:55px;\" /></a><br>%s<br>%s</td>",$id,$fotografie1,$nume,$localitate);
											printf("</tr></table>");
								}
		?>
		<h2>Locase de cult</h2>
		<?php
			$interogare1 = "select * from t_obiective where tip='manastire'";
			if (($nr2 = InterogareSQL($interogare1,$rezultat2)) != 0)
								{
											$linie2 = CitesteLinie($rezultat2,0);
											$id = $linie2[0];
											$nume = $linie2[1];
											$localitate = $linie2[3];
											$fotografie1 = $linie2[5];
											printf("<table><tr>");
											printf("<td style=\"font-size:9px;\"><a href='manastiri.php?m=%s'><img src=\"foto/%s\" style=\"width:100px;height:55px;\" /></a><br>%s<br>%s</td>",$id,$fotografie1,$nume,$localitate);
											$linie2 = CitesteLinie($rezultat2,1);
											$id = $linie2[0];
											$nume = $linie2[1];
											$localitate = $linie2[3];
											$fotografie1 = $linie2[5];
											printf("<td style=\"font-size:9px;\"><a href='manastiri.php?m=%s'><img src=\"foto/%s\" style=\"width:100px;height:55px;\" /></a><br>%s<br>%s</td>",$id,$fotografie1,$nume,$localitate);
											printf("</tr></table>");
								}
		?>
		<h2>Rezervatii naturale</h2>
		<?php
			$interogare1 = "select * from t_obiective where tip='rezervatie'";
			if (($nr2 = InterogareSQL($interogare1,$rezultat2)) != 0)
								{
											$linie2 = CitesteLinie($rezultat2,0);
											$id = $linie2[0];
											$nume = $linie2[1];
											$localitate = $linie2[3];
											$fotografie1 = $linie2[5];
											printf("<table><tr>");
											printf("<td style=\"font-size:9px;\"><a href='rezervatii.php?rz=%s'><img src=\"foto/%s\" style=\"width:100px;height:55px;\" /></a><br>%s<br>%s</td>",$id,$fotografie1,$nume,$localitate);
											$linie2 = CitesteLinie($rezultat2,1);
											$id = $linie2[0];
											$nume = $linie2[1];
											$localitate = $linie2[3];
											$fotografie1 = $linie2[5];
											printf("<td style=\"font-size:9px;\"><a href='rezervatii.php?rz=%s'><img src=\"foto/%s\" style=\"width:100px;height:55px;\" /></a><br>%s<br>%s</td>",$id,$fotografie1,$nume,$localitate);
											printf("</tr></table>");
								}
		?>
	</div>
          	<div id="left">
			<h1>Bun venit!</h1>
		<div id="text">
		<img src="images/harta.jpg" alt="" title="" style="width:350px; height:250px; padding-right:15px; float:left; padding-left:5px;" />
                <p style="height:auto;font-family:'Quintessential',cursive;font-size:16px;">Leagan de veche civilizatie, unde istoria se impleteste cu legenda, este cunoscuta sub aspect turistic in primul rand pentru renumitele biserici cu fresce exterioare-patrimoniu UNESCO: Moldovita, Sucevita, Voronet, Humor. Nu mai putin importante sub aspect ahitectonic si istoric sunt manastirile Putna, Neamtului, Dragomirna.
<br>Toate aceste bijuterii arhitectonice se incadreaza perfect intr-un cadru natural de exceptie. Masivul Rarau, valea Sucevei, valea Moldovei cu afluentul sau valea Moldovitei, Defileul Bistritei Aurii, Codrii seculari de la Slatioara sunt doar cateva puncte de maxim interes turistic.
<br>Arhitectura populara este absolut unica si originala. Adevaratele broderii in lemn ofera cerdacurile, usile si ramele ferestrelor, fantanile, portile si gardurile. La acestea se adauga decoratiunile exterioare cu motive geometrice sau florale stilizate si divers colorate, cu precadere in satele de pe valea Bistritei Aurii, dintre care cel mai cunoscut este Ciocanesti.
<br>Arta tesaturilor si a cusaturilor, incondeierea oualor cu splendide si simbolice miniaturi geometrice, confectionarea costumelor populare cu broderii de margele si blana de jder sunt comori incontestabile ale artei populare bucovinene.
<br />
<table>
<tr>
	<td style="width:650px;"></td><td><div class="fb-like" data-href="http://apollo.eed.usv.ro/~cocu_c/ancaspiridon/aplicatie/index.php" data-layout="box_count" data-action="like" data-show-faces="true" data-share="true"></div></td>
</tr>
</table>
				<div class="hrd"></div><br />
           </div>

	</div>
    </div>
</div>
<!-- content ends -->
<!-- footer begins -->
<div id="footer">
  <p>Copyright (c) 2014. | <a href="#">Anca Spiridon</a></p>
</div>
<!-- footer ends -->
</div>
</div>
</body>
</html>
