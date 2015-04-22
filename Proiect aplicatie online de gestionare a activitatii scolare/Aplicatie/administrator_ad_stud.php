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
	if (formular.numele_mama.value == "")
		{
			alert("Numele mamei nu este completat!");
			return false;
		}
	if (formular.prenumele_mama.value == "")
		{
			alert("Campul prenume al mamei este necompletat!");
			return false;
		}
	if (formular.cnp_mama.value == "")
		{
			alert("Campul CNP al mameieste necompletat!");
			return false;
		}
	if (isNaN(formular.cnp_mama.value))
			{
				alert("Introduceti o valoare numerica pentru CNP-ul mamei!");
			    return false;
			}
	if (formular.telefon_mama.value == "")
			{
				alert("Introduceti o valoare pentru campul telefon al mamei!");
			    return false;
			}
	if (formular.numele_tata.value == "")
		{
			alert("Numele tatalui nu este completat!");
			return false;
		}
	if (formular.prenumele_tata.value == "")
		{
			alert("Campul prenume al tatalui este necompletat!");
			return false;
		}
	if (formular.cnp_tata.value == "")
		{
			alert("Campul CNP al tatalui este necompletat!");
			return false;
		}
	if (isNaN(formular.cnp_tata.value))
			{
				alert("Introduceti o valoare numerica pentru CNP-ul tatalui!");
			    return false;
			}
	if (formular.telefon_tata.value == "")
			{
				alert("Introduceti o valoare pentru campul telefon al tatalui!");
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
					<li><a href="prof.php">tb_profesori</a></li>
					<li><a href="note.php">Situatie scolara</a></li>
					<li><a href="absente.php">Absente</a></li>
					<li><a href="datep.php">Informatii personale</a></li>
					<?php
					}
				if ($_SESSION["privilegiu"]=="profesor")
					{
					?>
					<li><a href="tb_elevi.php">tb_elevi</a></li>
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
			$clasa=$_POST['clasa'];
			$telefon=$_POST['telefon'];
			$localitate=$_POST['localitate'];
			$strada=$_POST['strada'];
			$nr=$_POST['nr'];
			$ap=$_POST['ap'];
			$clasa=$_POST['clasa'];
			$numele_mama=$_POST['numele_mama'];
			$prenumele_mama=$_POST['prenumele_mama'];
			$cnp_mama=$_POST['cnp_mama'];
			$telefon_mama=$_POST['telefon_mama'];
			$numele_tata=$_POST['numele_tata'];
			$prenumele_tata=$_POST['prenumele_tata'];
			$cnp_tata=$_POST['cnp_tata'];
			$telefon_tata=$_POST['telefon_tata'];
			if (($nr10 = InterogareSQL("select cod_clasa from tb_clase where nume_clasa='".$clasa."';",$rez10)) == 0)
				echo "Clasa introdusa nu exista!";
			else
				{
					$linie10 = CitesteLinie($rez10,0);
					$idclasa = $linie10['cod_clasa'];
					InterogareSQL("INSERT INTO tb_elevi(nume_elev,prenume_elev,cnp,id_clasa,data_nastere,telefon) values ('".$nume."','".$prenume."','".$cnp."',$idclasa,'".$data_nastere."','".$telefon."');",$rez14);
					if (($nr11 = InterogareSQL("select id_elev from tb_elevi where nume_elev='".$nume."' and prenume_elev='".$prenume."';",$rez11)) == 0)
						echo "Eroare 1";
					else
						{
							$linie11 = CitesteLinie($rez11,0);
							$idelev = $linie11['id_elev'];
							InterogareSQL("INSERT INTO adrese_tb_elevi(id_elev,localitate,strada,nrcasa,ap) values ($idelev,'".$localitate."','".$strada."',$nr,$ap);",$rez14);
								echo "Elevul a fost introdus cu succes in baza de date!<br>";
							InterogareSQL("INSERT INTO tb_parinti(nume_parinte,prenume_parinte,cnp,telefon) values ('".$numele_mama."','".$prenumele_mama."','".$cnp_mama."','".$telefon_mama."');",$rez14);
								echo "Datele mamei au fost introduse cu succces in baza de date!<br>";
							InterogareSQL("INSERT INTO tb_parinti(nume_parinte,prenume_parinte,cnp,telefon) values ('".$numele_tata."','".$prenumele_tata."','".$cnp_tata."','".$telefon_tata."');",$rez14);
								echo "Datele tatalui au fost introduse cu succces in baza de date!<br>";
							if (($nr12 = InterogareSQL("select cod_parinte from tb_parinti where nume_parinte='".$numele_tata."' and prenume_parinte='".$prenumele_tata."';",$rez12)) == 0) echo "";
							else
								{
									$linie12 = CitesteLinie($rez12,0);
									$idtata = $linie12['cod_parinte'];
								}
							if (($nr13 = InterogareSQL("select cod_parinte from tb_parinti where nume_parinte='".$numele_mama."' and prenume_parinte='".$prenumele_mama."';",$rez13)) == 0) echo "";
							else
								{
									$linie13 = CitesteLinie($rez13,0);
									$idmama = $linie12['cod_parinte'];
								}
							InterogareSQL("INSERT INTO tb_parinte_elev(id_copil,id_tata,id_mama) VALUES($idelev,$idtata,$idmama);",$rez16);
							echo "Toate datele au fost inserate cu succes!"; 
						}
				}
		}
	if (isset($_POST['anuleaza']))
		{
			header("location:index.php");
		}
?>
<form name="adelev" method="POST" target="administrator_ad_stud.php">
<table align="center"><tr><td>
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
	for ($numar=1992;$numar<=1996;$numar++)
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
<td>Clasa:</td><td><input type="text" name="clasa" class="text" /></td><td><h3>* obligatoriu</h3></td>
</tr>
</table>
</td>
<td>
<table>
<tr>
	<td></td>
	<td align="center">Parinti</td>
</tr>
<tr>
	<td></td>
	<td>Mama</td>
</tr>
<tr>
<td>Nume:</td><td><input type="text" name="numele_mama" class="text" /></td><td><h3>* obligatoriu</h3></td>
</tr>
<tr>
<td>Prenume:</td><td><input type="text" name="prenumele_mama" class="text" /></td><td><h3>* obligatoriu</h3></td>
</tr>
<tr>
<td>CNP:</td><td><input type="text" name="cnp_mama" class="text" /></td><td><h3>* obligatoriu</h3></td>
</tr>
<tr>
<td>Telefon:</td><td><input type="text" name="telefon_mama" class="text" /></td><td><h3>* obligatoriu</h3></td>
</tr>
<tr>
	<td></td>
	<td>Tata</td>
</tr>
<tr>
<td>Nume:</td><td><input type="text" name="numele_tata" class="text" /></td><td><h3>* obligatoriu</h3></td>
</tr>
<tr>
<td>Prenume:</td><td><input type="text" name="prenumele_tata" class="text" /></td><td><h3>* obligatoriu</h3></td>
</tr>
<tr>
<td>CNP:</td><td><input type="text" name="cnp_tata" class="text" /></td><td><h3>* obligatoriu</h3></td>
</tr>
<tr>
<td>Telefon:</td><td><input type="text" name="telefon_tata" class="text" /></td><td><h3>* obligatoriu</h3></td>
</tr>
</table>
</td>
</tr>
</table>
<table align="center">
<td><input type="submit" name="inregistreaza" class="buton_1" value="Inregistreaza" onClick="return valideaza()"></td>
<td><input type="submit" name="anuleaza" class="buton_1" value="Anuleaza"  onclick="this.form.target='_self';return true;"></td>
</table>
</form>
</div>
<div id="footer">
	<p>&copy; 2012. Cocu Catalin</p>
</div>
</body>
</html>
