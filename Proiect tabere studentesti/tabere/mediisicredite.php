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
<form name='formmedii' method='get'>
<table border='1'>
<tr>
<td>
<table border='0'>
<?
$idstudent = $_GET["ids"];
printf("<tr><td colspan='2'><h1>Situatia mediilor</h1></td></tr>");
if (($nr1 = InterogareSQL("select avg(nota),an from gc_note where idstudent=".$idstudent." group by an order by an;",$rez1)) != 0)
	{
			printf("<tr><td><h1>Anul</h1></td><td><h1>Media</h1></td></tr>");
			for($i=0;$i<$nr1;$i++)
			{
				$linie1 = CitesteLinie($rez1,$i);
				printf("<tr><td><h2>%s</h2></td><td><h2><font color='red'>%.2f</font></h2></td></tr>",$linie1[1],$linie1[0]);
			}
	}
else
	{
		printf("<h1>Situatia mediilor acestui student nu a fost actualizata in aceasta aplicatie!</h1>");
	}
printf("</table>");
printf("</td><td>");
printf("<table border='0'>");
printf("<tr><td colspan='2'><h1>Situatia creditelor</h1></td></tr>");
if (($nr2 = InterogareSQL("select nr,an from gc_credite where idstudent=".$idstudent." order by an;",$rez2)) != 0)
	{
			printf("<tr><td><h1>Anul</h1></td><td><h1>Nr credite</h1></td></tr>");
			for($i=0;$i<$nr2;$i++)
			{
				$linie2 = CitesteLinie($rez2,$i);
				printf("<tr><td><h2>%s</h2></td><td><h2><font color='red'>%s</font></h2></td></tr>",$linie2[1],$linie2[0]);
			}
	}
else
	{
		printf("<h1>Situatia creditelor acestui student nu a fost actualizata in aceasta aplicatie!</h1>");
	}
?>
</table>
</td>
</tr>
</table>
</form>
<img src='images/note.jpg' width='250' height='200' align='right'>
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
