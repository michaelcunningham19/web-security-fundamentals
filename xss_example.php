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
	header('Location: xss_example.php');
}

// fetch all posts
$stmt = $pdo->query('SELECT * FROM xss');

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>XSS Example</title>
	<!-- Bootstrap -->
	<link href="/style/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	
	<div class="container">

		<h1>Guestbook! :)</h1>
		<hr>
		<br><br>
		<h3>Add a new post!</h3>
		<form action="xss_example.php" method="post">
			<textarea name="message" rows="4" cols="50"></textarea><br>
			<button type="submit">Submit</button>

		</form>

		<hr>
		<br>

		<h3>Existing Posts</h3>
		<hr>

		<?php if ($stmt->rowCount() > 0) { ?>
		<?php while($row = $stmt->fetch()) { ?>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/style/js/bootstrap.min.js"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="/style/js/ie10-viewport-bug-workaround.min.js"></script>
	
</body>
</html>