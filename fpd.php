<?php
	require('includes/functions.php');
	echo getHeader('Full Path Disclosure');
?>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
        <div class="container">
            <h1>Full Path Disclosure</h1>
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
				
				<h2>Disclosing the full path of the website</h2>
				<span>This tutorial will be used to determine the full path of the file structure of a PHP website</span>
				<br><br><br>
				<span>See the example page: <a href="/full-path-disclosure/example" target="_blank">Example</a></span>
				<br><br>
				<h4>PHP</h4>
				<pre>
					<code class="php">
&lt;?php

    if (isset($_GET['page'])) {
        echo file_get_contents(getcwd() . '\\' . $_GET['page'] . '.php');
    } else {
        echo 'Please enter a GET page value, or click here for a example: <a href="/full-path-disclosure/example?page=test">Click me! :)</a>';   
    }

?&gt;
					</code>
				</pre>
				
				<h4>PHP Error Message</h4>
				<pre>
					<code class="php">
						<?php echo htmlentities('
Warning: file_get_contents(X:\xampp\htdocs\web-security-fundamentals\test.php): failed to open stream: No such file or directory in X:\xampp\htdocs\web-security-fundamentals\fpd_example.php on line 4
						'); ?>
					</code>
				</pre>
				
                Noticing from the error message, we found the full path where this website resides. In this case the website exists in "X:\xampp\htdocs\web-security-fundamentals", now, with this information we can guess where a configuration file would reside in the structure. Typically PHP developers will put configuration files either in the root of the site, or in an 'includes' folder. Ket's try messing with the 'page' GET variable by changing it to 'includes/config'. Notice how I did not include a file extension because in the PHP error message I noticed that the script appended '.php' directly to 'test'.
                
				<h4>Guessing a configuration file path</h4>
				<pre>
					<code class="php">
						<?php echo htmlentities('
http://web.sec/full-path-disclosure/example?page=includes\config
						'); ?>
					</code>
				</pre>
                
                You recieved a blank page.. what if you view the page source?
				<h4>Super secret secure information :D</h4>
				<pre>
					<code class="php">
&lt;?php

/**
 * Example dummy config file which is used for the Full Path Disclosure vulnerability example
 *
 */

$database = 'DATABASENAME';
$username = 'USERNAME';
$password = 'PASSWORD';
$server   = 'SERVER';

?&gt;
					</code>
				</pre>
                
                We have successfully gathered all database connection credentials for this web application...bad things can be done with this information.
				
				<h3>Solution</h3>
				
				To protect your application from full path disclosure vulnerabilities, simply turn PHP error reporting off in PHP.ini :) By turning off error reporting we can protect the file structure from being displayed publically. However, that will not protect the web application itself as an attacker could still wildly guess without any prior knowledge. Proper, secure PHP programming is highly recommended.
				
				<pre>
					<code class="php">
error_reporting(0);
					</code>
				</pre>
				
			</div>
		</div>

<?php
	echo getFooter();
?>