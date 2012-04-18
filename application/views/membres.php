	<!--Start of home page-->
	<table border='1'>
		<th> Pseudo </th><th> Date d'inscription </th>
	<?php
	foreach($membres as $key)
	{ ?>
		<tr>
			<td><?php echo $key['Pseudo'] ?></td>
			<td><?php echo $key['RegisterDate'] ?></td>
			<td><a href='index.php?page=membres.php&addFriend=<?php echo $key['IdUser'] ?>'>
			<img src='<?php echo DIR_PUBLICS; ?>/images/plusIcon.jpg'></a></td>
		</tr>
		<?php
	}
	?>
	</table>
	<!--End of home page-->
	