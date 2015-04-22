<?php
require('interog.inc');
session_start();
if (isset($_GET['pgid']))
	$pgid = $_GET['pgid'];
$incercare=0;
if (isset($_POST['buton_login']))
			{
				$incercare=1;
				if (($nr = InterogareSQL("select * from t_utilizatori where nume_utilizator='".$_POST["user"]."' and parola_utilizator='".$_POST["parola"]."';",$rez)) != 0)
				{
					$id_sesiune = session_id();
					$_SESSION["ok"] = 1;
					$_SESSION["user"] = $_POST['user'];
					$linie = CitesteLinie($rez,0);
					$_SESSION["id"] = $linie[0];
					if ($pgid == 'm')
						header("location:manastiri.php");
					if ($pgid == 'mz')
						header("location:muzee.php");
					if ($pgid == 'rz')
						header("location:rezervatii.php");
					if ($pgid == 'p')
						header("location:pensiuni.php");
					if ($pgid == 'r')
						header("location:restaurante.php");
				}
			}
if (isset($_POST['buton_anuleaza']))
	{
		if ($pgid == 'm')
			header("location:manastiri.php");
		if ($pgid == 'mz')
			header("location:muzee.php");
		if ($pgid == 'rz')
			header("location:rezervatii.php");
		if ($pgid == 'p')
			header("location:pensiuni.php");
		if ($pgid == 'r')
			header("location:restaurante.php");
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
<div id="logo"><a href="#">Obiectivele turistice din Bucovina</a>
</div>
<div id="content_bg">
  <div id="content">
    <div id="left" style="height:auto;">
			<center><h5>Inregistrare</h5></center>
		<center><div id="text">
				<?php
					if (isset($_POST["buton_trimite"]))
						{
							$utilizator = $_POST["utilizator"];
							$parola = $_POST["parola"];
							$nume = $_POST["nume"];
							$prenume = $_POST["prenume"];
							$telefon = $_POST["telefon"];
							$mail = $_POST["mail"];
							$localitate = $_POST["localitate"];
							InterogareSQL("insert into t_datepersonale(nume,prenume,telefon,localitate,email) values('$nume','$prenume',$telefon,'$localitate','$mail');",$rez1);
							printf("Date personale adaugate cu succes!<br>");
							if (($nr2 = InterogareSQL("select iddatepersonale from t_datepersonale where nume='".$nume."' and prenume='".$prenume."';",$rez2)) != 0)
								{
									$linie2 = CitesteLinie($rez2,0);
									$cod = $linie2[0];
									InterogareSQL("insert into t_utilizatori(nume_utilizator,parola_utilizator,categorie,iddatepersonale) values('$utilizator','$parola','user',$cod);",$rez3);
									printf("Utilizator inregistrat!<br><a href=\"login.php?pgid=i\">Conecteaza-te</a>");
								}
						}
					else
						{
				?>
		<form id="form1" method="post" target="inregistrare.php">
					<table>
					<tr><td><font face='Quintessential' size='4'><b>Utilizator:</b></font></td>
					<td><input type="text" name="utilizator"  style="height:24px;font-family:'Quintessential';font-size:20px;" value="" /></td></tr>
					<tr><td><font face='Quintessential' size='4'><b>Parola:</b></font></td>
					<td><input type="password" name="parola" style="height:24px;font-family:'Quintessential';font-size:20px;" value="" /></td></tr>
					<tr><td><font face='Quintessential' size='4'><b>Confirmare parola:</b></font></td>
					<td><input type="password" name="parola2" style="height:24px;font-family:'Quintessential';font-size:20px;" value="" /></td></tr>
					<tr><td><font face='Quintessential' size='4'><b>Nume:</b></font></td>
					<td><input type="text" name="nume" style="height:24px;font-family:'Quintessential';font-size:20px;" value="" /></td></tr>
					<tr><td><font face='Quintessential' size='4'><b>Prenume:</b></font></td>
					<td><input type="text" name="prenume" style="height:24px;font-family:'Quintessential';font-size:20px;" value="" /></td></tr>
					<tr><td><font face='Quintessential' size='4'><b>Telefon:</b></font></td>
					<td><input type="text" name="telefon" style="height:24px;font-family:'Quintessential';font-size:20px;" value="" /></td></tr>
					<tr><td><font face='Quintessential' size='4'><b>Localitate:</b></font></td>
					<td><input type="text" name="localitate" style="height:24px;font-family:'Quintessential';font-size:20px;" value="" /></td></tr>
					<tr><td><font face='Quintessential' size='4'><b>E-mail:</b></font></td>
					<td><input type="text" name="mail" style="height:24px;font-family:'Quintessential';font-size:20px;" value="" /></td></tr>
					<tr><td></td><td><input style="width:220px;height:30px;" type="submit" name="buton_trimite" value="Inregistreaza" onclick="this.form.target='_self';return true;"/></td></tr>
					<tr><td></td><td><input style="width:220px;height:30px;" type="submit" name="buton_anuleaza" value="Anuleaza" onclick="this.form.target='_self';return true;"/></td></tr>
					</table>
		</form>
					<?php
						}
					?>
           </div></center>

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