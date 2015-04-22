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
<script language="javascript">
function valideaza()
{
	var formular=document.adaugare_utiliz;
	if (formular.nickal.value == "")
		{
			alert("Numele de utilizator nu este completat!");
			return false;
		}
	if (formular.nickal.value.length < 4 || formular.nickal.value.length > 10)
		{
				alert("Numele de utilizator trebuie sa fie cuprins intre 4 si 10 caractere!");
			    return false;
		}
	if (formular.parolaal.value == "")
		{
			alert("Campul parola este necompletat!");
			return false;
		}
	if (formular.parolaal.value.length < 4 || formular.parolaal.value.length > 10)
	{
				alert("Parola trebuie sa fie cuprinsa intre 6 si 12 caractere!");
			    return false;
	}
	if (formular.cnp.value == "")
		{
			alert("Campul CNP este necompletat!");
			return false;
		}
	if (isNaN(formular.cnp.value))
			{
				alert("Introduceti o valoare numerica pentru CNP!");
			    return false;
			}
	return true;
}
</script>
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
					<li><a href="administrator_ad_clasa.php">Administrare clase</a></li>
					<li><a href="utilizatori.php">Utilizatori</a></li>
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
<form method="POST" target="utilizatori.php">
<center>
		<?php
	if(($nr1=InterogareSQL("select * from tb_utilizatori;" ,$mat1))==0) echo "Nu exista utilizatori";
	else
		{
			printf("<table align=\"center\">");
			printf("<tr><td></td><td><h1>Nr</h1></td><td><h1>Nume</h1></td><td><h1>Prenume</h1></td><td><h1>Nume utilizator</h1></td><td><h1>Privilegiu</h1></td><td><h1>Data inscrierii</h1></td></tr>");
				for($i=0;$i<$nr1;$i++)
					{
						$linie1 = CitesteLinie($mat1,$i);
						printf("<tr>");
						printf("<td><input type=\"radio\" name=\"radiobuton\" value=\"$linie1[0]\"></td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td>",$i+1,$linie1[1],$linie1[2],$linie1[3],$linie1[5],$linie1[6]);
						printf("</tr>");
					}
			printf("</table>");
			?>
			<input type="submit" name="sterge" class="buton_1" value="Sterge" onclick="this.form.target='_self';return true;">
			<input type="submit" name="adauga" class="buton_1" value="Adauga" onclick="this.form.target='_self';return true;">
			<?php
			if (isset($_POST['sterge']))
				{
					if (!isset($_POST['radiobuton']))
						echo "<br>Nu ai selectat niciun utilizator";
					else
						{
							InterogareSQL("delete from tb_utilizatori where id=".$_POST["radiobuton"].";",$rez);
							echo "<br>Utilizator sters!";
						}
				}
					if (isset($_POST['inregistreaza']))
						{
							$nickales=$_POST["nickal"];
							$parolaaleasa=$_POST["parolaal"];
							$cnpales=$_POST["cnp"];
							if ($nickales=="")
								echo "<br>Numele de utilizator nu a fost introdus!";
							else
								if ($parolaaleasa=="")
									echo "<br>Parola nu a fost introdusa!";
								else
									if ($parolaaleasa=="")
										echo "<br>CNP-ul nu a fost introdus!";
									else
										if (($nr = InterogareSQL("select inregistrare_utilizator('".$_POST["nickal"]."','".$_POST["parolaal"]."','".$_POST["cnp"]."');",$rez)) != 0)
											{
												$linie = CitesteLinie($rez,0);
												echo '<br>';
												echo $linie['inregistrare_utilizator'];
											}
						}
			if (isset($_POST['adauga']))
				{
				?>
			<div id="formularinregistrare">
			<form name="adaugare_utiliz" method="POST" action="utilizatori.php">
			<h2>
			<table>
			<tr>
				<td>Utilizator:</td><td><input type="text" name="nickal" class="text" /></td>
				</tr>
				<tr>
				<td>Parola:</td><td><input type="password" name="parolaal" class="text" /></td>
				</tr>
				<tr>
				<td>CNP:</td><td><input type="text" name="cnp" class="text" /></td>
				</tr>
				</table>
				<input type="submit" name="inregistreaza" class="buton_1" value="Adauga" onclick="this.form.target='_self';return true;">
			</h2>
			</form>
			</div>
			<?php
				}
		}
?>
</center>
</form>
</div>
</div>
<div id="footer">
	<p>&copy; 2012. Cocu Catalin</p>
</div>
</body>
</html>