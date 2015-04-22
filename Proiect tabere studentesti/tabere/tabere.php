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
<?php
if (($nr1 = InterogareSQL("select * from gc_tabere order by numetabara;",$rez1)) != 0)
	{
		for($i=0;$i<$nr1;$i++)
			{
				$linie1 = CitesteLinie($rez1,$i);
				printf("<table><tr><td colspan='3'><h1>%s</h1></td></tr><tr><td rowspan='2'><img src='images tabere/%s' width='250' height='200'><br><a href='formular.php?idt=%s'><img src='images/inregistreaza.png' width='220' height='35'></a></td><td colspan='2'><h4> %s %s </h4></td></tr><tr><td colspan='2'><b><h3>%s</h3></b></td></tr></table>",$linie1[1],$linie1[5],$linie1[0],$linie1[2],$linie1[3],$linie1[4]);
			}
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
