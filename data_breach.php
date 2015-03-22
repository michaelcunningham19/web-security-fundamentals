<?php
	require('includes/functions.php');
	echo getHeader('Data Breaches');
?>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
        <div class="container">
            <h1>Data Breaches</h1>
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
				
				<h2>Data Breaches - Release of secure information</h2>
				<span>Revealing system dta or debugging information can help an attacker learn about the target system, and develop a plan of attack. An 'information leak' occurs when system data and/or debugging information leaves the program in question through an output stream or similar logging function.</span><br><br>
				<h4>Example: Java Applet</h4>
				<pre>
					<code class="java">
try {
    ...
} catch (Exception e) {
    e.printStackTrace();
}
					</code>
				</pre>
                Depending on the configuration of the target system, the information which is printed from this caught exception cought be written to a log file, or blatantly exposed to the attacker. In some cases, the resultant error message can tell the attacker precisely what sort of an attack the system will be vulnerable to, be it an SQL injection if the error is SQL or database related, or other messages can show more clues about the system in question such as the operating system it runs, or some of the modules or applications running on it.
                <br><br>
                <span><small>Source: <a target="_blank" href="https://www.owasp.org/index.php/Information_Leakage">Information Leakage - OWASP</a></small></span>
                <br><br>
				<h4>Example: phpinfo()</h4>
                <span>When developing a website in PHP, testing functionality, or moving the application from one server to another, a developer or system administrator may put a typical 'info.php' file inside the root of the website's accessible folder, which contains the following PHP code:</span>
                <pre>
                    <code class="php">
&lt;?php

    echo phpinfo();

?&gt;
                    </code>
                </pre>
                <br>
                This powerful phpinfo() functions dumps information about the server's operaitng system, current php.ini values, all loaded modules, and even more information. Developers need to make sure that they delete this file as soon as they are finished using it. For example, a curious attacker could try to load it, assuming the filename is the typical <strong>info.php</strong>: <code>http://example.com/info.php</code>
                <br>
                <br>
                <h4>Accidental Leaking of Sensitive Info</h4>
                Accidental data leakage occurs in several places and can simply be defined as unnessecary data leakage. Any information that is not nessecary to the functionality of the system should be removed in order to lower both the server load, and the possibility of sensitive data being outputted.
                <br>
                <pre>
                    <code class="php">
Warning: mysql_pconnect(): 
Access denied for user: 'root@localhost' (Using password: N1nj4) in /usr/local/www/wi-data/includes/database.inc on line 4
                    </code>
                </pre>
                An example MySQL error message. This error message reveals crucial data such as the attempted password, username, server location, and the some file structure of the website.
                <br><br>
                
                <span><small>Source: <a target="_blank" href="https://www.owasp.org/index.php/Information_Leakage">Information Leakage - OWASP</a></small></span>
                <br><br>
                
                <h4>Possible Solutions and Techniques</h4>
                <ul>
                    <li>Always make sure to wrap your code blocks with try and catch blocks, and ensure that all exceptions are properly handled so that no unnessecary data is output to the user.</li>
                    <li>Enable custom error pages for all potential errors on your website. This not only improves security but improves site navigation to the end user.</li>
                </ul>
                
			</div>
		</div>

<?php
	echo getFooter();
?>