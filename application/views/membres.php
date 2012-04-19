	<!--Start of home page-->
	<table border='1'>
		<th> Pseudo </th><th> Date d'inscription </th><th> Ajouter un ami </th>
	<?php
	foreach($membres as $key)
	{ ?>
		<tr>
			<td>
				<?php echo $key['Pseudo'] ?>
			</td>
			<td>
				<?php echo $key['RegisterDate'] ?>
			</td>
			<td>
			<?php if($key['Status'] == null)
			{
			?>
				<a href='index.php?page=membres.php&addFriend=<?php echo $key['IdUser'] ?>'>
					<img src='<?php echo DIR_PUBLICS; ?>/images/plusIcon.jpg'>
				</a>
			<?php
			}
			elseif($key['Status'] != 1)
			{
				echo "Demande envoyé";
			}
			else
			{
				echo "Déjà ami";
			}
			?>
			
			</td>
		</tr>
		<?php
	}
	?>
	</table>
	<!--End of home page-->
	