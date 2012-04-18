	<!--Start of connection page-->
	<div id = "connexion">
		<form action = "index.php?page=login" method="post">
		<h1>Connexion</h1>
		<p><label for = "pseudo">Pseudo : </label><input type="text" name="pseudo" id="pseudo" /></p>
		<p><label for = "pass">Mot de passe : </label><input type="password" name="pass" id="pass" /></p>
		<p><input type="submit" value="Se connecter" id = "valider" /></p>
		</form>
		<p id = "message"><?php if(isset($message)) echo $message ?></p>
	</div>
	<!--End of connection page-->
	