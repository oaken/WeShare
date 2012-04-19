	<h3>Mes amis</h3>	
	<p>
		Vous êtes actuellement amis avec les personnes suivantes :
	</p>
	<?php
	$friend = getFriends();
	foreach($friend as $key)
	{
		echo $key['Pseudo'] . "<a href='index.php?page=profil.php&action=amis&suppr=" .
		$key['IdFriend'] . "'><em>Cliquez ici pour supprimer cet ami</em></a><br />";
	}
	?>
	<p>
		Vous avez une requête d'ami de la part de ces personnes :
	</p>
	<?php
	$friendRequest = getFriendshipRequest() ;
	foreach($friendRequest as $key2)
	{
		echo $key2['Pseudo'] . "<a href='index.php?page=profil.php&action=amis&add=" .
		$key2['IdFriend'] . "'><em>Cliquez ici pour accepter cette invitation  </em></a>
		<a href='index.php?page=profil.php&action=amis&no=" .
		$key2['IdFriend'] . "'><em>Cliquez ici pour ignorer cette invitation</em></a><br />
		<a href='index.php?page=profil.php&action=amis&ignore=" .
		$key2['IdFriend'] . "'><em>Cliquez ici pour ignorer cette invitation</em></a><br />";
	}
	?>