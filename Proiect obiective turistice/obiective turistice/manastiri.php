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
<div id="logo"><a>Obiectivele turistice din Bucovina</a>
	<?
	if (isset($_SESSION['user']))
		{
			$numeutilizator = $_SESSION['user'];
			$id = $_SESSION['id'];
			printf("<small><a href=\"utilizator.php?uid=$id\">$numeutilizator</a>| <a href=\"logout.php?pgid=m\">Deconectare</a></small></div>");
		}
	else
		{ ?>
			<small><a href="login.php?pgid=m">Login</a> | <a href="inregistrare.php?pgid=m">Inregistrare</a></small></div>
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
			<form name="f2" method="get" target="manastiri.php">
			<table>
			<tr><td colspan='2'><input class="textbox" type="text" name="txtcautare" style="width:255px;height:25px;font-size:20px;font-family:'Quintessential',cursive;"></td></tr>
			<tr><td style="width:130px;"><input type="checkbox" name="cautatot"><font style="height:auto;font-family:'Quintessential',cursive;font-size:15px;"><b>Toate obiectivele</b></font></td><td><input type="submit" name="buton_cauta" value="Cauta" style="width:125px;height:25px;font-size:18px;background-color:#99D6AD;" onclick="this.form.target='_self';return true;"/></td>
			</tr>
			</table>
			</form>
			<ul>
				  <li></li>
			</ul>
		<h2>Unitati de cazare</h2>
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
				if (isset($_GET['m']))
					{
						$m = $_GET['m'];
						$interogare = "select * from t_obiective where tip='manastire' and idobiectiv=$m;";
						if (($nr1 = InterogareSQL($interogare,$rezultat1)) != 0)
								{
									for ($i=0;$i<$nr1;$i++)
										{
											$linie1 = CitesteLinie($rezultat1,$i);
											$id = $linie1[0];
											$nume = $linie1[1];
											$localitate = $linie1[3];
											$descriere = $linie1[4];
											$fotografie1 = $linie1[5];
											$interogare5 = "select avg(nota) from t_evaluari where idobiectiv=$m;";
											$media = "0";
											if (($nr5 = InterogareSQL($interogare5,$rezultat5)) != 0)
												{
													for ($j=0;$j<$nr5;$j++)
														{
															$linie5 = CitesteLinie($rezultat5,$j);
															$media = $linie5[0];
														}
												}
											$interogare6 = "select * from t_evaluari where idobiectiv=$m;";
											$nr6 = "0";
											$nr6 = InterogareSQL($interogare6,$rezultat6);
										?>
										<div id="text">
										<h3><?php printf("%s - %s",$nume,$localitate);?></h3>
										<?php printf("<img src=\"foto/%s\" style=\"width:650px;height:350px;\" />",$fotografie1);?>
										<p style="height:auto;font-family:'Quintessential',cursive;font-size:16px;"><?php printf("%s",$descriere);?><br><?php printf("<a href=\"salvaredetalii.php?ido=$id\"><img src=\"images/pdf-icon.gif\" style=\"width:50px; height:50px;\"></a>");?><br></p><br><b><p align="center" style="height:auto;font-family:Helvetica, Arial, sans-serif;font-size:12px;color:#0489B1;"><?php if ($nr6 == 0) printf("Acest obiectiv nu a fost evaluat."); else printf("Acest obiectiv are nota %s din %s evaluari.",round($media),$nr6);?></p></b>
										<br>
											<?php 
												$link = "http://apollo.eed.usv.ro/~cocu_c/ancaspiridon/aplicatie/manastiri.php?m=" . $m;
												printf("<div class=\"fb-share-button\" data-href=$link data-width=\"40\" data-type=\"icon_link\"></div>");
											?>
										</div>
								<?php
										}
								} ?>
								<h3 style="height:20px; font-size:16px; text-align:center;">Comentarii</h3>
								<?php
								if (isset($_POST["buton_trimite"]))
									{
										$idobiectiv = $_POST['m'];
										$iduser = $_SESSION['id'];
										$titlu = $_POST["texttitlu"];
										$text = $_POST["textmesaj"];
										$data = date('Y-m-d', time());
										$nota = $_POST["nota"];
										$interogare3 = "insert into t_comentarii(iduser,idobiectiv,titlu,text,data) values($iduser,$idobiectiv,'$titlu','$text','$data');";
										InterogareSQL($interogare3,$rezultat3);
										$interogare4 = "insert into t_evaluari(idobiectiv,nota,idutilizator) values($idobiectiv,$nota,$iduser);";
										InterogareSQL($interogare4,$rezultat4);
										printf("<font style=\"font-size:16px;color:#005200;\"><center>Mesajul a fost trimis!</center></font>");
									}
								else
								{
								?>
									<form name="f1" method="post" target="manastiri.php">
									<table style="padding-left:90px;">
									<tr>
										<td colspan='2' style="font-size:16px;font-weight:bold;">Parerea ta conteaza!<br><font style="font-size:12px;font-weight:bold;color:#808080"><?php printf("despre %s",$nume);?></font></td><td></td>
									</tr>
									<tr>
										<td style="font-size:16px;font-weight:bold;">Titlu</td><td><input type="text" name="texttitlu" style="width:328px;height:30px;background-color:#99D6AD;"></td><td></td>
									</tr>
									<tr>
										<td colspan='3'><textarea name="textmesaj" rows="4" style="width:370px;height:100px;background-color:#99D6AD;"></textarea></td>
									</tr>
									<tr>
										<td style="font-size:16px;font-weight:bold;">Nota </td>
										<td><select name="nota" style="width:50px;height:30px;background-color:#99D6AD;font-size:18px;font-weight:bold;">
												<option value="1">1</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>
												<option value="5">5</option>
												<option value="6">6</option>
												<option value="7">7</option>
												<option value="8">8</option>
												<option value="9">9</option>
												<option value="10">10</option>
										</select></td><td></td>
									</tr>
									<tr>
										<td></td><td></td><td><input type="submit" value="Trimite" name="buton_trimite" style="width:140px;height:30px;font-size:16px;background-color:#99D6AD;font-weight:bold;" onclick="this.form.target='_self';return true;"/></td>
										<?php printf("<input type=\"hidden\" name=\"m\" value=\"$m\">"); ?>
									</tr>
									</table>
									</form>
								<?php
								}
						$interogare2 = "select a.nume_utilizator,b.titlu,b.text,b.data from t_utilizatori a,t_comentarii b where a.iduser=b.iduser and b.idobiectiv=$m order by b.data desc;";
						if (($nr1 = InterogareSQL($interogare2,$rezultat2)) != 0)
								{
									for ($i=0;$i<$nr1;$i++)
										{
											$linie2 = CitesteLinie($rezultat2,$i);
											$numeutilizator = $linie2[0];
											$titlu = $linie2[1];
											$text = $linie2[2];
											$data = $linie2[3];
										?>
										<div id="text" style="padding-left:30px;height:100px;width:650px;border-bottom:solid 1px #646464;">
										<p style="padding-left:40px;"><?php printf("<font style='font-family:arial;font-size:16px;'>%s</font><font style='font-family:arial;font-size:11px;color:#647C64;'> a scris pe %s</font><br><br><font style='font-family:arial;font-size:14px;color:#003D14;'>%s</font>,<br><font style='font-family:arial;font-size:14px;color:#003D14;'>%s</font>",$numeutilizator,$data,$titlu,$text);?></p>						
										</div>
								<?php
										}
								}
						else
							{
								printf("<font style='font-family:arial;font-size:16px;padding-left:40px;'>Nu exista comentarii!</font>");
							}
					}
				else
					{
						if (isset($_GET["buton_cauta"]))
							{
								$text = $_GET["txtcautare"];
								$text = strtolower($text);
								$interogare3 = "select * from t_obiective where tip='manastire'";
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
															<p><?php printf("<font style=\"height:auto;font-family:'Quintessential',cursive;font-size:17px;\">%s</font>",$descrierescurta);?></p><?php if (isset($_SESSION['user'])) { ?> <div class="detalii"><?php printf("<a href='manastiri.php?m=%s'>detalii...</a>",$id);?></div><?php } ?>
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
							{
								$interogare = "select * from t_obiective where tip='manastire'";
								if (($nr1 = InterogareSQL($interogare,$rezultat1)) != 0)
									{
										for ($i=0;$i<$nr1;$i++)
											{
												$linie1 = CitesteLinie($rezultat1,$i);
												$id = $linie1[0];
												$nume = $linie1[1];
												$localitate = $linie1[3];
												$descriere = $linie1[4];
												$descrierescurta = substr($descriere,0,350);
												$descrierescurta = $descrierescurta . "...";
												$fotografie1 = $linie1[5];
											?>
											<div id="text">
											<h1><?php printf("%s - %s",$nume,$localitate);?></h1>
											<?php printf("<img src=\"foto/%s\" width=\"280\" height=\"150\"/>",$fotografie1);?>
											<p><?php printf("<font style=\"height:auto;font-family:'Quintessential',cursive;font-size:17px;\">%s</font>",$descrierescurta);?></p><?php if (isset($_SESSION['user'])) { ?> <div class="detalii"><?php printf("<a href='manastiri.php?m=%s'>detalii...</a>",$id);?></div><?php } ?>
											</div>
									<?php
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
							}
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
