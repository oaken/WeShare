	<h3>Mes amis</h3>	

	<?php
	if($friend != -1)
	{
	echo "	<p>
				Vous êtes actuellement amis avec les personnes suivantes :
			</p>";
		foreach($friend as $key)
		{
			echo $key['Pseudo'] . "<a href='index.php?page=profil.php&action=amis&suppr=" .
			$key['IdUser'] . "'><em>Cliquez ici pour supprimer cet ami</em></a><br />";
		}
	}
	else
	{
		echo "Vous n'avez pas encore d'amis\n";
	}
	?>
	<br /><br /><br /><br />
	<h3>Mes demandes d'amis</h3>	
	<?php
	if($friendRequest != -1)
	{
	echo "	<p>
				Vous avez une requête d'ami de la part de ces personnes :
			</p>";
		foreach($friendRequest as $key2)
		{
			echo $key2['Pseudo'] . "  <a href='index.php?page=profil.php&action=amis&add=" .
			$key2['IdUser'] . "'><em>Accepter</em></a>    
			<a href='index.php?page=profil.php&action=amis&no=" .
			$key2['IdUser'] . "'><em>Refuser</em></a>    
			<a href='index.php?page=profil.php&action=amis&ignore=" .
			$key2['IdUser'] . "'><em>Ignorer</em></a>  <br />";
		}
	}
	else
	{
		echo "Vous n'avez pas encore de demande d'amis. Ou vous avez déjà répondu à toute les demandes.<br /><br /><br /><br />\n";
	}
	?>