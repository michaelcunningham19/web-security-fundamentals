<?php

session_start();

// attempt to connect to the database
try {

	$pdo = new PDO('mysql:host=localhost;dbname=selfdirected', 'root', '');
	
	$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch (PDOException $ex) {
    echo $ex->getMessage();
    die('Critical Database Error Occured');
}

// did the user just try to add a post?
if (isset($_POST['message'])) {
	$stmt_add = $pdo->prepare('INSERT INTO xss (postID, message) VALUES (DEFAULT, :message)');
	$stmt_add->bindValue(':message', $_POST['message'], PDO::PARAM_STR);
	$stmt_add->execute();
	
	// prevent accidental resubmission via refresh
	header('Location: /cross-site-scripting/example');
}

// fetch all posts
$stmt = $pdo->query('SELECT * FROM xss');

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>XSS Example</title>
	<!-- Bootstrap -->
	<link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
      <script src="/assets/js/html5shiv.min.js"></script>
      <script src="/assets/js/respond.min.js"></script>
    <![endif]-->
</head>
<body>
	
	<div class="container">

		<h1>Guestbook! :)</h1>
		<hr>
		<br><br>
		<h3>Add a new post!</h3>
		<form action="/cross-site-scripting/example" method="post">
			<textarea name="message" rows="4" cols="50"></textarea><br>
			<button type="submit">Submit</button>

		</form>

		<hr>
		<br>

		<h3>Existing Posts</h3>
		<hr>

		<?php if ($stmt->rowCount() > 0) { ?>
		<?php while ($row = $stmt->fetch()) { ?>
		<span>Post ID: <?php echo $row['postID']; ?></span><br>
		<span>Post Content: 
			<?php echo $row['message']; ?>
		</span>
		<br><br><br>
		<?php } ?>
		<?php } else { ?>
		<h6>No entries found in database.</h6>
		<?php } ?>
	
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