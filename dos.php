<?php
	require('includes/functions.php');
	echo getHeader('Denial of Service');
?>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
        <div class="container">
            <h1>Denial of Service</h1>
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
				
				<h2>The Denial of Service (DoS) attack is focused on making a resource unavailable.</h2>
				<span>There is no example for this vulnerability, as I do not want this running on my server!</span>
                <br>
                <span>If users supply a value which is used in a loop anywhere in the code, the developer needs to be very careful in how they trust the user data. A proper implementation would be to not trust the user data at all. See the block of code below:</span>
				<br><br><br>
				<h4>PHP</h4>
				<pre>
					<code class="php">
&lt;?php

    $counterLimit = $_GET['limit'];
    for ($i = 0; $i < $counterLimit; $i++) {
        // lots of logic to process the request
    }

?&gt;
					</code>
				</pre>
                <br><br>
                <span>If the user supplies an insane number such as 999999999999999999999999999, this will cause some performance issues on the server, especially if it's a resource intensive loop. Some developers will help protect against this by doing client-side JavaScript validation however that can easily be bypassed. Ultimately this vulnerability will cause a DoS condition.</span>
				<br><br>
                <span>Another User Specified Vulnerability is Object Allocation, where the user supplies the value of the length of an array of complex objects.</span>
				<h4>PHP</h4>
				<pre>
					<code class="php">
&lt;?php

    $array = array();

    for ($i = 0; $i < $_GET['length']; $i++) {
        array_push($array, new ComplexThing());
    }

?&gt;
					</code>
				</pre>
                
                <span>This can obviously cause performance and memory issues on the server which can take down a website.</span>
                <br>
                <h4>DoS: Storing too Much Data in Session</h4>
                <span>Session objects should be kept light, no extreme amounts of data should be kept in the users session. If database results or other large objects are stored, that means those objects were probably generated dynamically, which could have been created as a result of an unprotected loop counter (see above). If the server didn't crash with a giant loop counter, then it probably will crash when that resultant object is stored in the user's session.</span>
                
                <h3>Solution</h3>
                
                Care must be taken in where the user has control in the code behind the web application. Never trust any user data, sanitize and enforce length rules wherever possible. One of the biggest bottlenecks in a web application is the database. Reducing the amount of control the user has in generating these SQL queries is crucial. Caching data and filtering cached data is generally a lot quicker than a fresh query from the database with limits and rules set by the user from an HTML form.
				
			</div>
		</div>
<?php
	echo getFooter();
?>