<?php

	// -------------------- password hashing salts
	define('SALT1', '53653@##@$');
	define('SALT2', '^%#+-%$ABf');

	// -------------------------------------------------------------------------------------------- begin logic

	// define the table used throughout this example
	define('TABLE_NAME', 'sqlinjection');

	// -------------------- database variables
	$hostname  = 'localhost';  	  // MySQL server location
	$username  = 'root';          // username for connecting to database
	$password  = '';              // password to connect to database
	$database  = 'selfdirected';  // the database name itself

	// connect to the database
    $con = mysqli_connect($hostname, $username, $password, $database);

    // Check connection
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

	// declare that by default, the user is not logged in... this example will not use cookies
	$isAdmin = false;
	$_SESSION['isAdmin'] = false;

	// if there is something posted.. that means a login attempt was made
	if (!empty($_POST)) {
        
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        // username: ' or ''='
        // password: ' or ''='
        
        $sql = "SELECT * FROM " . TABLE_NAME . " WHERE username ='" . $username . "' AND password ='" . $password . "'";
		
        $res     = mysqli_query($con, $sql);
		$row_cnt = mysqli_num_rows($res);
        
		if ($row_cnt > 0) {
			
			$isAdmin = true;
			$_SESSION['isAdmin'] = true;
			
		}
		
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>SQL Injection</title>
	<!-- Bootstrap -->
	<link href="/style/css/bootstrap.min.css" rel="stylesheet">
	<link href="/style/css/login.min.css" rel="stylesheet">
</head>
<body>
	
	<?php if (!$_SESSION['isAdmin']) { ?>
	<h3>You are a not an admin</h3>
	<?php } else { ?>
	<h3>You are an admin!</h3>
	<?php } ?>
	
	<div class="container">
		<div class="row">
			<div class="col-sm-6 col-md-4 col-md-offset-4">
				<div class="account-wall">
					<div id="my-tab-content" class="tab-content">
						<div class="tab-pane active" id="login">
							<img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120" alt="">
							<form class="form-signin" action="/sql-injection/example" method="post">
								<input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
								<input type="password" name="password" class="form-control" placeholder="Password" required>
								<input type="submit" class="btn btn-lg btn-default btn-block" value="Sign In">
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/style/js/bootstrap.min.js"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="/style/js/ie10-viewport-bug-workaround.min.js"></script>
	
</body>
</html>