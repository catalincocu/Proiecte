<?require('interog.inc'); 
session_start(); ?>
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
if (($nr1 = InterogareSQL("select a.nume,a.prenume,b.denumirefacultate,c.denumirespecializare,a.idstudent from gc_studenti a,gc_facultati b,gc_specializari c where a.idfacultate=b.idfacultate and a.idspecializare=c.idspecializare order by a.nume;",$rez1)) != 0)
	{
		printf("<h5>");
		printf("<table>");
		printf("<tr><td></td><td><h1>Student</h1></td><td></td><td><h1>Facultate</h1></td><td><h1>Specializare</h1></td></tr>");
		for($i=0;$i<$nr1;$i++)
			{
				$linie1 = CitesteLinie($rez1,$i);
				printf("<tr><td><a href='mediisicredite.php?ids=%s'><img src='images/infonote.png' width='35' height='35'></a></td><td><h3>%s</h3></td><td><h3>%s</h3></td><td><h3>%s</h3></td><td><h3>%s</h3></td></tr>",$linie1[4],$linie1[0],$linie1[1],$linie1[2],$linie1[3]);
			}
		printf("</table>");
		printf("</h5>");
	}
?>
<img src='images/listastudenti.jpg' width='200' height='200' align='right'>
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
