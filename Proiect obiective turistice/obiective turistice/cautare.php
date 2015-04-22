<?php
require('interog.inc');
session_start();
if (isset($_GET["buton_cauta"]))
	{
		if (isset($_GET['cautatot']))
			{
				$text = $_GET["txtcautare"];
				header("location:cautare.php?txtcautare=$text&buton_cauta=Cauta");
			}
	}
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
<div id="mainbg">
<div id="main">
<!-- header begins -->
<div id="logo"><a>Obiectivele turistice din Bucovina</a>
	<?
	if (isset($_SESSION['user']))
		{
			$numeutilizator = $_SESSION['user'];
			$id = $_SESSION['id'];
			printf("<small><a href=\"utilizator.php?uid=$id\">$numeutilizator</a>| <a href=\"logout.php?pgid=mz\">Deconectare</a></small></div>");
		}
	else
		{ ?>
			<small><a href="login.php?pgid=mz">Login</a> | <a href="inregistrare.php?pgid=mz">Inregistrare</a></small></div>
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
		<h2>Cautare</h2>
			<form name="f2" method="get" target="muzee.php">
			<table>
			<tr><td colspan='2'><input class="textbox" type="text" name="txtcautare" style="width:255px;height:25px;font-size:20px;font-family:'Quintessential',cursive;"></td></tr>
			<tr><td style="width:130px"></td><td><input type="submit" name="buton_cauta" value="Cauta" style="width:125px;height:25px;font-size:18px;background-color:#99D6AD;" onclick="this.form.target='_self';return true;"/></td>
			</tr>
			</table>
			</form>
			<ul>
				  <li></li>
			</ul>
		<h2>Pensiuni recomandate</h2>
		<?php
			$interogare1 = "select * from t_obiective where tip='pensiune'";
			if (($nr2 = InterogareSQL($interogare1,$rezultat2)) != 0)
								{
									for ($i=0;$i<$nr2-1;$i++)
										{
											$linie2 = CitesteLinie($rezultat2,$i);
											$id = $linie2[0];
											$nume = $linie2[1];
											$localitate = $linie2[3];
											$fotografie1 = $linie2[5];
											printf("<a href='pensiuni.php?p=%s'><table><tr><td><img src=\"foto/%s\" style=\"width:65px;height:50px;\" /></td><td style=\"font-size:13px;\">%s<br>%s</td></tr></table></a>",$id,$fotografie1,$nume,$localitate);
										}
								}
		?>
	</div>
    <div id="left">
		<?php
						if (isset($_GET["buton_cauta"]))
							{
								$text = $_GET["txtcautare"];
								$text = strtolower($text);
								$interogare3 = "select * from t_obiective;";
								if (($nr3 = InterogareSQL($interogare3,$rezultat3)) != 0)
									{
										$ok = 0;
										for ($i=0;$i<$nr3;$i++)
											{
												$linie3 = CitesteLinie($rezultat3,$i);
												$titlu = $linie3[1];
												$tip = $linie3[2];
												$localitate = $linie3[3];
												$titlu = strtolower($titlu);
												$localitate = strtolower($localitate);
												$textpentrucautare = $titlu . " " . $localitate;
												$pos = strpos($textpentrucautare,$text);
												if($pos === false) 
													{
													
													}
												else 
													{
														$ok = 1;
														$id = $linie3[0];
														$nume = $linie3[1];
														$localitate = $linie3[3];
														$descriere = $linie3[4];
														$descrierescurta = substr($descriere,0,350);
														$descrierescurta = $descrierescurta . "...";
														$fotografie1 = $linie3[5];
														?>
															<div id="text">
															<h1><?php printf("%s - %s",$nume,$localitate);?></h1>
															<?php printf("<img src=\"foto/%s\" width=\"280\" height=\"150\"/>",$fotografie1);?>
															<p>
																<?php printf("<font style=\"height:auto;font-family:'Quintessential',cursive;font-size:17px;\">%s</font>",$descrierescurta);?>
															</p>
																<?php 
																		if (isset($_SESSION['user'])) 
																			{ ?> 
																				<div class="detalii">
																					<?php 
																						if ($tip == "manastire")
																							printf("<a href='manastiri.php?m=%s'>detalii...</a>",$id);
																						if ($tip == "muzeu")
																							printf("<a href='muzee.php?mz=%s'>detalii...</a>",$id);
																						if ($tip == "pensiune")
																							printf("<a href='pensiuni.php?p=%s'>detalii...</a>",$id);
																						if ($tip == "rezervatie")
																							printf("<a href='rezervatii.php?rz=%s'>detalii...</a>",$id);
																						if ($tip == "restaurant")
																							printf("<a href='restaurante.php?r=%s'>detalii...</a>",$id);
																					?>
																				</div>
																			<?php 
																			} 
																			?>
															</div>
														<?php
													}
											}
										if ($ok == 0)
											{
												?>
													<div id="text" style="height:410px;">
													<?php if ($ok == 0) printf("<center><br><br><br><br><br><br><br><font style=\"font-size:18px;\">Nici un rezultat gasit!</font></center>");?>
													</div>
												<?php
											}
									}
							}
					else
						{ ?>
										<div id="text">
										<h1>Nu sunt inregistrari in baza de date</h1>
										<img src="images/pic01.jpg"/>
										<p>Nu s-a gasit nicio descriere</p>
										</div>
						<?php
						}
					?>
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
