<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>My News View</title>

	<base href="<?php echo $this->config->item('base_url') ?>www/" />
	<link rel="stylesheet" href="css/newshack.css" type="text/css" media="screen" />
	<script src="js/jquery-1.9.1.js"></script>

</head>
<body>

<div id="container">
	<h1>My News View</h1>

	<div id="body">
		<p>Please Enter your Twitter ID:</p>

		<?php 

		echo form_open('Welcome/tags');
		echo form_input('username', 'Username');
		echo (': ');
		echo form_submit('submit', 'Go');
		echo form_close();
		?>

	</div>

</div>

</body>
</html>