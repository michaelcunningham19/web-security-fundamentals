<?php
	require('includes/functions.php');
	echo getHeader('SQL Injection');
?>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
        <div class="container">
            <h1>SQL Injection</h1>
			<a class="btn btn-primary btn-lg" href="/">
				<span class="glyphicon glyphicon-chevron-left"></span>
				Back To Home
			</a>
        </div>
    </div>

    <div class="container">
        <!-- Example row of columns -->
        <div class="row">
            <div class="col-md-12">
				
				<h2>Bypassing User Login</h2>
				<span>This tutorial will show how to bypass the login screen for an insecure PHP application :)</span>
				<br><br><br>
				<span>See the example login screen: <a href="/sql-injection/example" target="_blank">Example Login Screen</a></span>
				<br><br>
				<h4>PHP</h4>
				<pre>
					<code class="php">
&lt;?php

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

?&gt;
					</code>
				</pre>
				
				<h4>HTML</h4>
				<pre>
					<code class="html">
						<?php echo htmlentities('
<!DOCTYPE html>
<html lang="en">
<head>
	<title>SQL Injection</title>
	<!-- Bootstrap -->
	<link href="/style/css/bootstrap.min.css" rel="stylesheet">
	<link href="/style/css/login.min.css" rel="stylesheet">
</head>
<body>
	
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
	
    <!-- jQuery (necessary for Bootstraps JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/style/js/bootstrap.min.js"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="/style/js/ie10-viewport-bug-workaround.min.js"></script>
	
</body>
</html>
						'); ?>
					</code>
				</pre>
				
                This is a basic administration panel which will accept a username and password... pretty simple :) Using some specially crafted input, we can attempt to 'trick' the database into returning a result that the PHP script will interpret as a successful login
				<br><br>
                <div class="col-md-12">
                    
                    <div class="col-md-6">
                        <img class="well" src="content/sql-injection/example.png">
                    </div>
                    
                    <div class="col-md-6">
You input the following into the username and password fields: ' or ''=' and because the SQL statement is simply concatenated POST variables with no sanitization, MySQL will always return true on the '=' statement.
                    </div>
                    
                </div>
				
				<h3>Solution</h3>
				
				To protect your web application's login page or any other user input, it is extremely recommended to use paramterized queries.
                Here's an example:
				
				<pre>
					<code class="php">
                        $stmt = $dbh->prepare("SELECT * FROM " . TABLE_NAME . " WHERE username = :username AND password = :password");
                        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
                        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
                        $stmt->execute();
					</code>
				</pre>
				
			</div>
		</div>

<?php
	echo getFooter();
?>