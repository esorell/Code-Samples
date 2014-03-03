<?php
	// always start the session, or the session variables won't work
	session_start();

	require_once( 'includes/login-connect.inc.php' );
	require_once( 'includes/login-functions.inc.php' );

	if( isset($_POST[ 'email' ] ) ){
		$error = login();
	}
?>
<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>Secured Page Example</title>
		<!--[if lt IE 9]>
		<script src="js/html5shiv.js"></script>
		<![endif]-->
	</head>
	<body>
		<?php echo $error; ?>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			<ol>
				<li>
					<label>Email:</label>
					<input type="email" name="email" value="<?php echo $_POST['email']; ?>" size="40" />
				</li>
				<li>
					<label>Password:</label>
					<input type="password" name="password" size="40" />
				</li>
				<li>
					<input type="submit" value="Sign In" />
				</li>
			</ol>
		</form>
	</body>
</html>