	<!--Start of home page-->
	<h3>Profil</h3>
	<center>
		<table id='TableProfil' border='0'>
			<tr>
				<td colspan='2' rowspan='8'><img id='PhotoProfil' src='<?php
				if(!empty($profil['Avatar']))
				{
					echo $profil['Avatar'];
				}
				else
				{
					echo DIR_PUBLICS."/images/vide.gif"; 
				}
				?>'></td>
				<td><b>Pseudo :</b><br />
				<?php
				if(!empty($profil['Pseudo']))
				{
					echo $profil['Pseudo'];
				}
				else
				{
					echo "<em>Non-renseigné</em>"; 
				}
				?></td>
				<td><b>Date d'inscription :</b><br />
				<?php
				if(!empty($profil['RegisterDate']))
				{ 
					echo $profil['RegisterDate']; 
				}
				else
				{
					echo "<em>Non-renseigné</em>"; 
				}
				?></td>
			</tr>
			<tr>
				<td><b>Adresse e-mail :</b><br />
				<?php
				if(!empty($profil['Mail']))
				{
					echo $profil['Mail']; 
				}
				else
				{
					echo "<em>Non-renseigné</em>"; 
				}
				?></td>
			</tr>
			<tr>
				<td><b>Nom :</b><br />
				<?php 
				if(!empty($profil['LastName']))
				{
					echo $profil['LastName']; 
				}
				else
				{
					echo "<em>Non-renseigné</em>"; 
				}
				?></td>
				<td><b>Prenom :</b><br />
				<?php 
				if(!empty($profil['FirstName']))
				{
					echo $profil['FirstName']; 
				}
				else
				{
					echo "<em>Non-renseigné</em>"; 
				}
				?></td>
			</tr>
			<tr>
				<td><b>Date de naissance :</b><br />
				<?php 
				if(!empty($profil['BornDate']))
				{
					echo $profil['BornDate']; 
				}
				else
				{
					echo "<em>Non-renseigné</em>"; 
				}
				?></td>
			</tr>
			<tr>
				<td><b>Adresse :</b><br />
				<?php 
				if(!empty($profil['Address']))
				{
					echo $profil['Address']; 
				}
				else
				{
					echo "<em>Non-renseigné</em>"; 
				}
				?></td>
			</tr>
			<tr>
				<td><b>Ville :</b><br />
				<?php 
				if(!empty($profil['City']))
				{
					echo $profil['City']; 
				}
				else
				{
					echo "<em>Non-renseigné</em>"; 
				}
				?></td>
				<td><b>Pays :</b><br />
				<?php 
				if(!empty($profil['Country']))
				{
					echo $profil['Country']; 
				}
				else
				{
					echo "<em>Non-renseigné</em>"; 
				}
				?></td>
			</tr>
			<tr>
				<td><b>N° Téléphone :</b><br />
				<?php 
				if(!empty($profil['Phone']))
				{
					echo $profil['Phone']; 
				}
				else
				{
					echo "<em>Non-renseigné</em>"; 
				}
				?></td>
			</tr>
		<table>
		</center>
	<!--End of home page-->
	