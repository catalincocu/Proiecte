<?require('interog.inc'); 
session_start(); 
$incercare=0;
if (isset($_POST['buton_login']))
			{
				$incercare=1;
				if (($nr2 = InterogareSQL("select * from gc_profesori where nume='".$_POST["user"]."' and parola='".$_POST["parola"]."';",$rez2)) != 0)
				{
					$linie2 = CitesteLinie($rez2,0);
					$id_sesiune = session_id();
					$_SESSION["profesor"] = $_POST['user'];
				}
			}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Tabere de odihna - 2013</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="main">
<div class="tophead">
  <h1>Tabere de odihna<? if (isset($_SESSION["profesor"])) {?> <a href="logout.php"><img src='images/logout.gif' width='120' height='30' align='right'></a><? } ?></h1>
</div>
<div class="header"><div id="tabsB">
  <ul>
    <li><a href="index.php" title="Home"><span>Home</span></a></li>
	<li><a href="tabere.php" title="Tabere"><span>Tabere </span></a></li>
    <li><a href="studenti.php" title="Studenti"><span>Studenti </span></a></li>
    <li><a href="facultati.php" title="Clasament"><span>Clasament</span></a></li>
	<li><a href="cereri.php?c=1" title="Cereri"><span>Cereri</span></a></li>
  </ul>
</div></div>
<div class="contents">
<div class="left">
<?
if (isset($_SESSION["profesor"]))
{
?>
<form name="cereri" method="get">
<table>
	<?
			if (isset($_GET["c"]))
			{
				?>
				<tr>
				<td></td>
				<td colspan='3'><h2><a href='cereri.php?c=1'><font color="orange">Cereri confirmate</font></a></h2></td>
				<td colspan='3'><h2><a href='cereri.php?a=2'>Cereri in asteptare</a></h2></td>
				</tr>
				<?
				if (($nr1 = InterogareSQL("select a.idstudent,a.nume,a.prenume,b.denumirefacultate,c.denumirespecializare,d.numetabara,e.idcerere,e.datacererii from gc_studenti a,gc_facultati b,gc_specializari c,gc_tabere d,gc_cereri e where a.idstudent=e.idstudent and a.idfacultate=b.idfacultate and a.idspecializare=c.idspecializare and e.idtabara=d.idtabara and e.idcerere in (select idcerere from gc_cerericonfirmate);",$rez1)) != 0)
					{
						for($i=0;$i<$nr1;$i++)
							{
								$linie1 = CitesteLinie($rez1,$i);
								printf("<tr>");
								//printf("<td><a href='situatie.php?stud=%s&idc=%s'><img src='images/details.png' width='25' height='25'></a></td>",$linie1[0],$linie1[6]);
								printf("<td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td>",$linie1[1],$linie1[2],$linie1[3],$linie1[4],$linie1[5],$linie1[7]);
								printf("</tr>");
							}
						printf("<tr><td colspan='4'></td><td colspan='2'><img src='images/confirmate.png' width='250' height='200' align='right'></td></tr>");
					}
				else
					printf("<tr><td colspan='6'>Nu exista cereri confirmate</td></tr>");
			}
		if (isset($_GET["a"]))
			{
				?>
				<tr>
				<td></td>
				<td colspan='3'><h2><a href='cereri.php?c=1'>Cereri confirmate</a></h2></td>
				<td colspan='3'><h2><a href='cereri.php?a=2'><font color="orange">Cereri in asteptare</font></a></h2></td>
				</tr>
				<?
				if (($nr1 = InterogareSQL("select a.idstudent,a.nume,a.prenume,b.denumirefacultate,c.denumirespecializare,d.numetabara,e.idcerere,e.datacererii from gc_studenti a,gc_facultati b,gc_specializari c,gc_tabere d,gc_cereri e where a.idstudent=e.idstudent and a.idfacultate=b.idfacultate and a.idspecializare=c.idspecializare and e.idtabara=d.idtabara and e.idcerere not in (select idcerere from gc_cerericonfirmate);",$rez1)) != 0)
					{
						for($i=0;$i<$nr1;$i++)
							{
								$linie1 = CitesteLinie($rez1,$i);
								printf("<tr>");
								printf("<td><a href='situatie.php?stud=%s&idc=%s'><img src='images/details.png' width='25' height='25'></a></td>",$linie1[0],$linie1[6]);
								printf("<td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td>",$linie1[1],$linie1[2],$linie1[3],$linie1[4],$linie1[5],$linie1[7]);
								printf("</tr>");
							}
						printf("<tr><td colspan='4'></td><td colspan='2'><img src='images/asteptare.jpg' width='250' height='200' align='right'></td></tr>");
					}
				else
					printf("<tr><td colspan='6'>Nu exista cereri in asteptare</td></tr>");
			}
	?>
</table>
</form>
<?
}
else
	{
		?>
		<center>
		<h1>Trebuie sa fii autentificat ca profesor pentru a avea acces in aceasta sectiune!</h1>
		<form id="formlogin" method="post" target="cereri.php">
		<font size="3">
		<table width="300" height="200">
			<tr><td></td><td><font size="4">Conectare profesor</font></td></tr>
			<tr><td><label>Utilizator:</label></td>
				<td><input type="text" name="user" value=""></td></tr>
			<tr><td><label>Parola:</label></td>
				<td><input type="password" name="parola" value=""></td></tr>
			<tr><td><input type="submit" name="buton_login" value="Conectare" class="order_button" onclick="this.form.target='_self';return true;"/></td></tr>
		</table>
			<?php
				if ($incercare==1)
					echo "Date incorecte!";
			?>
		</font>
		</form>
		</center>
		<img src='images/lock.jpg' width='200' height='200' align='right'>
		<?
	}
?>
</div>
<div class="spacer">&nbsp;</div>
</div>
<div class="footer">
<div class="footertexts">&copy; Tabere de odihna 2013<br />
</div>
</div>

</div>
</body>
</html>
