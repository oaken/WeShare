<!DOCTYPE html>
<!--Start of header-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>WeShare</title>
	<meta http-equiv="Content-Type" content="text/html; charset=ANSI" />
	<meta name="description" content="Place your description here" />
	<meta name="keywords" content="put, your, keyword, here" />
	<meta name="author" content="Team Weshare" />
	<link href="<?php echo DIR_PUBLICS; ?>/style.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo DIR_PUBLICS; ?>/layout.css" rel="stylesheet" type="text/css" />
	<script src="<?php echo DIR_PUBLICS; ?>/js/jquery-1.4.2.min.js" type="text/javascript"></script>
	<script src="<?php echo DIR_PUBLICS; ?>/js/cufon-yui.js" type="text/javascript"></script>
	<script src="<?php echo DIR_PUBLICS; ?>/js/cufon-replace.js" type="text/javascript"></script>
	<script src="<?php echo DIR_PUBLICS; ?>/js/Myriad_Pro_300.font.js" type="text/javascript"></script>
	<script src="<?php echo DIR_PUBLICS; ?>/js/Myriad_Pro_400.font.js" type="text/javascript"></script>
</head>
<body id="page1">
<div id="taille">
<div class="tail-bottom">
<!-- HEADER -->
<?php 
switch($_GET['page'])
{
	case "accueil.php":
		$active[0]= " class='active'";
		$active[1]= "";
		$active[2]= "";
		$active[3]= "";
		$active[4]= "";
		$active[5]= "";
		break;
	case "films.php":
		$active[0]= "";
		$active[1]= " class='active'";
		$active[2]= "";
		$active[3]= "";
		$active[4]= "";
		$active[5]= "";
		break;
	case "evenements.php":
		$active[0]= "";
		$active[1]= "";
		$active[2]= " class='active'";
		$active[3]= "";
		$active[4]= "";
		$active[5]= "";
		break;
	case "membres.php":
		$active[0]= "";
		$active[1]= "";
		$active[2]= "";
		$active[3]= " class='active'";
		$active[4]= "";
		$active[5]= "";
		break;
	case "profil.php":
		$active[0]= "";
		$active[1]= "";
		$active[2]= "";
		$active[3]= "";
		$active[4]= " class='active'";
		$active[5]= "";
		break;
	case "deconnection.php":
		$active[0]= "";
		$active[1]= "";
		$active[2]= "";
		$active[3]= "";
		$active[4]= "";
		$active[5]= " class='active'";
		break;
}
?>
	<div id="header">
		<div class="row-1">
			<div class="fleft"><a href="films.html"><img src="images/logo" alt="" /></a></div>
			<div class="fright">
				<ul>
					<li><a href="index.php?page=accueil.php"<?php echo $active[0];?>><em><b>Accueil</b></em></a></li>
					<li><a href="index.php?page=films.php"<?php echo $active[1];?>><em><b>Films</b></em></a></li>
					<li><a href="index.php?page=evenements.php"<?php echo $active[2];?>><em><b>Evènements</b></em></a></li>
					<li><a href="index.php?page=membres.php"<?php echo $active[3];?>><em><b>Membres</b></em></a></li>
					<li><a href="index.php?page=profil.php"<?php echo $active[4];?>><em><b>Profil</b></em></a></li>
					<li><a href="index.php?page=deconnection"<?php echo $active[5];?>><em><b>Déconnexion</b></a></em></li>
				</ul>
			</div>
		</div>

		
	<!--End of header -->