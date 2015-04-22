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
<div id="notesiabs">
<?php
if( ($nr4=InterogareSQL("select cod from tb_utilizatori where nick='".$_SESSION["user"]."';" ,$mat4))==0) echo "";
else
	{
		$linie4 = CitesteLinie($mat4,0);
		$id4=$linie4[0];
		if( ($nr5=InterogareSQL("select distinct a.id_clasa,a.nume_elev,a.prenume_elev from tb_elevi a,tb_prof_disc_clasa b where a.id_clasa=b.cod_clasa and b.cod_profesor=".$id4.";",$mat5))==0) echo "bbb";
		else
		{
			$f=fopen("note.txt","wt"); 
				if($f) { 
							for($j=0;$j<$nr5;$j++)
								{
									$linie5 = CitesteLinie($mat5,$j);
									fputs($f,"$linie5[1] $linie5[2]\n"); 
								}
						}
			fclose($f); 
		}
	}
?>
<form name="sit_note" method="POST" target="note_elevi.php"> 
<table border="0" align="center">
    <tr>
        <td>Elev</td>
    </tr>
    <tr>
        <td><input type="text" name="ac_example" class="text" id="nume_prenume"/></td>
        <td><input type="submit" class="buton_1" name="vizualiz" value="Vizualizeaza" onclick="this.form.target='_self';return true;"/></td>
    </tr>
	<tr>
		<td><td><td><td><td><div id="poza"><img src="sigla.jpg"></div></td>
	</tr>
</table>
</form>
	<?php
			if (isset($_POST['sterge']))
				if (isset($_POST['radiobuton']))
				{
					$codul=$_POST['radiobuton'];
					InterogareSQL("DELETE FROM tb_situatie_note WHERE id_nota=".$codul.";",$rez);
					printf("<center>Nota stearsa!</center>");
				}
				else
					printf("<center>Nu ai selectat nicio nota!</center>");
			if (isset($_POST['add']))
						{
							$disc=$_POST['id_disciplinei'];
							$el=$_POST['id_elevului'];
							$zi=$_POST['zi'];
							$luna=$_POST['luna'];
							$an=$_POST['an'];
							$data_nota=$an . "-" . $luna . "-" . $zi;
							$nota=$_POST['nota'];
							$semestru=$_POST['semestru'];
							InterogareSQL("INSERT INTO tb_situatie_note(cod_elev,cod_disciplina,nota,data_nota,semestru) VALUES($el,$disc,$nota,'$data_nota',$semestru);",$rez);
							printf("<center>Nota $nota/$data_nota adaugata cu succes!</center>");
						}
			if (isset($_POST['adauga']))
				{
					?>
						<form method="POST" target="note_elevi.php">
						<center>
						<table>
						<tr><td></td><td>Adaugare nota</td><td></td></tr>
						<tr>
							<td>Nota:</td>
							<td>
							<select name='nota' class="text">
								<?php
								for ($numar=1;$numar<=10;$numar++)
									echo "<option value=$numar>$numar</option>\n";
								?>
								</select>
							</td>
							<td>Data:</td>
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
									for ($numar=2011;$numar<=2012;$numar++)
										echo "<option value=$numar>$numar</option>\n";
								?>
							</select></td>
							<td>Semestru:</td>
							<td>
							<select name='semestru' class="text">
								<?php
								for ($numar=1;$numar<=2;$numar++)
									echo "<option value=$numar>$numar</option>\n";
								?>
								</select>
							</td>
						<td><input type="submit" name="add" class="buton_1" value="Ok" onclick="this.form.target='_self';return true;"></td>
						</tr>
						<?php
						$id_elevului=$_POST["idel"];
						$id_disciplinei=$_POST["idd"];
						printf("<input type=\"hidden\" name=\"id_elevului\" value=\"$id_elevului\">");
						printf("<input type=\"hidden\" name=\"id_disciplinei\" value=\"$id_disciplinei\">");
						?>
						</table>
						</center>
						</form>
					<?php
				}?>
	<?php
if (isset($_POST['vizualiz']))
		{
			$nume_complet = $_POST['ac_example'];
			if ($nume_complet == "")
				echo "<center>Nu ai selectat niciun elev<center>";
			else
			{
			$pieces = explode(" ", $nume_complet);
			$nume = $pieces[0];
			$prenume = $pieces[1];
			if ( ($nr8=InterogareSQL("select id_elev,id_clasa from tb_elevi where nume_elev='".$nume."' and prenume_elev='".$prenume."';" ,$mat8))==0) echo "Eroare 111";
			else
				{
					$linie8 = CitesteLinie($mat8,0);
					$idelev = $linie8[0];
					$idclasa = $linie8[1];
				}
				if ( ($nr9=InterogareSQL("select a.cod_disciplina,b.nume_disciplina from tb_prof_disc_clasa a,tb_discipline b where a.cod_clasa=".$idclasa." and a.cod_profesor=".$id4." and a.cod_disciplina=b.cod_disciplina;" ,$mat9))==0) echo "Eroare 12";
				else
				{
					$nrdisc=0;
					for($j=0;$j<$nr9;$j++)
								{
									$linie9 = CitesteLinie($mat9,$j);
									$iddiscipline[$nrdisc] = $linie9[0];
									$numediscipline[$nrdisc] =$linie9[1];
									$nrdisc++;
								}
					for ($j=0;$j<$nrdisc;$j++)
						{
							$valid=1;
			if( ($nr17=InterogareSQL("select a.nota,a.data_nota,a.id_nota,a.semestru from tb_situatie_note a,tb_discipline b where a.cod_disciplina=b.cod_disciplina and a.cod_disciplina=".$iddiscipline[$j]." and a.cod_elev=".$idelev.";" ,$mat17))==0) 
				{
					echo "<center>Nu exista note la disciplina $numediscipline[$j]!</center>";
					$valid=0;
				}
			?>
			<form method="POST" target="note_elevi.php">
			<center>
			<table>
				<?php if ($valid!=0) printf("<tr><td>Situatia la $numediscipline[$j]</td></tr>"); ?>
				<tr>
					<td>
						<table border="0" align="center">
						<?php
								if ($valid!=0)
									printf("<tr><td>Nr</td><td>Nota</td><td>Data</td><td>Semestru</td></tr>");
								for($z=0;$z<$nr17;$z++)
									{
										printf("<tr>");
										$linie17 = CitesteLinie($mat17,$z);
										printf("<td>%s</td><td>%s</td><td>%s</td><td>%s</td>",$z+1,$linie17[0],$linie17[1],$linie17[3]);
										?>
										<td>
											<?php printf("<input type=\"radio\" name=\"radiobuton\" value=\"$linie17[2]\">"); ?>
										</td>
										<td></td>
										<?php
										printf("</tr>");
									}
										printf("<tr>");
										printf("<input type=\"hidden\" name=\"idel\" value=\"$idelev\">");
										printf("<input type=\"hidden\" name=\"idd\" value=\"$iddiscipline[$j]\">");
										printf("</tr>");
						?>
						</table>
					</td>
				</tr>
			</table>
						<?php if ($valid!=0) {?>
						<input type="submit" name="sterge" class="buton_1" value="Sterge" onclick="this.form.target='_self';return true;">
						<?php	} ?>
						<input type="submit" name="adauga" class="buton_1" value="Adauga" onclick="this.form.target='_self';return true;">
			</center>
			</form>
			<br><br><br>
			<?php
						}
				}
			}
		}
?>
</div>
<script language="javascript" type="text/javascript">
<!--
	
var xhr = new XMLHttpRequest();

xhr.open('GET', 'note.txt', false);
xhr.send(null);
var data = xhr.responseText.split('\n');

    AutoComplete_Create('nume_prenume', data);
// -->
</script>
</div>
<div id="footer">
	<p>&copy; 2012. Cocu Catalin</p>
</div>
</body>
</html>