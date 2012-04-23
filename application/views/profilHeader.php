<?php
switch($layoutAdd)
{
	case "0":
		$active[0]= " class='active'";
		$active[1]= "";
		$active[2]= "";
		$active[3]= "";
		break;
	case "1":
		$active[0]= "";
		$active[1]= " class='active'";
		$active[2]= "";
		$active[3]= "";
		break;
	case "2":
		$active[0]= "";
		$active[1]= "";
		$active[2]= " class='active'";
		$active[3]= "";
		break;
	case "3":
		$active[0]= "";
		$active[1]= "";
		$active[2]= "";
		$active[3]= " class='active'";
		break;
}
		echo"
			<div class='row-4'>
				<div class='fright'>
					<ul>
						<li><a href='/WeShare/profil/'".$active[0]."><em><b>Profil</b></em></a></li>
						<li><a href='/WeShare/edit/'".$active[1]."><em><b>Edition du profil</b></em></a></li>
						<li><a href='/WeShare/amis/'".$active[2]."><em><b>Amis</b></em></a></li>
						<li><a href='/WeShare/films/'".$active[3]."><em><b>Mes films</b></em></a></li>
					</ul>
				</div>
			</div>";