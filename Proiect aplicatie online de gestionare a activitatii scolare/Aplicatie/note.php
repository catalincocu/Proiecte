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
<div id="noteabsprof">
<?php
if( ($nr=InterogareSQL("select cod,privilegiu from tb_utilizatori where nick='".$_SESSION["user"]."';" ,$mat))==0) echo "";
else
	{
		$linie = CitesteLinie($mat,0);
		$prv=$linie[1];
		$id=$linie[0];
		if ($prv=="parinte")
			{
				$f=fopen("copil.txt","rt"); 
					if($f) 
							{			
								fscanf($f,"%s",$id); 
							}
					fclose($f); 
			}
			printf("<table><tr>");
			$media_finala=0;
			$media_semestriala=0;
			for ($sem=1;$sem<=2;$sem++)
				if(($nr2=InterogareSQL("SELECT t1.cod_disciplina,t1.nume_disciplina,t2.nota,t2.data_nota FROM tb_discipline t1 LEFT JOIN (select cod_disciplina,nota,data_nota from tb_situatie_note where cod_elev=".$id." and semestru=".$sem.") t2 ON t1.cod_disciplina = t2.cod_disciplina order by t1.nume_disciplina;",$mat2))==0) echo "";
					else
						{	
							printf("<td>");
							printf("<h1>");
							printf("Semestrul %s",$sem);
							printf("</h1>");
							printf("<table align=\"center\">");
							printf("<td>Disciplina</td><td>Nota</td><td>Data</td>");
							$anterior = "";
							$media_obiectului=0;
							$ok=0;
							for($j=0;$j<$nr2;$j++)
								{
									
									$linie2 = CitesteLinie($mat2,$j);
									if ($linie2[1] == $anterior)
										{
											$media_obiectului=$media_obiectului+$linie2[2];
											$nr_note=$nr_note+1;
											printf("<tr>");
											printf("<td>%s</td><td>%s</td><td>%s</td>","",$linie2[2],$linie2[3]);
											printf("</tr>");
										}
									else
										{
											if ($ok!=0)
											{
													if ($media_obiectului==0)
														$mesaj = "Fara note!";
													else
														$mesaj = round($media_obiectului/$nr_note);
													printf("<tr>");
													if ($mesaj < 5)
														printf("<td><i><font color=\"red\">%s</font></i></td><td><font color=\"red\">%s</font></td><td>%s</td>","Media",$mesaj,"");
													else
														printf("<td><i><font color=\"blue\">%s</font></i></td><td><font color=\"blue\">%s</font></td><td>%s</td>","Media",$mesaj,"");
													printf("</tr>");
											}
											$ok=1;
											$media_obiectului=0;
											$nr_note=1;
											$media_obiectului=$media_obiectului+$linie2[2];
											printf("<tr>");
											printf("<td>%s</td><td>%s</td><td>%s</td>",$linie2[1],$linie2[2],$linie2[3]);
											printf("</tr>");
											$anterior = $linie2[1];
										}
								}
								if ($media_obiectului==0)
														$mesaj = "Fara note!";
													else
															$mesaj = $media_obiectului/$nr_note;
													printf("<tr>");
													if ($mesaj < 5)
														printf("<td><i><font color=\"red\">%s</font></i></td><td><font color=\"red\">%s</font></td><td>%s</td>","Media",$mesaj,"");
													else
														printf("<td><i><font color=\"blue\">%s</font></i></td><td><font color=\"blue\">%s</font></td><td>%s</td>","Media",$mesaj,"");
													printf("</tr>");
							printf("</table>");
							printf("</td>");
						}	
			printf("</tr>");
			printf("</table>");
	}
?>
</div>
</div>
<div id="footer">
	<p>&copy; 2012. Cocu Catalin</p>
</div>
</body>
</html>
