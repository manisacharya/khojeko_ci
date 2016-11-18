<?php echo doctype('html5');?>

<html lang="en">
<head>
	<title>List of Dealer</title>
</head>

<body>
	<?php
		foreach ($dealer_list as $one) {
			echo '
				<a href="'.base_url().'dealer/'.$one->khojeko_username.'/All">Dealer : '.$one->khojeko_username.'</a><br />';
		}

		echo '<br /><a href="'.base_url().'heirarchy">Heirarchy</a><br />';
		echo '<br />USERS<br />';

        foreach ($users_list as $one) {
			echo '
				<a href="'.base_url().'upanel/'.$one->khojeko_username.'/All">User : '.$one->khojeko_username.'</a><br />';
		}
	?>
</body>
</html>