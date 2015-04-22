<?php
require('interog.inc');
session_start();
$incercare=0;
if (isset($_POST['loginform_submit']))
			{
				$incercare=1;
				if (($nr = InterogareSQL("select * from t_administratori where nume_administrator='".$_POST["user"]."' and parola_administrator='".$_POST["parola"]."';",$rez)) != 0)
				{
					$linie = CitesteLinie($rez,0);
					$id_sesiune = session_id();
					$_SESSION["okadmin"] = 1;
					$_SESSION["useradmin"] = $_POST['user'];
					$_SESSION["useradminid"] = $linie[0];
					$linie = CitesteLinie($rez,0);
					header("location:administrareobiective.php");
				}
			}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administrare - Obiective turistice din Bucovina - 2014</title>
<link rel="stylesheet" type="text/css" href="style.css" />
<link href='http://fonts.googleapis.com/css?family=Belgrano' rel='stylesheet' type='text/css'>
</head>
<body>
<div id="loginpanelwrap">
  	
	<div class="loginheader">
    <div class="logintitle"><a href="index.php">Panou de administrare</a></div>
    </div>

    <div class="loginform">
       <form id="form1" method="post" target="index.php">
        <div class="loginform_row">
        <label>Username:</label>
        <input type="text" class="loginform_input" name="user" />
        </div>
        <div class="loginform_row">
        <label>Parola:</label>
        <input type="password" class="loginform_input" name="parola" />
        </div>
        <div class="loginform_row">
        <input type="submit" name="loginform_submit" class="loginform_submit" value="Conectare" onclick="this.form.target='_self';return true;"/>
		<?php
						if ($incercare==1)
							echo "Date incorecte!";
		?>
        </div> 
        <div class="clear"></div>
		</form>
    </div>
</div>
	
</body>
</html>