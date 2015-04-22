<?require('interog.inc'); 
session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Tabere de odihna - 2013</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="main">
<div class="tophead">
  <h1>Tabere de odihna<? if (isset($_SESSION["profesor"])) {?> <a href="logout.php"><img src='images/logout.gif' width='120' height='30' align='right'></a><? } ?></h1>
</div>
<div class="header"><div id="tabsB">
  <ul>
    <li><a href="index.php" title="Home"><span>Home</span></a></li>
	<li><a href="tabere.php" title="Tabere"><span>Tabere </span></a></li>
    <li><a href="studenti.php" title="Studenti"><span>Studenti </span></a></li>
    <li><a href="facultati.php" title="Clasament"><span>Clasament</span></a></li>
	<li><a href="cereri.php?c=1" title="Cereri"><span>Cereri</span></a></li>
  </ul>
</div></div>
<div class="contents">
<div class="left">
<?
if (isset($_GET["buton_verificare"]))
	{
		$cnp = $_GET["cnp"];
		$nume = $_GET["nume"]; 
		if (($nr2 = InterogareSQL("select a.nume,a.prenume,a.localitate,a.judet,a.seriebi,a.nrbi,a.cnp,a.anstudiu,b.denumirefacultate,c.denumirespecializare,a.idstudent from gc_studenti a,gc_facultati b,gc_specializari c where a.idfacultate=b.idfacultate and a.idspecializare=c.idspecializare and a.cnp='".$cnp."' and a.nume='".$nume."';",$rez2)) == 0)
			{
				printf("Datele introduse sunt incorecte!<br>Verifica <a href='studenti.php'>lista studentilor</a> acestei universitati mai intai.");
			}
		else
		{
			$idtab = $_GET["idtab"];
			$linie2 = CitesteLinie($rez2,0);
?>
<form method='get' name='form2'>
<table border='0'>
   <tr>
       <td>
	   <?
		printf("<input type='hidden' name='idtabcerere' value='%s'>",$idtab);
		printf("<input type='hidden' name='idstudentcerere' value='%s'>",$linie2[10]);
		?>
	   </td>
   </tr>
   <tr>
       <td colspan='4'><center><font size='6'>CERERE INDIVIDUALA</font></center></td>
   </tr>
   <tr>
       <td><br><br></td>
   </tr>
   <tr>
       <td colspan='4'><center><b>Pentru ocuparea unui loc in cadrul Programului "Tabere Studentesti 2013" organizat de Autoritatea Nationala pentru Sport si Tineret - Directia pentru Studenti prin Casele de Cultura ale Studentilor si Complexul Cultural Sportiv Studentesc in perioada vacantei de vara</b></center></td>
   </tr>
   <tr>
       <td><b><br><br><font size='3'>Date personale</font></b></td>
   </tr>
   <tr>
       <td><br><br></td>
   </tr>
   <tr>
      <td>
          <b>Nume</b>
      </td>
   </tr>
   <tr>
      <td>
          <u><font size='3'>
		  <? printf("%s",$linie2[0]);?>
		  </font></u>
      </td>
   </tr>
   <tr>
      <td>
          <b>Prenume</b>
      </td>
   </tr>
   <tr>
      <td>
          <u><font size='3'><? printf("%s",$linie2[1]);?></font></u>
      </td>
   </tr>
   <tr>
      <td>
           <b>Localitate</b>
      </td>
      <td>
          <u><font size='3'><? printf("%s",$linie2[2]);?></font></u>
      </td>
      <td>
          <b>Judet</b>
      </td>
      <td>
          <u><font size='3'><? printf("%s",$linie2[3]);?></font></u>
      </td>
   </tr>
   <tr>
      <td>
           <b>Serie C.I./B.I/Pasaport</b>
      </td>
      <td>
          <u><font size='3'><? printf("%s%s",$linie2[4],$linie2[5]);?></font></u>
      </td>
      <td>
          <b>Cod numeric personal</b>
      </td>
      <td>
          <u><font size='3'><? printf("%s",$linie2[6]);?></font></u>
      </td>
   </tr>
   <tr>
      <td>
           <b>Facultatea</b>
      </td>
      <td>
          <u><font size='3'><? printf("%s",$linie2[8]);?></font></u>
      </td>
      <td rowspan='2'>
          <b>An de studiu</b>
      </td>
      <td rowspan='2'>
          <u><font size='3'><? printf("%s",$linie2[7]);?></font></u>
      </td>
   </tr>
   <tr>
      <td>
           <b>Specializarea</b>
      </td>
      <td>
          <u><font size='3'><? printf("%s",$linie2[9]);?></font></u>
      </td>
   </tr>
   <tr>
       <td><br><br></td>
   </tr>
   <tr>
       <td><b><br><br><font size='3'>Activitate</font></b></td>
   </tr>
   <tr>
       <td><br><br></td>
   </tr>
   <tr>
      <td colspan='4'>
           <b><br>Performantele in activitatea depusa in cadrul organizat la diverse manifestari culturale, artistice, stiintifice sau sportive</b>
      </td>
   </tr>
   <tr>
      <td>
           <b><br>Activitate 1</b>
      </td>
	  <td colspan='2'>
           <br><input type='text' name='numeactivitate1' value='numele activitatii 1' size='45'>
		   <br><select name="tipactivitate1" style="width:330px">
		   <option value="0">tipul activitatii</option>
            <?php
						if (($nr3 = InterogareSQL("select idtipactivitate,numetipactivitate from gc_tipuriactivitati;",$rez3)) != 0)
							{
								for ($i=0;$i<$nr3;$i++)
								{
									$linie3 = CitesteLinie($rez3,$i);
									printf("<option value=\"%s\">%s</option>",$linie3[0],$linie3[1]);
								}
							}
			?>
            </select>
		   <br><select name="locatieactivitate1" style="width:330px">
					<option value="0">locatia</option>
					<option value="strainatate">strainatate</option>
					<option value="international">international</option>
					<option value="national">national</option>
					<option value="local">local</option>
		   </select>
      </td>
	   <td>
		   <input type='text' name='punctaj1' value='punctaj' size='6'>
           <br><br><select name="profindrumator1" style="width:170px">
		   <option value="0">profesor indrumator</option>
            <?php
						if (($nr3 = InterogareSQL("select idprofesor,nume,prenume from gc_profesori;",$rez3)) != 0)
							{
								for ($i=0;$i<$nr3;$i++)
								{
									$linie3 = CitesteLinie($rez3,$i);
									printf("<option value=\"%s\">%s %s</option>",$linie3[0],$linie3[1],$linie3[2]);
								}
							}
			?>
            </select>
      </td>
   </tr>
   <tr>
      <td>
           <b><br>Activitate 2</b>
      </td>
	  <td colspan='2'>
           <br><input type='text' name='numeactivitate2' value='numele activitatii 2' size='45'>
		   <br><select name="tipactivitate2" style="width:330px">
		   <option value="0">tipul activitatii</option>
            <?php
						if (($nr3 = InterogareSQL("select idtipactivitate,numetipactivitate from gc_tipuriactivitati;",$rez3)) != 0)
							{
								for ($i=0;$i<$nr3;$i++)
								{
									$linie3 = CitesteLinie($rez3,$i);
									printf("<option value=\"%s\">%s</option>",$linie3[0],$linie3[1]);
								}
							}
			?>
            </select>
		   <br><select name="locatieactivitate2" style="width:330px">
					<option value="0">locatia</option>
					<option value="strainatate">strainatate</option>
					<option value="international">international</option>
					<option value="national">national</option>
					<option value="local">local</option>
		   </select>
      </td>
	   <td>
		   <input type='text' name='punctaj2' value='punctaj' size='6'>
           <br><br><select name="profindrumator2" style="width:170px">
		   <option value="0">profesor indrumator</option>
            <?php
						if (($nr3 = InterogareSQL("select idprofesor,nume,prenume from gc_profesori;",$rez3)) != 0)
							{
								for ($i=0;$i<$nr3;$i++)
								{
									$linie3 = CitesteLinie($rez3,$i);
									printf("<option value=\"%s\">%s %s</option>",$linie3[0],$linie3[1],$linie3[2]);
								}
							}
			?>
            </select>
      </td>
   </tr>
   <tr>
      <td>
           <b><br>Activitate 3</b>
      </td>
	  <td colspan='2'>
           <br><input type='text' name='numeactivitate3' value='numele activitatii 3' size='45'>
		   <br><select name="tipactivitate3" style="width:330px">
		   <option value="0">tipul activitatii</option>
            <?php
						if (($nr3 = InterogareSQL("select idtipactivitate,numetipactivitate from gc_tipuriactivitati;",$rez3)) != 0)
							{
								for ($i=0;$i<$nr3;$i++)
								{
									$linie3 = CitesteLinie($rez3,$i);
									printf("<option value=\"%s\">%s</option>",$linie3[0],$linie3[1]);
								}
							}
			?>
            </select>
		   <br><select name="locatieactivitate3" style="width:330px">
					<option value="0">locatia</option>
					<option value="strainatate">strainatate</option>
					<option value="international">international</option>
					<option value="national">national</option>
					<option value="local">local</option>
		   </select>
      </td>
	   <td>
		   <input type='text' name='punctaj3' value='punctaj' size='6'>
           <br><br><select name="profindrumator3" style="width:170px">
		   <option value="0">profesor indrumator</option>
            <?php
						if (($nr3 = InterogareSQL("select idprofesor,nume,prenume from gc_profesori;",$rez3)) != 0)
							{
								for ($i=0;$i<$nr3;$i++)
								{
									$linie3 = CitesteLinie($rez3,$i);
									printf("<option value=\"%s\">%s %s</option>",$linie3[0],$linie3[1],$linie3[2]);
								}
							}
			?>
            </select>
      </td>
   </tr>
   <tr>
   <td colspan='4'>
   <b><i>* Se anexeaza la prezenta fisa documentele doveditoare</i></b>
   </td>
   </tr>
   <tr>
       <td><br><br></td>
   </tr>
   <tr>
      <td>
      </td>
      <td>
      </td>
      <td>
        Semnatura solicitant
      </td>
      <td>
      </td>
   </tr>
   <tr>
      <td>
      </td>
      <td>
      </td>
      <td>
        Data completarii
		<br>
		<?php
		$datacompletare = date('Y-m-d', time());
		printf("%s",$datacompletare);
		?>
      </td>
      <td>
      </td>
   </tr>
   <tr>
	   <td></td>
       <td colspan="2"><br><br><center><input type="submit" name="butontrimiteformular" value="Trimite cererea"><center></td>
   </tr>
   <tr>
       <td colspan='4'><center><i>Nota: Informatiile completate sunt protejate conform Legii 677/2001 privind protectia persoanelor, cu privire la prelucrarea datelor cu caracter personal si libera circulatie a acestor date</i></center></td>
   </tr>
</table>
</form>
<?
		}
	}
else
	{ 
	if (isset($_SESSION["profesor"]))
		{
			printf("<center><h1>Esti conectat ca si profesor in aceasta aplicatie, deconecteaza-te mai intai!</h1></center>");
			printf("<img src='images/atention.jpg' width='200' height='200' align='right'>");
		}
	else
		{
?>
<center>
<h1>Te poti inscrie pentru tabara doar daca esti student al acestei universitati!</h1>
<form method='get' name='form1'>
<table>
<tr><td></td><td><font size="4">Verificare student activ</font></td></tr>
<tr>
<td>Nume</td>
<td><input type='text' name='nume'></td>
</tr>
<tr>
<td>CNP</td>
<td><input type='password' name='cnp'></td>
</tr>
<?
if (isset($_GET["idt"]))
	{
		$idtabara = $_GET["idt"];
		if (($nr1 = InterogareSQL("select * from gc_tabere where idtabara=".$idtabara.";",$rez1)) != 0)
		{
			for($i=0;$i<$nr1;$i++)
			{
				$linie1 = CitesteLinie($rez1,$i);
				printf("<input type='hidden' name='idtab' value='%s'>",$linie1[0]);
			}
		}
	}
?>
<tr>
<td></td>
<td><input type='submit' class='button_confirmare' name='buton_verificare' value='Verifica'></td>
</tr>
</table>
</form>
</center>
<img src='images/inscriere_buton.gif' width='200' height='200' align='right'>
<?
		}
	}
	if (isset($_GET["butontrimiteformular"]))
			{
				$datacompletare = date('Y-m-d', time());
				$idtabcerere = $_GET["idtabcerere"];
				$idstudentcerere = $_GET["idstudentcerere"];
				
				$numeactivitate1 = $_GET["numeactivitate1"];
				$tipactivitate1 = $_GET["tipactivitate1"];
				$locatieactivitate1 = $_GET["locatieactivitate1"];
				$profindrumator1 = $_GET["profindrumator1"];
				$punctaj1 = $_GET["punctaj1"];
				
				$numeactivitate2 = $_GET["numeactivitate2"];
				$tipactivitate2 = $_GET["tipactivitate2"];
				$locatieactivitate2 = $_GET["locatieactivitate2"];
				$profindrumator2 = $_GET["profindrumator2"];
				$punctaj2 = $_GET["punctaj2"];
				
				$numeactivitate3 = $_GET["numeactivitate3"];
				$tipactivitate3 = $_GET["tipactivitate3"];
				$locatieactivitate3 = $_GET["locatieactivitate3"];
				$profindrumator3 = $_GET["profindrumator3"];
				$punctaj3 = $_GET["punctaj3"];
				
				InterogareSQL("insert into gc_cereri(idstudent,idtabara,datacererii) values(".$idstudentcerere.",".$idtabcerere.",'".$datacompletare."');",$rez5);
				if (($nr6 = InterogareSQL("select idcerere from gc_cereri where idstudent=".$idstudentcerere.";",$rez6)) != 0)
							{
								$linie6 = CitesteLinie($rez6,0);
							}
				$ok = 0;
				$numaractivitati = 0;
				if ($numeactivitate1!="numele activitatii 1" and $punctaj1!= "punctaj" and $tipactivitate1!=0)
					if ($locatieactivitate1!="0" and $profindrumator1!="0")
						{
							$ok = 1;
							$numaractivitati = $numaractivitati + 1;
							InterogareSQL("insert into gc_activitati(numeactivitate,punctaj,idstudent,idprofesor,idtipactivitate,locatie,idcerere) values('".$numeactivitate1."',".$punctaj1.",".$idstudentcerere.",".$profindrumator1.",".$tipactivitate1.",'".$locatieactivitate1."',".$linie6[0].");",$rez4);							
						}
				if ($numeactivitate2!="numele activitatii 2" and $punctaj2!= "punctaj" and $tipactivitate2!=0)
					if ($locatieactivitate2!="0" and $profindrumator2!="0")
						{
							$ok = 1;
							$numaractivitati = $numaractivitati + 1;
							InterogareSQL("insert into gc_activitati(numeactivitate,punctaj,idstudent,idprofesor,idtipactivitate,locatie,idcerere) values('".$numeactivitate2."',".$punctaj2.",".$idstudentcerere.",".$profindrumator2.",".$tipactivitate2.",'".$locatieactivitate2."',".$linie6[0].");",$rez4);
						}
				if ($numeactivitate3!="numele activitatii 3" and $punctaj3!= "punctaj" and $tipactivitate3!=0)
					if ($locatieactivitate3!="0" and $profindrumator3!="0")
						{
							$ok = 1;
							$numaractivitati = $numaractivitati + 1;
							InterogareSQL("insert into gc_activitati(numeactivitate,punctaj,idstudent,idprofesor,idtipactivitate,locatie,idcerere) values('".$numeactivitate3."',".$punctaj3.",".$idstudentcerere.",".$profindrumator3.",".$tipactivitate3.",'".$locatieactivitate3."',".$linie6[0].");",$rez4);
						}
				if ($ok == 0)
					printf("La cererea ta nu a fost adaugata nicio activitate.Datele pe care le-ai introdus au fost incomplete!");
				else
					printf("Au fost adaugate %s activitati!",$numaractivitati);
			}
?>
</div>
<div class="spacer">&nbsp;</div>
</div>
<div class="footer">
<div class="footertexts">&copy; Tabere de odihna 2013<br />
</div>
</div>

</div>
</body>
</html>
