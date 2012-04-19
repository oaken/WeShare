<div class="indent2">
		<form id="edit-profile-form" action=""> <br>
			<h3>Modifier votre profil</h3>	
				<fieldset>
					<div class="field"><label>Nom :</label><input type="text" value=""/></div><br />
					<div class="field"><label>Prénom :</label><input type="text" value=""/></div><br />
					<!--<div class="field"><label>Date de Naissace:</label><input type="text" value=""/></div><br />-->
					<div class="field"><label>Date de Naissace:</label>
						<select name="Jour">
							<option value="Jour"><?php echo('16');?></option>
						</select>
						<select name="Mois">
							<option value="Mois"><?php echo('03');?></option>
						</select>
						<select name="Année">
							<option value="Année"><?php echo('1990');?></option>
						</select>
					</div><br />
					<div class="field"><label>Adresse Postale :</label><input type="text" value=""/></div><br />
					<div class="field"><label>N° de Téléphone :</label><input type="text" value=""/></div><br />
					<div class="field"><label>Adresse mail :</label><input type="text" value=""/></div><br />
					<div class="field"><label>Mot de Passe :</label><input type="text" value=""/></div><br />
					<!-- <div class="field"><label>Votre Avatar :</label><input type="text" value=""/></div><br /> -->
					<div class="wrapper"><a href="#" onclick="document.getElementById('contacts-form').submit()"><em><b>Enregistre les modifications</b></em></a></div>
				</fieldset>
		</form>
</div>