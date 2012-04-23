	<!--Start of connection page-->
	<div id = "connexion">
		<form action = "/WeShare/login/" method="post">
		<h1>Connexion</h1>
		<p><label for = "pseudo">Pseudo : </label><input type="text" name="pseudo" id="pseudo" /></p>
		<p><label for = "password">Mot de passe : </label><input type="password" name="password" id="password" /></p>
		<p><input type="submit" value="Se connecter" id = "valider" /></p>
		</form>
		<p id = "message"><?php if($errorConnect == 1) echo "Votre combinaison pseudo/mot de pass est incorrecte" ?></p>
	</div>
	<!--End of connection page-->
	