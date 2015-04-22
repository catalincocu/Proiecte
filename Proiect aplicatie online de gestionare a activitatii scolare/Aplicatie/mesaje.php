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
	var formular=document.formmesaj;
	if (formular.numele.value == "")
		{
			alert("Numele nu este completat!");
			return false;
		}
	if (formular.prenumele.value == "")
		{
			alert("Campul prenume este necompletat!");
			return false;
		}
	if (formular.mesaj.value == "")
		{
			alert("Campul mesaj este necompletat!");
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
if (($nr20 = InterogareSQL("select cod,id from tb_utilizatori where nick='".$_SESSION["user"]."';",$rez20))== 0) echo "Eroare 1";
else
	{
		$linie20=CitesteLinie($rez20,0);
		$idmembru = $linie20[0];
		$idutilizator = $linie20[1];
		printf("<center><font color=\"red\">Mesaje primite</font></center>");
		if (($nr22 = InterogareSQL("select de_la_id,de_la_func,continut,data_mesaj from tb_mesaje where catre_id='".$idutilizator."';",$rez22))== 0) echo "<center>Nu ai niciun mesaj!</center>";
		else
			{
				for ($i22=0;$i22<$nr22;$i22++)
				{
					$linie22=CitesteLinie($rez22,$i22);
					$delaid = $linie22[0];
					$delafunc = $linie22[1];
					$continut = $linie22[2];
					$data = $linie22[3];
					if ($delafunc == "elev")
						{
							if (($nr23 = InterogareSQL("select nume_elev,prenume_elev from tb_elevi where id_elev=".$delaid.";",$rez23))== 0) echo "Eroare 3";
							$linie23=CitesteLinie($rez23,0);
							$nume_exp=$linie23[0];
							$prenume_exp=$linie23[1];
						}
					if ($delafunc == "profesor")
						{
							if (($nr23 = InterogareSQL("select nume_profesor,prenume_profesor from tb_profesori where cod_profesor=".$delaid.";",$rez23))== 0) echo "Eroare 3";
							$linie23=CitesteLinie($rez23,0);
							$nume_exp=$linie23[0];
							$prenume_exp=$linie23[1];
						}
					if ($delafunc == "parinte")
						{
							if (($nr23 = InterogareSQL("select nume_parinte,prenume_parinte from tb_parinti where cod_parinte=".$delaid.";",$rez23))== 0) echo "Eroare 3";
							$linie23=CitesteLinie($rez23,0);
							$nume_exp=$linie23[0];
							$prenume_exp=$linie23[1];
						}
					printf("<br><p align=\"center\">De la ".$nume_exp." ".$prenume_exp." ai primit mesajul \"".$continut."\" la data de ".$data."</p>");
				}
			}
	}
?>
<div id="formularinregistrare">
<h1>Mesaj nou</h1>
<form name="formmesaj" method="POST" action="mesaje.php">
<h2>
<table align="center">
<tr>
<td>Nume:</td><td><input type="text" name="numele" class="text" /></td>
</tr>
<tr>
<td>Prenume:</td><td><input type="text" name="prenumele" class="text" /></td>
</tr>
<tr>
<td>Functia:</td>
<td>
<select name='fct' class="text">
<option value="elev">Elev</option>
<option value="profesor">Profesor</option>
<option value="parinte">Parinte</option>
</select>
</td>
</tr>
<tr>
<td>Mesaj:</td><td><input type="text" name="mesaj" class="textmare" /></td>
</tr>
</table>
<input type="submit" name="trimite" class="buton_1" value="Trimite" onClick="return valideaza()">
<?php
?>
</h2>
</form>
<?php
if (isset($_POST['trimite']))
{
	$nume_catre=$_POST["numele"];
	$prenume_catre=$_POST["prenumele"];
	$functia_catre=$_POST["fct"];
	$mesajul=$_POST["mesaj"];
	$functie_exp=$_SESSION["privilegiu"];
	$gasit=0;
	if (($nr26 = InterogareSQL("select cod from tb_utilizatori where nick='".$_SESSION["user"]."';",$rez26))== 0) echo "Eroare 1";
	else
		{
			$linie26=CitesteLinie($rez26,0);
			$id_de_la=$linie26[0];
		}
	if ($functia_catre=="elev")
		{
			if (($nr25 = InterogareSQL("select id_elev from tb_elevi where nume_elev='".$nume_catre."' and prenume_elev='".$prenume_catre."';",$rez25))== 0) echo "Eroare:";
			else
				{
					$gasit=1;
					$linie25=CitesteLinie($rez25,0);
					$id_catre=$linie25[0];
				}
		}
	if ($functia_catre=="profesor")
		{
			if (($nr25 = InterogareSQL("select cod_profesor from tb_profesori where nume_profesor='".$nume_catre."' and prenume_profesor='".$prenume_catre."';",$rez25))== 0) echo "Eroare:";
			else
				{
					$gasit=1;
					$linie25=CitesteLinie($rez25,0);
					$id_catre=$linie25[0];
				}
		}
	if ($functia_catre=="parinte")
		{
			if (($nr25 = InterogareSQL("select cod_parinte from tb_parinti where nume_parinte='".$nume_catre."' and prenume_parinte='".$prenume_catre."';",$rez25))== 0) echo "Eroare:";
			else
				{
					$gasit=1;
					$linie25=CitesteLinie($rez25,0);
					$id_catre=$linie25[0];
				}
		}
	$data = date('Y-m-d', time());	
	if ($gasit==0)
		echo "Persoana catre care doresti sa expediezi mesajul nu exista in baza de date!";
	else
		{
			InterogareSQL("INSERT INTO tb_mesaje(data_mesaj,de_la_id,de_la_func,catre_id,catre_func,continut) VALUES('$data',$id_de_la,'$functie_exp',$id_catre,'$functia_catre','$mesajul');",$rez28);
			echo "Mesaj expediat!";
		}
}
?>
</div>
					<div id="poza">
					<?
						if ($_SESSION["privilegiu"]=="elev")
							printf("<img src=\"elev.jpg\">");
						else
							if ($_SESSION["privilegiu"]=="profesor")
								printf("<img src=\"profesor.jpg\">");
							else
								if($_SESSION["privilegiu"]="parinte")
									printf("<img src=\"parinte.jpg\">");
					?>
					</div>
</div>
</div>
<div id="footer">
	<p>&copy; 2012. Cocu Catalin</p>
</div>
</body>
</html>
