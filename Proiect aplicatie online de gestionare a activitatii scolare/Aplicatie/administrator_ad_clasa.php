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
<link rel="stylesheet" href="AutoComplete.css" media="screen" type="text/css">
<script language="javascript" type="text/javascript" src="autocomplete.js"></script>
</head>
<script language="javascript">
function valideaza()
{
	var formular=document.adclasa;
	if (formular.clasa.value == "")
		{
			alert("Campul clasa nu este completat!");
			return false;
		}
	if (formular.an.value == "")
		{
			alert("campul anului de studiu este necompletat!");
			return false;
		}
	if (formular.profil.value == "")
		{
			alert("Campul profil este necompletat!");
			return false;
		}
	if (formular.dirig_nume.value == "")
		{
			alert("Numele dirigintelui este necompletat!");
			return false;
		}
	if (formular.dirig_prenume.value == "")
		{
			alert("Preumele dirigintelui este necompletat!");
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
<form name="adclasa" method="POST" target="administrator_ad_clasa.php">
<table align="center">
<td><input type="submit" name="adauga" class="buton_1" value="Adauga" onClick="this.form.target='_self';return true;"></td>
<td><input type="submit" name="listacl" class="buton_1" value="Lista claselor" onclick="this.form.target='_self';return true;"></td>
<td><input type="submit" name="listaprof" class="buton_1" value="Lista profesorilor" onclick="this.form.target='_self';return true;"></td>
<td><input type="submit" name="desemneaza" class="buton_1" value="Desemneaza profesor" onclick="this.form.target='_self';return true;"></td>
</table>
<?php
			if (isset($_POST['adaugare']))
			{
			$clasa=$_POST['clasa'];
			if (($nr10 = InterogareSQL("select cod_clasa from tb_clase where nume_clasa='".$clasa."';",$rez10)) != 0)
				echo "Clasa introdusa exista deja!";
			else
			{
			$profil=$_POST['profil'];
			$an=$_POST['an'];
			$dirignume=$_POST['dirig_nume'];
			$dirigprenume=$_POST['dirig_prenume'];
			if ( ($nr10=InterogareSQL("select cod_profesor from tb_profesori where nume_profesor='".$dirignume."' and prenume_profesor='".$dirigprenume."';" ,$mat10))==0) 
				echo "<center>Eroare:profesorul introdus ca diriginte nu exista in baza de date!</center>";
			else
				{
					$linie10=CitesteLinie($mat10,0);
					$codprof=$linie10[0];
					if ( ($nr11=InterogareSQL("select * from tb_clase where cod_diriginte=".$codprof.";" ,$mat11))!=0) 
						echo "<center>Eroare:profesorul este deja diriginte la o alta clasa!</center>";
					else
						{
							InterogareSQL("INSERT INTO tb_clase(cod_diriginte,cod_profil,nume_clasa,an_studiu) VALUES($codprof,$profil,'$clasa',$an);",$rez12);
							echo "<center>Clasa adaugata cu succes!</center>";
						}
				}
			}
			}
	if (isset($_POST['adauga']))
		{
			?>
			<table align="center"><tr><td>
<table align="center">
<tr><td></td><td align="center">Clasa</td></tr>
<tr>
<td>Clasa:</td><td><input type="text" name="clasa" class="text" /></td>
</tr>
<tr>
<td>Profil:</td>
<td>
<select name='profil' class="text">
	<option value="1">Matematica informatica</option>
	<option value="2">Stiinte ale naturii</option>
	<option value="3">Stiinte sociale</option>
	<option value="4">Filologie</option>
	<option value="5">Matematica-Fizica</option>
</select>
</td>
</tr>
<tr>
<td>An studiu:</td>
<td>
<select name='an' class="text">
	<option value="9">9</option>
	<option value="10">10</option>
	<option value="11">11</option>
	<option value="12">12</option>
</select>
</td>
</tr>
<tr>
<td>Numele dirigintelui:</td><td><input type="text" name="dirig_nume" class="text" /></td>
</tr>
<tr>
<td>Prenumele dirigintelui:</td><td><input type="text" name="dirig_prenume" class="text" /></td>
</tr>
<tr>
<td><td><input type="submit" name="adaugare" class="buton_1" value="Adauga" onclick="this.form.target='_self';return true;"/></td></td>
</tr>
</table>
</td>
</tr>
</table>
</form>
			<?php
			}
	if (isset($_POST['Aplica']))
	{
		$prof = $_POST['profesor'];
		$disciplina = $_POST['disc'];
		$clasa = $_POST['cl'];
		$pieces = explode(" ", $prof);
		$nume = $pieces[0];
		$prenume = $pieces[1];
		if (($nr10 = InterogareSQL("select cod_disciplina from tb_discipline where nume_disciplina='".$disciplina."';",$rez10)) == 0) echo "Err";
		else
			{
				$linie10 = CitesteLinie($rez10,0);
				$iddisc=$linie10[0];
				if (($nr12 = InterogareSQL("select cod_clasa from tb_clase where nume_clasa='".$clasa."';",$rez12)) == 0) echo "Err";
				else
				{
					$linie12 = CitesteLinie($rez12,0);
					$idcl=$linie12[0];
					if (($nr11 = InterogareSQL("select * from tb_prof_disc_clasa where cod_disciplina=".$iddisc." and cod_clasa=".$idcl.";",$rez11)) != 0) echo "<center>Eroare:Disciplina aleasa este predata deja de un alt profesor la clasa aleasa!</center>";
					else
						{
							if (($nr13 = InterogareSQL("select cod_profesor from tb_profesori where nume_profesor='".$nume."' and prenume_profesor='".$prenume."';",$rez13)) == 0) echo "Err";
							else
								{
									$linie13 = CitesteLinie($rez13,0);
									$idprof=$linie13[0];
									InterogareSQL("insert into tb_prof_disc_clasa(cod_disciplina,cod_profesor,cod_clasa) values($iddisc,$idprof,$idcl);",$rez14);
									printf("<center>Cadrul didactic $prof va preda materia $disciplina la clasa $clasa</center>");
								}
						}
				}
			}
	}
	if (isset($_POST['desemneaza']))
	{
	if( ($nr5=InterogareSQL("select nume_profesor,prenume_profesor from tb_profesori;",$mat5))==0) echo "Err";
		else
		{
			$f=fopen("profesori.txt","wt"); 
				if($f) { 
							for($j=0;$j<$nr5;$j++)
								{
									$linie5 = CitesteLinie($mat5,$j);
									fputs($f,"$linie5[0] $linie5[1]\n"); 
								}
						}
			fclose($f); 
		}
	if( ($nr5=InterogareSQL("select nume_disciplina from tb_discipline;",$mat5))==0) echo "Err";
		else
		{
			$f=fopen("discipline.txt","wt"); 
				if($f) { 
							for($j=0;$j<$nr5;$j++)
								{
									$linie5 = CitesteLinie($mat5,$j);
									fputs($f,"$linie5[0]\n"); 
								}
						}
			fclose($f); 
		}
	if( ($nr5=InterogareSQL("select nume_clasa from tb_clase;",$mat5))==0) echo "Err";
		else
		{
			$f=fopen("clase.txt","wt"); 
				if($f) { 
							for($j=0;$j<$nr5;$j++)
								{
									$linie5 = CitesteLinie($mat5,$j);
									fputs($f,"$linie5[0]\n"); 
								}
						}
			fclose($f); 
		}
	?>
	<form name="sit_note" method="POST" target="note_elevi.php"> 
	<table border="0" align="center">
    <tr>
        <tr><td>Profesor</td><td><input type="text" name="profesor" class="text" id="prof"/></td></tr>
		<tr><td>Disciplina</td><td><input type="text" name="disc" class="text" id="disciplina"/></td></tr>
		<tr><td>Clasa</td><td><input type="text" name="cl" class="text" id="clasa"/></td></tr>
        <tr><td><input type="submit" class="buton_1" name="Aplica" value="Aplica" onclick="this.form.target='_self';return true;"/></td>
    </tr>
	</table>
	</form>
	<?php
	}
	if (isset($_POST['listaprof']))
	{
	if (($nr2 = InterogareSQL("select nume_profesor,prenume_profesor from tb_profesori ;" ,$rez2)) == 0) echo "";
		else
		{
			printf("<table align=\"center\">");
			printf("<tr><td><h1>Nr</h1></td><td><h1>Nume</h1></td><td><h1>Prenume</h1></td></tr>");
				for($i=0;$i<$nr2;$i++)
					{
						$linie2 = CitesteLinie($rez2,$i);
						printf("<tr>");
						printf("<td>%s</td><td>%s</td><td>%s</td>",$i+1,$linie2[0],$linie2[1]);
						printf("</tr>");
					}
			printf("</table>");
		}
	}
	if (isset($_POST['listacl']))
	{
		if (($nr2 = InterogareSQL("select nume_clasa from tb_clase;" ,$rez2)) == 0) echo "";
		else
		{
			printf("<table align=\"center\">");
			printf("<tr><td><h1>Nr</h1></td><td><h1>Clasa</h1></td></tr>");
				for($i=0;$i<$nr2;$i++)
					{
						$linie2 = CitesteLinie($rez2,$i);
						printf("<tr>");
						printf("<td>%s</td><td>%s</td>",$i+1,$linie2[0]);
						printf("</tr>");
					}
			printf("</table>");
		}
	}
?>
<script language="javascript" type="text/javascript">
<!--
	
var xhr = new XMLHttpRequest();

xhr.open('GET', 'profesori.txt', false);
xhr.send(null);
var data = xhr.responseText.split('\n');

    AutoComplete_Create('prof', data);

var xhr = new XMLHttpRequest();

xhr.open('GET', 'discipline.txt', false);
xhr.send(null);
var data2 = xhr.responseText.split('\n');

    AutoComplete_Create('disciplina', data2);

var xhr = new XMLHttpRequest();

xhr.open('GET', 'clase.txt', false);
xhr.send(null);
var data3 = xhr.responseText.split('\n');

   AutoComplete_Create('clasa', data3);
// -->
</script>
</div>
<div id="footer">
	<p>&copy; 2012. Cocu Catalin</p>
</div>
</body>
</html>
