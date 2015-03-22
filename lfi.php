<?php
	require('includes/functions.php');
	echo getHeader('Local File Inclusion');
?>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
        <div class="container">
            <h1>Local File Inclusion</h1>
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
				
				<h2>File Inclusion Vulnerability</h2>
				<span>A file inclusion vulnerability can allow an attacker to include a file, usually exploting a "dynamic file inclusion" mechanism that's implemented in the target web application. This vulnerabilit occues due the use of user-supplied input without the proper sanitization required.</span>
                <span>In this example, we will attempt to bring forth the system "passwd" file.</span>
				<br><br><br>
				<span>See the example page: <a href="/local-file-inclusion/example" target="_blank">Example</a></span>
				<br><br>
				<h4>PHP</h4>
				<pre>
					<code class="php">
&lt;?php

    if (isset($_GET['page'])) {
        echo include($_GET['page'] . '.php');
    } else {
        echo 'Please enter a GET page value, or click here for a example: <a href="/local-file-inclusion/example?page=movies">Click me! :)</a>';   
    }

?&gt;
					</code>
				</pre>
				Clicking on the default link attempts to take us to a <strong>movies.php</strong> file, which apparantly does not exist on the server. But the GET variable is only <strong>movies</strong>, so the script is appending on a .php extension to the GET variable before including that target file. This makes things more complex, as we cannot simply guess the file path and traverse the file system like so:
                <br><br>
                <h4>Theoretical URL</h4>
                <pre>
                    <code class="html">
<?php echo htmlentities('http://websec.michael-cunningham.ca/local-file-inclusion/example?page=../../../../etc/passwd'); ?>                 
                    </code>
                </pre>
                
                This would not work because the script will append a <strong>.php</strong> to the end of that GET variable as we already know. In order to bypass that string being appended, we need to use a null-byte terminator. In this case: <code>%00</code>. Since <code>%00</code> effectively represents the end of a string, any characters after this special byte will end up being ignored.
                <br><br>
                <h4>New! Theoretical URL</h4>
                <pre>
                    <code class="html">
<?php echo htmlentities('http://websec.michael-cunningham.ca/local-file-inclusion/example?page=../../../../etc/passwd%00'); ?>                 
                    </code>
                </pre>
                <br><br>
				<h4>Final Expected Output</h4>
				<pre>
					<code class="text">
root:x:0:0:root:/root:/bin/bash
bin:x:1:1:bin:/bin:/sbin/nologin
daemon:x:2:2:daemon:/sbin:/sbin/nologin
...
					</code>
				</pre>
				
                Now, obviously this exact example will only work on vulnerable Linux based systems.
				
				<h3>Solution</h3>
				
				To protect your web applications from vulnerabilities like these, use case/switch conditions to include pages rather than relying on the input specified by a user.
				
			</div>
		</div>

<?php
	echo getFooter();
?>