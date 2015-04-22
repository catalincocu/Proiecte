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
	var formular=document.adelev;
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
	if (formular.telefon.value == "")
			{
				alert("Introduceti o valoare pentru campul telefon!");
			    return false;
			}
	if (formular.localitate.value == "")
			{
				alert("Nu ati completat campul localitate!");
			    return false;
			}
	if (formular.strada.value == "")
			{
				alert("Nu ati completat campul strada!");
			    return false;
			}
	if (formular.nr.value == "")
			{
				alert("Introduceti o valoare pentru nr!");
			    return false;
			}
	if (isNaN(formular.nr.value))
			{
				alert("Introduceti o valoare numerica pentru nr!");
			    return false;
			}
	if (formular.ap.value == "")
			{
				alert("Introduceti o valoare pentru ap!");
			    return false;
			}
	if (isNaN(formular.ap.value))
			{
				alert("Introduceti o valoare numerica pentru ap!");
			    return false;
			}
	if (formular.disciplina.value == "")
			{
				alert("Introduceti o valoare pentru disciplina!");
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
					<?php
					}
				if ($_SESSION["privilegiu"]=="profesor")
					{
					?>
					<li><a href="elevi.php">Elevi</a></li>
					<li><a href="datep.php">Informatii personale</a></li>
					<?php
					}
				if ($_SESSION["privilegiu"]=="parinte")
					{
					?>
					<li><a href="colegi.php">Situatie scolara</a></li>
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
<form name="adelev" method="POST" target="administrator_ad_stud.php">
<table align="center">
<tr><td></td><td align="center">Date personale</td></tr>
<tr>
<td>Nume:</td><td><input type="text" name="numele" class="text" /></td><td><h3>* obligatoriu</h3></td>
</tr>
<tr>
<td>Prenume:</td><td><input type="text" name="prenumele" class="text" /></td><td><h3>* obligatoriu</h3></td>
</tr>
<tr>
<td>CNP:</td><td><input type="text" name="cnp" class="text" /></td><td><h3>* obligatoriu</h3></td>
</tr>
<tr>
<td>Data nasterii:</td>
<td>
<select name='zi' class="text">
<?php
	for ($numar=1;$numar<=31;$numar++)
		echo "<option value=$numar>$numar</option>\n";
?>
</select>
<select name='luna' class="text">
<?php
	for ($numar=1;$numar<=12;$numar++)
		echo "<option value=$numar>$numar</option>\n";
?>
</select>
<select name='an' class="text">
<?php
	for ($numar=1950;$numar<=1986;$numar++)
		echo "<option value=$numar>$numar</option>\n";
?>
</select></td>
<td><h3>* obligatoriu</h3></td>
</tr>
<tr><td></td><td align="center">Adresa</td></tr>
<tr>
<td>Telefon:</td><td><input type="text" name="telefon" class="text" /></td><td><h3>* obligatoriu</h3></td>
</tr>
<tr>
<td>Localitate:</td><td><input type="text" name="localitate" class="text" /></td><td><h3>* obligatoriu</h3></td>
</tr>
<tr>
<td>Strada:</td><td><input type="text" name="strada" class="text" /></td><td><h3>* obligatoriu</h3></td>
</tr>
<tr>
<td>Nr:</td><td><input type="text" name="nr" class="text" /></td><td><h3>* obligatoriu</h3></td>
</tr>
<tr>
<td>Ap:</td><td><input type="text" name="ap" class="text" /></td><td><h3>* obligatoriu</h3></td>
</tr>
<tr>
<td></td>
</tr>
</table>
<table align="center">
<td><input type="submit" name="inregistreaza" class="buton_1" value="Inregistreaza" onClick="return valideaza();this.form.target='_self';return true;"></td>
<td><input type="submit" name="anuleaza" class="buton_1" value="Anuleaza"></td>
</table>
<?php
	if (isset($_POST['inregistreaza']))
		{
			$nume=$_POST['numele'];
			$prenume=$_POST['prenumele'];
			$cnp=$_POST['cnp'];
			$zi=$_POST['zi'];
			$luna=$_POST['luna'];
			$an=$_POST['an'];
			$data_nastere=$an . "-" . $luna . "-" . $zi;
			$telefon=$_POST['telefon'];
			$localitate=$_POST['localitate'];
			$strada=$_POST['strada'];
			$nr=$_POST['nr'];
			$ap=$_POST['ap'];
					InterogareSQL("INSERT INTO tb_profesori(nume_profesor,prenume_profesor,data_nastere,cnp,salariu,telefon) values ('".$nume."','".$prenume."','".$data_nastere."','".$cnp."',0,'".$telefon."');",$rez14);
					if (($nr11 = InterogareSQL("select cod_profesor from tb_profesori where nume_profesor='".$nume."' and prenume_profesor='".$prenume."';",$rez11)) == 0)
						echo "Eroare 1";
					else
						{
							$linie11 = CitesteLinie($rez11,0);
							$idelev = $linie11['cod_profesor'];
							InterogareSQL("INSERT INTO adrese_tb_profesori(cod_profesor,localitate,strada,nrcasa,ap) values ($idelev,'".$localitate."','".$strada."',$nr,$ap);",$rez14);
								echo "Profesorul a fost introdus cu succes in baza de date!<br>";
						}
		}
	if (isset($_POST['anuleaza']))
		{
			header("location:index.php");
		}
?>
</form>
</div>
<div id="footer">
	<p>&copy; 2012. Cocu Catalin</p>
</div>
</body>
</html>
