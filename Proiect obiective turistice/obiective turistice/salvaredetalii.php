<?php
require 'pdfcrowd.php';
require('interog.inc');
session_start();
$id = $_GET["ido"];
$interogare = "select nume,tip from t_obiective where idobiectiv=$id;";
if (($nr1 = InterogareSQL($interogare,$rezultat)) != 0)
		{
			for ($i=0;$i<$nr1;$i++)
				{
					$linie1 = CitesteLinie($rezultat,$i);
					$nume = $linie1[0];
					$tip = $linie1[1];
				}
		}
try
{   
    $user = "catalin48";
	$parola = "8f6e695c73309101358fa5b396859f79";
	$autor = "Anca Spiridon";
    $client = new Pdfcrowd($user, $parola);

    // convert a web page and store the generated PDF into a $pdf variable
	if ($tip == "manastire")
		$url = "http://apollo.eed.usv.ro/~cocu_c/ancaspiridon/aplicatie/manastiri.php?m=$id";
	if ($tip == "muzeu")
		$url = "http://apollo.eed.usv.ro/~cocu_c/ancaspiridon/aplicatie/muzee.php?mz=$id";
	if ($tip == "rezervatie")
		$url = "http://apollo.eed.usv.ro/~cocu_c/ancaspiridon/aplicatie/rezervatii.php?rz=$id";
	if ($tip == "pensiune")
		$url = "http://apollo.eed.usv.ro/~cocu_c/ancaspiridon/aplicatie/pensiuni.php?p=$id";
	if ($tip == "restaurant")
		$url = "http://apollo.eed.usv.ro/~cocu_c/ancaspiridon/aplicatie/restaurante.php?r=$id";
	$client->setAuthor($autor);
    $pdf = $client->convertURI($url);
    // set HTTP response headers
    header("Content-Type: application/pdf");
    header("Cache-Control: max-age=0");
    header("Accept-Ranges: none");
    header("Content-Disposition: attachment; filename=\"$nume.pdf\"");

    // send the generated PDF 
    echo $pdf;
}
catch(PdfcrowdException $why)
{
    echo "Pdfcrowd Error: " . $why;
}
?>