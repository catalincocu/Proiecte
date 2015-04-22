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
				$priv = $linie[0];
				$_SESSION["privilegiu"] = $priv;
				$data = date('Y-m-d', time());
				InterogareSQL("UPDATE tb_utilizatori SET ultima_logare='".$data."' WHERE nick='".$_POST["user"]."';",$rez);
				}
			}
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
		if (!isset($_SESSION["ok"]))
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
			if (isset($_SESSION["ok"]))
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
<?php
if (!isset($_SESSION["ok"]))
	{
		?>
		<div id="poza">
		<?php
		printf("<img src=\"poza_liceu.jpg\" width=\"550\" height=\"230\">");
		?>
		</div>
		<div id="titlu">
		<?php
		printf("<br>Bun venit in aplicatia web de gestiune a elevilor Colegiului National ,,Eudoxiu Hurmuzachi'' din Radauti");
		?>
		</div>
		<div id="bloc_text">
		<?php
		printf("<p align=\"center\"><h1>Istoric</h1><br>");
		printf("<b>1957-1965</b> - Durata studiilor in Scoala Medie revine la 11 ani;
<br>
<b>1965</b> - Durata studiilor se prelungeste la 12 ani;
 <br>
<b>1972</b> - Sarbatorirea centenarului liceului - dupa mai multe amanari - si revenirea, in mod oficial, la vechea denumire de Liceul \"Eudoxiu Hurmuzachi\";
 <br>
<b>1976</b> - Institutia noastra scolara se transforma in Liceul Industrial \"Eudoxiu Hurmuzachi\", aflat in subordinea Ministerului Educatiei si Invatamantului si a Ministerului Constructiilor de Masini si, apoi, a Ministerului Industriei de Masini, Unelte si Electrotehnicii;
 <br>
<b>1982-1983</b> (anul scolar)  - se infiinteaza clasele cu profilele: matematica-fizica, mecanica, electromecanic;
 <br>
<b>1983-1984</b> (anul scolar) - elevii claselor a XII absolva profilul: matematica-fizica si mecanica;
 <br>
<b>1984</b> - Se hotaraste generalizarea invatamantului de 12 ani;
 <br>
<b>1986-1987</b> (anul scolar) - elevii claselor a XII absolva profilele:matematica-fizica, mecanica si electro-mecanica;
 <br>
<b>1987-1988</b> (anul scolar) - elevii claselor a XII absolva profilele: matematica-fizica, mecanica si electrotehnica;
22 decembrie 1989 - Revolutia din decembrie 1989. In anul scolar 1990-1991, Liceul \"Eudoxiu Hurmuzachi\" redevine liceu teoretic si se infiinteaza clasele cu profilul istorie-stiinte sociale;
 <br>
<b>1991-1992</b> (anul scolar) - elevii claselor a XII absolva profilele: matematica-fizica, istorie-stiinte sociale, electronica si electrotehnica si constructii de masini;
 <br>
<b>1992-1993 </b> (anul scolar) -  elevii claselor a XII absolva profilele: matematica-fizica, fizica-chimie, limbi moderne si electronica si electrotehnica;
 <br>
<b>1993-1994</b> (anul scolar) - elevii claselor a XII absolva profilele: matematica-fizica, fizica-chimie, chimie-biologie, filologie si limbi moderne;
 <br>
<b>1994-1995</b> (anul scolar) - elevii claselor a XII absolva profilele: matematica-fizica, fizica-chimie, chimie-biologie, filologie, limbi moderne, istorie-stiinte sociale si informatica-analisti programatori;<br>
");
?>
</div>
<?php
	}
if (isset($_SESSION["ok"]))
	if ($_SESSION["ok"] == 1)
		if (($nr17 = InterogareSQL("select ultima_logare from tb_utilizatori where nick='".$_SESSION["user"]."';",$rez17)) == 0)
			echo "Eroare!";
		else
			{
				?>
					<div id="poza">
					<?
						if ($_SESSION["privilegiu"]=="elev")
							printf("<img src=\"elev.jpg\">");
						else
							if ($_SESSION["privilegiu"]=="profesor")
								printf("<img src=\"profesor.jpg\">");
							else
								if($_SESSION["privilegiu"]=="parinte")
									printf("<img src=\"parinte.jpg\">");
								else
									if($_SESSION["privilegiu"]=="admin")
										printf("<img src=\"admin.jpg\">");
					?>
					</div>
					<div id="titlu">
					<table>
					<?php
							if (($nr19= InterogareSQL("select nume,prenume,privilegiu from tb_utilizatori where nick='".$_SESSION["user"]."';",$rez19)) == 0) echo "Eroare 1";
							else
								{
									$linie19=CitesteLinie($rez19,0);
									$numele = $linie19[0];
									$prenumele = $linie19[1];
									$privilegiul = $linie19[2];
								}
							if ($privilegiul=="profesor")
								{
									if( ($nr4=InterogareSQL("select cod from tb_utilizatori where nick='".$_SESSION["user"]."';" ,$mat4))==0) echo "";
									else
										{
											$linie4 = CitesteLinie($mat4,0);
											$idprof=$linie4[0];
											if (($nr18=InterogareSQL("select distinct a.nume_disciplina from tb_discipline a,tb_prof_disc_clasa b where a.cod_disciplina=b.cod_disciplina and b.cod_profesor=".$idprof.";",$rez18)) == 0) echo "Eroare 2";
											else
												{
													$nrdisc=0;
													for ($j=0;$j<$nr18;$j++)
														{
															$linie18=CitesteLinie($rez18,$j);
															$disciplina[$nrdisc] = $linie18[0];
															$nrdisc++;
														}
												}
										}
								}
							if ($privilegiul=="elev")
								{
									if (($nr20=InterogareSQL("select a.nume_clasa,b.nume_profil from tb_clase a,tb_profiluri b,tb_elevi c where c.id_clasa=a.cod_clasa and a.cod_profil=b.cod_profil and c.nume_elev='".$numele."' and c.prenume_elev='".$prenumele."';",$rez20)) ==0) echo "Eroare 3";
									else
										{
											$linie20=CitesteLinie($rez20,0);
											$numeclasa=$linie20[0];
											$numeprofil=$linie20[1];
										}
								}
							if ($privilegiul=="parinte")
								{
									if (($nr21=InterogareSQL("select cod_parinte from tb_parinti where nume_parinte='".$numele."' and prenume_parinte='".$prenumele."';",$rez21)) ==0) echo "Eroare 3";
									else
										{
											$linie21=CitesteLinie($rez21,0);
											$idparinte=$linie21[0];
											if (($nr22=InterogareSQL("select a.nume_elev,a.prenume_elev,a.id_elev from tb_elevi a,tb_parinte_elev c where a.id_elev=c.id_copil and (c.id_tata=".$idparinte." or c.id_mama=".$idparinte.");",$rez22)) ==0) echo "Eroare 4";
											else
												{
													$nrnume=0;
													for ($z=0;$z<$nr22;$z++)
														{
															$linie22=CitesteLinie($rez22,$z);
															$numele_copil[$nrnume]=$linie22[0];
															$prenumele_copil[$nrnume]=$linie22[1];
															$id_copil[$nrnume]=$linie22[2];
															$nrnume++;
														}
												}
										}
								}
							$linie17=CitesteLinie($rez17,0);
							printf("<tr><td>");
							printf("<font size=\"4\"><b>Bun venit %s %s, ultima ta conectare a fost in data de %s </b></font>!",$numele,$prenumele,$linie17[0]);
							printf("</td></tr>");
							printf("<tr><td><font size=\"4\"><b>In aceasta aplicatie ai privilegiul de ".$_SESSION["privilegiu"]."");
							if ($privilegiul=="profesor")
								{
									printf(" pentru ca esti profesor si predai disciplinele:<br> ");
									for ($i=0;$i<$nrdisc;$i++)
										printf("%s.$disciplina[$i]<br>",$i+1);
									printf("</b></font></td></tr>");
								}
							if ($privilegiul=="elev")
								printf(" pentru ca esti elev in clasa ".$numeclasa." la profilul ".$numeprofil.".</b></font></td></tr>");
							if ($privilegiul=="parinte")
								{
									printf(" al elevului:<br>");
									printf("<form method=\"POST\" target=\"index.php\">");
									printf("<select name=\"copil\" class=\"text\">");
									for ($z=0;$z<$nrnume;$z++)
										printf("<option value=$id_copil[$z]>$numele_copil[$z] $prenumele_copil[$z]</option>\n");									
									printf("</select>");
									?>
									<input type="submit" name="buton_selectie" value="Aplica schimbarea!" class="buton_1"  onclick="this.form.target='_self';return true;">
									<?php
									printf("</form>");
									printf("</b></font></td></tr>");
								}
							if ($privilegiul=="admin")
								printf(" pentru ca esti administrator.</b></font></td></tr>");
							if (isset($_POST['buton_selectie']))
								{
									$f=fopen("copil.txt","wt"); 
									$idcopilului = $_POST['copil'];
									if($f) 
									{			
										fputs($f,"$idcopilului\n"); 
									}
									printf("S-a aplicat schimbarea!");
									fclose($f); 
								}
					?>
					</table>
					</div>
					<div id="bloc_text">
<br><br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lucrarea de fata a fost elaborata pentru o mai buna transparenta intre activitatea elevilor la scoala si parintii lor dar si pentru ca fiecare elev sa isi cunoasca situatia scolara, accesul la informatii fiind diferentiat.
Traim intr-un mileniu in care viteza este foarte importanta si timpul din ce in ce mai pretios. Parintii isi doresc deseori sa ajunga la scoala pentru a discuta cu profesorii situatia scolara a copiilor lor dar din pacate serviciul le ocupa tot timpul.
Desi nu se poate substitui dialogul pe care un parinte doreste sa il poarte cu dirigintele sau profesorii copilului sau, solutia propusa ajuta parintii sa afle rapid situatia scolara a copilului lor prin intermediul unei aplicatii web care faciliteaza prin interfata si functionabilitate informarea parintilor dar si a elevilor despre situatia lor scolara.
Prin intermediul acestei aplicatii se obtine o evidenta completa si rapida a notelor elevilor, accesibila oricand si oriunde.

</div>

				<?php
			}
			?>
</div>
<div id="footer">
	<p>&copy; 2012. Cocu Catalin</p>
</div>
</body>
</html>