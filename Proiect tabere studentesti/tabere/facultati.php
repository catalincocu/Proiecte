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
if (($nr1 = InterogareSQL("select a.idstudent,a.nume,a.prenume,b.numetabara,d.idcerere from gc_studenti a,gc_tabere b,gc_cereri d,gc_cerericonfirmate e where e.idcerere=d.idcerere and d.idstudent=a.idstudent and d.idtabara=b.idtabara;",$rez1)) != 0)
	{
		printf("<table><tr><td></td><td><h2>Nume</h2></td><td><h2>Prenume</h2></td><td><h2>Tabara</h2></td><td><h2>Punctaj</h2></td></tr>");
		for($i=0;$i<$nr1;$i++)
			{
				$linie1 = CitesteLinie($rez1,$i);
				$idstudent = $linie1[0];
				$idcerere = $linie1[4];
				InterogareSQL("select sum(punctajcomisie) from gc_activitati where idstudent=".$idstudent." and idcerere=".$idcerere.";",$rez2);
				$linie2 = CitesteLinie($rez2,0);
				$total = $linie2[0];
				if ($total == "")
					$total = "0";
				printf("<tr><td><h3>%s</h3></td><td><h3>%s</h3></td><td><h3>%s</h3></td><td><h3>%s</h3></td><td><h2><font color='red'>%s</font></h2></td></tr>",$i+1,$linie1[1],$linie1[2],$linie1[3],$total);
			}
		printf("</table>");
	}
else
	{
		printf("Nu exista cereri acceptate,deocamdata clasamentul nu se poate realiza.");
	}
?>
<img src='images/podium.jpg' width='250' height='200' align='right'>
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
