<?php
switch($layoutAdd)
{
	case "0":
		echo"
			<div class='row-4'>
				<div class='fright'>
					<ul>
						<li><a href='index.php?page=profil.php&action=profil' class='active'><em><b>Profil</b></em></a></li>
						<li><a href='index.php?page=profil.php&action=edit'><em><b>Edition du profil</b></em></a></li>
						<li><a href='index.php?page=profil.php&action=amis'><em><b>Amis</b></em></a></li>
						<li><a href='index.php?page=profil.php&action=films'><em><b>Mes films</b></em></a></li>
					</ul>
				</div>
			</div>";
		break;
	case "1":
		echo"
			<div class='row-4'>
				<div class='fright'>
					<ul>
						<li><a href='index.php?page=profil.php&action=profil'><em><b>Profil</b></em></a></li>
						<li><a href='index.php?page=profil.php&action=edit' class='active'><em><b>Edition du profil</b></em></a></li>
						<li><a href='index.php?page=profil.php&action=amis'><em><b>Amis</b></em></a></li>
						<li><a href='index.php?page=profil.php&action=films'><em><b>Mes films</b></em></a></li>
					</ul>
				</div>
			</div>";
		break;
	case "2":
		echo"
			<div class='row-4'>
				<div class='fright'>
					<ul>
						<li><a href='index.php?page=profil.php&action=profil'><em><b>Profil</b></em></a></li>
						<li><a href='index.php?page=profil.php&action=edit'><em><b>Edition du profil</b></em></a></li>
						<li><a href='index.php?page=profil.php&action=amis' class='active'><em><b>Amis</b></em></a></li>
						<li><a href='index.php?page=profil.php&action=films'><em><b>Mes films</b></em></a></li>
					</ul>
				</div>
			</div>";
		break;
	case "3":
		echo"
			<div class='row-4'>
				<div class='fright'>
					<ul>
						<li><a href='index.php?page=profil.php&action=profil'><em><b>Profil</b></em></a></li>
						<li><a href='index.php?page=profil.php&action=edit'><em><b>Edition du profil</b></em></a></li>
						<li><a href='index.php?page=profil.php&action=amis'><em><b>Amis</b></em></a></li>
						<li><a href='index.php?page=profil.php&action=films' class='active'><em><b>Mes films</b></em></a></li>
					</ul>
				</div>
			</div>";
		break;
}