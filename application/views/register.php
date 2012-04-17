	<!--Start of login page-->
<div class="tail-bottom">
	<div id="header">
	<?php if (ENV_TEST == 0){ ?>
	<hr />
	<h5 id="status"></h5>
	<form id="demoForm" method="post" action="#" class="bbq">
		<input type="hidden" id="page" value="connection">
		<div id="fieldWrapper">
			<span class="step" id="first">
				<span class="font_normal_07em_black">Etape 1</span><br />
				<label for="pseudo">Pseudo : </label><br />
				<input class="input_field_12em pseudo required" name="pseudo" id="pseudo" /><br />
				<label for="password">Password : </label><br />
				<input class="input_field_12em password required" name="password" id="password" type="password" /><br />
				<label for="retypePassword">Retype password : </label><br />
				<input class="input_field_12em retypePassword required" name="retypePassword" id="retypePassword" type="password" /><br />
				<label for="email">Email : </label><br />
				<input class="input_field_12em email required" name="email" id="email" /><br />
			</span>
			<span id="finland" class="step">
				<span class="font_normal_07em_black">Etape 2 - Optionnel</span><br />
				<label for="nom">Nom : </label><br />
				<input class="input_field_12em" name="lastName" id="lastName" /><br />
				<label for="prenom">Prenom : </label><br />
				<input class="input_field_12em" name="firstName" id="firstName" /><br />
				<label for="day_fi">Date de naissance : </label><br />
				<input class="input_field_25em" name="day" id="day_fi" value="" /> -
				<input class="input_field_3em" name="month" id="month_fi" value="" /> - 
				<input class="input_field_3em" name="year" id="year_fi" value="" /><br />
			</span>
			<span id="confirmation" class="step">
				<span class="font_normal_07em_black">Dernière Etape - Optionnel</span><br />
				<label for="countryPrefix_fi">Numero de tel : </label><br />
				<input class="input_field_12em digits" name="phoneNumber" id="phoneNumber_fi" /><br />
				<label for="address">Adresse : </label><br />
				<input class="input_field_12em" name="address" id="address" /><br />
				<label for="ville">Ville : </label><br />
				<input class="input_field_12em" name="city" id="city" /><br />
				<label for="pays">Dans quel pays habitez-vous ?</label><br />
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
				
			</span>
		</div>
		<div id="demoNavigation"> 							
			<input class="navigation_button" id="back" value="Back" type="reset" />
			<input class="navigation_button" id="next" value="Next" type="submit"/>
		</div>
	</form>
	<hr />

	<p id="data"></p>

	<script type="text/javascript" src="<?php echo DIR_PUBLICS; ?>/js/jquery-1.4.2.min.js"></script>		
	<script type="text/javascript" src="<?php echo DIR_PUBLICS; ?>/js/jquery.form.js"></script>
	<script type="text/javascript" src="<?php echo DIR_PUBLICS; ?>/js/jquery.validate.js"></script>
	<script type="text/javascript" src="<?php echo DIR_PUBLICS; ?>/js/bbq.js"></script>
	<script type="text/javascript" src="<?php echo DIR_PUBLICS; ?>/js/jquery-ui-1.8.5.custom.min.js"></script>
	<script type="text/javascript" src="<?php echo DIR_PUBLICS; ?>/js/jquery.form.wizard.js"></script>

	<script type="text/javascript">
			$(function(){
				$("#demoForm").formwizard({ 
					formPluginEnabled: true,
					validationEnabled: true,
					focusFirstInput : true,
					formOptions :{
						success: function(data){
						$("#status").fadeTo(500,1,function(){ $(this).html("<h2>Vous êtes enregistré!</h2>").fadeTo(5000, 0); });
						$("#demoForm").fadeTo(200,0)},
						beforeSubmit: function(data){$("#data").html("stuff envoyer au serveur : " + $.param(data));},
						dataType: 'html',
						resetForm: true
					}	
				 }
				);
		});
	</script>
	
	<?php }
	elseif (ENV_TEST == 1){ ?>
	<form id="demoForm" method="post" action="" class="bbq">
	<input type="hidden" name="page" id="page" value="register">
		<div id="fieldWrapper">
			<span class="step" id="first">
				<span class="font_normal_07em_black">Etape 1</span><br />
				<label for="pseudo">Pseudo : </label><br />
				<input class="input_field_12em pseudo required" name="pseudo" id="pseudo" /><br />
				<label for="password">Password : </label><br />
				<input class="input_field_12em password required" name="password" id="password" type="password" /><br />
				<label for="retypePassword">Retype password : </label><br />
				<input class="input_field_12em retypePassword required" name="retypePassword" id="retypePassword" type="password" /><br />
				<label for="email">Email : </label><br />
				<input class="input_field_12em email required" name="email" id="email" /><br />
				<span class="font_normal_07em_black">Optionnel</span><br />
				<label for="nom">Nom : </label><br />
				<input class="input_field_12em" name="lastName" id="lastName" /><br />
				<label for="prenom">Prenom : </label><br />
				<input class="input_field_12em" name="firstName" id="firstName" /><br />
				<label for="day_fi">Date de naissance : </label><br />
				<input class="input_field_25em" name="day" id="day_fi" value="" /> -
				<input class="input_field_3em" name="month" id="month_fi" value="" /> - 
				<input class="input_field_3em" name="year" id="year_fi" value="" /><br />
				<label for="countryPrefix_fi">Numero de tel : </label><br />
				<input class="input_field_12em digits" name="phoneNumber" id="phoneNumber_fi" /><br />
				<label for="adresse">Adresse : </label><br />
				<input class="input_field_12em" name="adress" id="adress" /><br />
				<label for="ville">Ville : </label><br />
				<input class="input_field_12em" name="city" id="city" /><br />
				<label for="pays">Dans quel pays habitez-vous ?</label><br />
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
				
			</span>
		</div>
		<div id="demoNavigation"> 							
			<input class="navigation_button" id="back" value="Reset" type="reset" />
			<input class="navigation_button" id="next" value="Soumettre" type="submit"/>
		</div>
	</form>
	<?php } ?>
	<!--End of login page-->
	