<div class="indent2">
		<form id="edit-profile-form" method="post" action="/WeShare/Profil/Edit/ModifierProfil/">
			<h3>Modifier votre profil</h3>	
				<fieldset>
					<div class="field"><label>Nom :</label><input type="text" name="lastName" id="lastName" value=""/></div><br />
					<div class="field"><label>Prénom :</label><input type="text" name="firstName" id="firstName" value=""/></div><br />
					<!--<div class="field"><label>Date de Naissace:</label><input type="text" value=""/></div><br />-->
					<div class="field"><label>Date de Naissace:</label>
						<select name="day">
							<option value="Jour"><?php echo('16');?></option>
						</select>
						<select name="month">
							<option value="Mois"><?php echo('03');?></option>
						</select>
						<select name="year">
							<option value="Année"><?php echo('1990');?></option>
						</select>
					</div><br />
					<div class="field"><label>Adresse Postale :</label><input type="text" name="address" value=""/></div><br />
					<div class="field"><label>Ville :</label><input type="text"  name="city" value=""/></div><br />
						<select name="country" id="country">
						   <option value="" SELECT></option>
						   <option value="france">France</option>
						   <option value="espagne">Espagne</option>
						   <option value="italie">Italie</option>
						   <option value="royaume-uni">Royaume-Uni</option>
						   <option value="canada">Canada</option>
						   <option value="etats-unis">Etats-Unis</option>
						   <option value="chine">Chine</option>
						   <option value="japon">Japon</option>
					   </select>
					<div class="field"><label>N° de Téléphone :</label><input type="text" name="phoneNumber" value=""/></div><br />
					<div class="field"><label>Adresse mail :</label><input type="text" value=""/></div><br />
					<div class="field"><label>Mot de Passe :</label><input type="text" name="password" type="password" value=""/></div><br />
					<div class="field"><label>Confirmer mot de Passe :</label><input type="text" name="retypePassword" type="password" value=""/></div><br />
					<div class="field"><label>Votre Avatar :</label><input type="text" name ="avatar" value=""/></div><br />
					<div class="wrapper"><input type="submit" value="Enregistrer les modifications"></div>
				</fieldset>
		</form>
</div>