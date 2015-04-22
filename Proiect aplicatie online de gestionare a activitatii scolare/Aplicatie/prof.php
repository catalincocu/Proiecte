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
if( ($nr4=InterogareSQL("select cod,privilegiu from tb_utilizatori where nick='".$_SESSION["user"]."';" ,$mat4))==0) echo "";
else
	{
		$linie4 = CitesteLinie($mat4,0);
		$id4=$linie4[0];
		$prv=$linie4[1];
		if ($prv=="elev")
			if( ($nr5=InterogareSQL("select id_clasa from tb_elevi where id_elev=".$id4.";" ,$mat5))==0) echo "";
			else
				{
					$linie5 = CitesteLinie($mat5,0);
					$cod_clasa = $linie5[0];
				}
		if ($prv=="parinte")
			{
					$f=fopen("copil.txt","rt"); 
					if($f) 
							{			
								fscanf($f,"%s",$codelev); 
							}
					fclose($f); 
					if( ($nr7=InterogareSQL("select id_clasa from tb_elevi where id_elev=".$codelev.";" ,$mat7))==0) echo "";
					else
						{
							$linie7 = CitesteLinie($mat7,0);
							$cod_clasa = $linie7[0];
						}
			}
		if (($nr2 = InterogareSQL("select c.nume_disciplina,a.nume_profesor,a.prenume_profesor from tb_profesori a,tb_prof_disc_clasa b,tb_discipline c where a.cod_profesor=b.cod_profesor and c.cod_disciplina=b.cod_disciplina and b.cod_clasa=".$cod_clasa." order by c.nume_disciplina;" ,$rez2)) == 0) echo "";
		else
		{
			printf("<table align=\"center\">");
			printf("<tr><td><h1>Nr</h1></td><td><h1>Disciplina</h1></td><td><h1>Prenume</h1></td><td><h1>Prenume</h1></td></tr>");
				for($i=0;$i<$nr2;$i++)
					{
						$linie2 = CitesteLinie($rez2,$i);
						printf("<tr>");
						printf("<td>%s</td><td>%s</td><td>%s</td><td>%s</td>",$i+1,$linie2[0],$linie2[1],$linie2[2]);
						printf("</tr>");
					}
			printf("</table>");
		}
	}
?>
</div>
</div>
<div id="footer">
	<p>&copy; 2012. Cocu Catalin</p>
</div>
</body>
</html>