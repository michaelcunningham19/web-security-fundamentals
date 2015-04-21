<?php
	require('includes/functions.php');
	echo getHeader('Buffer Overflow');
?>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
        <div class="container">
            <h1>Buffer Overflow</h1>
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
				
				<h2>Conducting buffer overflow attacks on a server</h2>
				<span>A buffer overflow attack seeks to overflow the memory allocation buffer inside your PHP application or, more seriously, in Apache or the underlying operating system.</span>
                <br><br>
                <span>The buffer overflow vulnerability that will be displayed will be outlined was an active, critical bug in PHP 5.4 which was patched within 3 days of its exposure.</span><br>
                <small>Source: <a target="_blank" href="https://bugs.php.net/bug.php?id=60965">https://bugs.php.net/bug.php?id=60965</a></small>
				<br><br><br>
				<span>See the example page: <a href="/buffer-overflow/example" target="_blank">Example</a></span>
				<br><br>
				<h4>PHP</h4>
				<pre>
					<code class="php">
&lt;?php

// Source: https://bugs.php.net/bug.php?id=60965
// This has been patched.
echo htmlspecialchars('"""""""""""""""""""""""""""""""""""""""""""""&#x000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000005;',
ENT_QUOTES, 'UTF-8', false), "\n";

					</code>
				</pre>
                <small>Source: <a href="https://bugs.php.net/bug.php?id=60965">https://bugs.php.net/bug.php?id=60965</a></small>
                
                <br><br>
				
				<h4>Result</h4>
                <span>On affected versions of PHP 5.4, "Long entities can cause a buffer overflow because the loop only guarantees 40 bytes available in beginning."</span>
                <br>
                <span>It is a reproducible crash of PHP itself which can lead to information disclosure as it dumps all sorts of error messages when it crashes.</span>
                <br>
                <small>Source: <a href="https://bugs.php.net/bug.php?id=60965">https://bugs.php.net/bug.php?id=60965</a></small>
                
                <br><br>
                
                <span>This reproducible crash could be exploited remotely, or internally as well depending if your web application has different types of vulnerabilites already in it. A server side script handler which takes POST'ed data from a form usually uses the affected <code>htmlspecialchars()</code>, and a specially crafted input could completely crash the PHP application server running on the web server.</span>
                
				<h3>Solution</h3>
				
				To protect our web applications from this vulnerability plus any others like it, keep your PHP installation up-to-date!
				
			</div>
		</div>

<?php
	echo getFooter();
?>