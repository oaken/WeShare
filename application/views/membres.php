	<!--Start of home page-->
	<table border='1'>
		<th> Pseudo </th><th> Date d'inscription </th><th> Ajouter un ami </th>
	<?php
	foreach($membres as $key)
	{ ?>
		<tr>
			<td>
				<a href='/WeShare/Membres/<?php echo $key['Pseudo']; ?>/'><?php echo $key['Pseudo'] ?></a>
			</td>
			<td>
				<?php echo $key['RegisterDate'] ?>
			</td>
			<td>
			<?php 	/* status : null : pas d'entr�
								0 : demande envoy�
								1 : demande accept�
								2 : demande refus�
								3 : demande ignor�
					*/
			if($key['Status'] == null)
			{
			?>
				<a href='/WeShare/Membres/AddFriend/<?php echo $key['IdUser'] ?>/'>
					<img src='<?php echo DIR_PUBLICS; ?>/images/plusIcon.jpg'>
				</a>
			<?php
			}
			elseif($key['Status'] == 0 || $key['Status'] == 2 || $key['Status'] == 3)
			{
				echo "Demande envoy�";
			}
			elseif($key['Status'] == 1)
			{
				echo "D�j� ami";
			}
			?>
			
			</td>
		</tr>
		<?php
	}
	?>
	</table>
	<!--End of home page-->
	