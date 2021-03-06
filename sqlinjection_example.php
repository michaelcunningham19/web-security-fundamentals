<?php

    // -------------------- database variables
    $hostname  = 'localhost';  	  // MySQL server location
    $username  = 'root';          // username for connecting to database
    $password  = '';              // password to connect to database
    $database  = 'selfdirected';  // the database name itself
    $tablename = 'sqlinjection';  // the table in the database

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

        $sql = "SELECT userID FROM " . $tablename . " WHERE username ='" . $username . "' AND password ='" . $password . "'";

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
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SQL Injection</title>
	<!-- Bootstrap -->
	<link href="/assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="/assets/css/login.min.css" rel="stylesheet">
    
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
      <script src="/assets/js/html5shiv.min.js"></script>
      <script src="/assets/js/respond.min.js"></script>
    <![endif]-->
    
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
    <script src="/assets/js/jquery.min.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/assets/js/bootstrap.min.js"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script>
        /*!
         * IE10 viewport hack for Surface/desktop Windows 8 bug
         * Copyright 2014 Twitter, Inc.
         * Licensed under the Creative Commons Attribution 3.0 Unported License. For
         * details, see http://creativecommons.org/licenses/by/3.0/.
         */
        !function(){"use strict";if(navigator.userAgent.match(/IEMobile\/10\.0/)){var e=document.createElement("style");e.appendChild(document.createTextNode("@-ms-viewport{width:auto!important}")),document.querySelector("head").appendChild(e)}}();
    </script>
	
</body>
</html>