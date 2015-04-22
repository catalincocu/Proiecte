<?php
require('interog.inc');
session_start();
$incercare=0;
			if (isset($_POST['buton_login']))
			{
				$incercare=1;
			if (($nr = InterogareSQL("select * from tb_utilizatori where nick='".$_POST["user"]."' and parola='".$_POST["parola"]."';",$rez)) != 0)
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
			}
			if (isset($_POST['anuleaza']))
				{
					header("location:index.php");
				}
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
	var formular=document.inregistrare;
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
		if (isset($_SESSION["ok"]))
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
				if ($incercare==1)
					echo "<td>Date incorecte!</td>";
			?>
			</tr>
			<tr><td></td><td><p><a href="#">Inregistreaza-te</a></p></td></tr>
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
		</ul>
		</div>
</div>
<body>
<div id="body">
<div id="formularinregistrare">
<h1>Inregistrare</h1>
<form name="inregistrare" method="POST" action="inregistrare.php">
<h2>
<table>
<tr>
<td>Utilizator:</td><td><input type="text" name="nickal" class="text" /></td><td><h3>* obligatoriu,intre 4 si 10 caractere</h3></td>
</tr>
<tr>
<td>Parola:</td><td><input type="password" name="parolaal" class="text" /></td><td><h3>* obligatoriu,intre 6 si 12 caractere</h3></td>
</tr>
<tr>
<td>CNP:</td><td><input type="text" name="cnp" class="text" /></td><td><h3>* obligatoriu</h3></td>
</tr>
</table>
<input type="submit" name="inregistreaza" class="buton_1" value="Inregistreaza-ma" onClick="return valideaza()">
<input type="submit" name="anuleaza" class="buton_1" value="Anuleaza" onClick="this.form.target='_self';return true;">
<?php
	if (isset($_POST['inregistreaza']))
		if (($nr = InterogareSQL("select inregistrare_utilizator('".$_POST["nickal"]."','".$_POST["parolaal"]."','".$_POST["cnp"]."');",$rez)) != 0)
			{
				$linie = CitesteLinie($rez,0);
				echo '<br>';
				echo $linie['inregistrare_utilizator'];
			}
?>
</h2>
</form>
</div>
</div>
<div id="footer">
	<p>&copy; 2012. Cocu Catalin</p>
</div>
</body>
</html>