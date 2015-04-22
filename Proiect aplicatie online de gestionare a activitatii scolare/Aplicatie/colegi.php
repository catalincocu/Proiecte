<?php
require('interog.inc');
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Liceu</title>
<link rel="stylesheet" type="text/css" href="stil.css" media="screen" />
</head>
<div id="header">
		<h1>Colegiul National "Eudoxiu Hurmuzachi" Radauti</h1>
		<div id="memberlogin">
		<?php
		if ($_SESSION["ok"]!=1)
		{
		?>
		<form name="form1" method="POST" target="index.php">
			<table>
			<tr>
			<td>Utilizator:</td><td>Parola:</td>
			</tr>
			<tr>
			<td><input type="text" name="user" value="" class="text" /></td>
			<td><input type="password" name="parola" value="" class="text" /></td>
			<td><input type="submit" name="buton_login" value="Log in" class="buton_1" onclick="this.form.target='_self';return true;"></td>
			<?php
			if (isset($_POST['buton_login']))
			if (($nr = InterogareSQL("select * from tb_utilizatori where nick='".$_POST["user"]."' and parola='".$_POST["parola"]."';",$rez)) == 0)
				echo "<td>Date incorecte!</td>";
			else
				{
				$id_sesiune = session_id();
				$_SESSION["ok"] = 1;
				$_SESSION["user"] = $_POST['user'];
				$nr = InterogareSQL("select privilegiu from tb_utilizatori where nick='".$_POST["user"]."';",$rez);
				$linie = CitesteLinie($rez,0);
				$priv = $linie['privilegiu'];
				$_SESSION["privilegiu"] = $priv;
				header("location:index.php");
				}
			?>
			</tr>
			<tr><td></td><td><p><a href="inregistrare.php">Inregistreaza-te</a></p></td></tr>
			</table>
		</form>
		<?php }
		else
			{
				echo '<table class="tabeluser"><tr> </tr><tr><td>';
				echo '<input type="submit" name="buton_user" value="'.$_SESSION['user'].'" class="buton_1"></td>';
				echo '<td><a href="logout.php">Log out</a></td>';
				echo '</tr></table>';
			}
		?>
		</div>
		<div id="meniu">
		<ul>
			<li class="first"><a href="index.php">Acasa</a></li>
			<?php
			if ($_SESSION["ok"]==1)
			{
				if ($_SESSION["privilegiu"]=="elev")
					{
					?>
					<li><a href="colegi.php">Colegi</a></li>
					<li><a href="prof.php">Profesori</a></li>
					<li><a href="note.php">Situatie scolara</a></li>
					<li><a href="absente.php">Absente</a></li>
					<li><a href="datep.php">Informatii personale</a></li>
					<li><a href="mesaje.php">Mesaje</a></li>
					<?php
					}
				if ($_SESSION["privilegiu"]=="profesor")
					{
					?>
					<li><a href="note_elevi.php">Note</a></li>
					<li><a href="absente_elevi.php">Absente</a></li>
					<li><a href="datep.php">Informatii personale</a></li>
					<li><a href="mesaje.php">Mesaje</a></li>
					<?php
					}
				if ($_SESSION["privilegiu"]=="parinte")
					{
					?>
					<li><a href="prof.php">Profesori</a></li>
					<li><a href="note.php">Situatie scolara</a></li>
					<li><a href="absente.php">Absente</a></li>
					<li><a href="datep.php">Informatii personale</a></li>
					<li><a href="mesaje.php">Mesaje</a></li>
					<?php
					}
				if ($_SESSION["privilegiu"]=="admin")
					{
					?>
					<li><a href="administrator_ad_stud.php">Adaugare elevi</a></li>
					<li><a href="administrator_ad_prof.php">Adaugare profesori</a></li>
					<?php
					}
			}
			?>
		</ul>
		</div>
</div>
<body>
<div id="body">
<div id="vizualizare">
		<?php
$nume_vedere = session_id();
$nume_vedere = substr($nume_vedere,0,5);
$var = "v";
$nume_vedere = $var . "e" . $nume_vedere;
if (($nr = InterogareSQL("select vizualizare_colegi('".$_SESSION["user"]."','".$nume_vedere."');" ,$rez)) != 0)
	if(($nr1=InterogareSQL("select * from ".$nume_vedere.";" ,$mat1))==0) echo "";
	else
		{
			printf("<center>");
			printf("<table>");
			printf("<tr><td><h1>Nr</h1></td><td><h1>Nume</h1></td><td><h1>Prenume</h1></td></tr>");
				for($i=0;$i<$nr1;$i++)
					{
						$linie1 = CitesteLinie($mat1,$i);
						printf("<tr>");
						printf("<td>%s</td><td>%s</td><td>%s</td>",$i+1,$linie1[0],$linie1[1]);
						printf("</tr>");
					}
			printf("</table>");
			printf("</center>");
		}
?>
</div>
</div>
<div id="footer">
	<p>&copy; 2012. Cocu Catalin</p>
</div>
</body>
</html>