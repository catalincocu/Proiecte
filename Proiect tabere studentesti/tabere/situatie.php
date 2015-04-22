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
<form name="situatie" method="get">
<?
if (isset($_GET["stud"]))
	{
	$idcerere = $_GET["idc"];
	$idstudent = $_GET["stud"];
	if (($nr1 = InterogareSQL("select a.nume,a.prenume,b.denumirefacultate,c.denumirespecializare,d.numeactivitate,d.punctaj,d.locatie,e.nume,e.prenume,d.idactivitate from gc_studenti a,gc_facultati b,gc_specializari c,gc_activitati d,gc_profesori e where a.idfacultate=b.idfacultate and a.idspecializare=c.idspecializare and d.idprofesor=e.idprofesor and a.idstudent=".$idstudent." and d.idcerere=".$idcerere.";",$rez1)) != 0)
		{
			$linie1 = CitesteLinie($rez1,0);
?>
<table border='0'>
<tr>
	<td colspan='6'>
	<center><h1>Situatia scolara</h1></center>
	</td>
</tr>
<tr>
    <td rowspan='5'>
         <table>
               <tr>
                   <td><h2><? printf("%s",$linie1[0]);?> <? printf("%s",$linie1[1]);?></h2></td>
               </tr>
               <tr>
                   <td colspan='2'><h3><? printf("%s",$linie1[2]);?></h3></td>
               </tr>
               <tr>
                   <td colspan='2'><h3><? printf("Specializarea %s",$linie1[3]);?></h3></td>
               </tr>
         </table>
    </td>
</tr>
<tr>
    <td>
         <b>Nume activitate</b>
    </td>
    <td>
         <b>Punctaj</b>
    </td>
    <td>
         <b>Profesor</b>
    </td>
    <td>
         <b>Locatie</b>
    </td>
    <td>
         <b>Punctaj comisie</b>
    </td>
</tr>
	<?
		for($i=0;$i<$nr1;$i++)
			{
				$linie2 = CitesteLinie($rez1,$i);
	?>
<tr>
    <td>
         <? printf("%s",$linie2[4]);?>
    </td>
    <td>
         <? printf("%s",$linie2[5]);?>
    </td>
    <td>
         <? printf("%s %s",$linie2[7],$linie2[8]);?>
    </td>
    <td>
         <? printf("%s",$linie2[6]);?>
    </td>
    <td>
         <? 
			printf("<input type='text' name='punctajacordat%s' value='0' style=\"width:50px\">",$i+1);
			printf("<input type='hidden' name='idactivitate%s' value='%s' style=\"width:50px\">",$i+1,$linie2[9]);
		 ?>
    </td>
</tr>
	<?
			}
		if (($nr4 = InterogareSQL("select avg(nota) from gc_note where idstudent=".$idstudent.";",$rez4)) != 0)
			{
			printf("<tr><td><h1>Media</h1></td>");
			$linie4 = CitesteLinie($rez4,0);
			printf("<td colspan='4'><h2>%.2f</h2></td></tr>",$linie4[0]);
			}
		for($j=$i;$i<3;$i++)
			{
	?>
<tr><td colspan='5'></td></tr>
	<?
			}
	?>
<tr>
<? 
	printf("<input type='hidden' name='idstud' value='%s'>",$idstudent);
    printf("<input type='hidden' name='idc' value='%s'>",$idcerere);
?>
	<td colspan='6'>
	<center><input type="submit" name="butonconfirma" value="Confirma" title="Confirma"></center>
	</td>
</tr>
</table>
<?
		}
		else
			{
				printf("<form name='formfaraactivitate' method='get'>");
				printf("<center><img src='images/sorry.png' width='40' height='40'><font size='3'>Acest student nu a inregistrat nicio activitate!</font></center>");
				printf("<input type='hidden' name='idc' value='%s'>",$idcerere);
				printf("<br><center><input type='submit' name='butonfaraactivitate' value='Confirma cererea' title='Confirma'></center>");
				printf("</form>");
			}
?>
</form>
<?
}
else
{
if (isset($_GET["butonconfirma"]))
	{
		$ok=1;
		if (isset($_GET["punctajacordat1"]))
			{
				$pct1 = $_GET["punctajacordat1"];
				$ida1 = $_GET["idactivitate1"];
				if ($pct1 == "0")
					$ok=0;
			}
		if (isset($_GET["punctajacordat2"]) and $ok!=0)
			{
				$pct2 = $_GET["punctajacordat2"];
				$ida2 = $_GET["idactivitate2"];
				if ($pct2 == "0")
					$ok=0;
			}
		if (isset($_GET["punctajacordat3"]) and $ok!=0)
			{
				$pct3 = $_GET["punctajacordat3"];
				$ida3 = $_GET["idactivitate3"];
				if ($pct3 == "0")
					$ok=0;
			}
		if ($ok == 0)
			printf("Nu ai acordat punctaj pentru toate activitatile!");
		else
			{
				$stud = $_GET["idstud"];
				$idc = $_GET["idc"];
				InterogareSQL("update gc_activitati set punctajcomisie=".$pct1." where idstudent=".$stud." and idcerere=".$idc." and idactivitate=".$ida1.";",$rez4);
				if (isset($pct2))
					InterogareSQL("update gc_activitati set punctajcomisie=".$pct2." where idstudent=".$stud." and idcerere=".$idc." and idactivitate=".$ida2.";",$rez4);
				if (isset($pct3))
					InterogareSQL("update gc_activitati set punctajcomisie=".$pct3." where idstudent=".$stud." and idcerere=".$idc." and idactivitate=".$ida3.";",$rez4);
				InterogareSQL("insert into gc_cerericonfirmate(idcerere) values(".$idc.");",$rez5);
				printf("Cererea a fost aprobata cu succes!");
			}
	}
if (isset($_GET["butonfaraactivitate"]))
	{
		$idc = $_GET["idc"];
		InterogareSQL("insert into gc_cerericonfirmate(idcerere) values(".$idc.");",$rez5);
		printf("Cererea a fost aprobata cu succes!");
	}
}
?>
<img src='images/situatie.jpg' width='200' height='200' align='right'>
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