<?php
	require('includes/functions.php');
	echo getHeader('Homepage');
?>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
        <div class="container">
            <h1>Web Security Fundamentals</h1>
        </div>
    </div>

    <div class="container">
        <!-- Example row of columns -->
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-4">
                    <h2>XSS Cross Site Scripting</h2>
                    <p>Cross-Site Scripting (XSS) attacks are a type of injection, in which malicious scripts are injected into otherwise benign and trusted web sites. XSS attacks occur when an attacker uses a web application to send malicious code.</p>
                    <p><a class="btn btn-default" href="#" role="button">View demonstration &raquo;</a>
                    </p>
                </div>
                <div class="col-md-4">
                    <h2>SQL Injection</h2>
                    <p>A SQL injection attack consists of insertion or "injection" of a SQL query via the input data from the client to the application.</p>
                    <p><a class="btn btn-default disabled" href="#" role="button">View demonstration &raquo;</a>
                    </p>
                </div>
                <div class="col-md-4">
                    <h2>Full Path Disclosure</h2>
                    <p>Full Path Disclosure (FPD) vulnerabilities enable the attacker to see the path to the webroot/file.</p>
                    <p><a class="btn btn-default disabled" href="#" role="button">View demonstration &raquo;</a>
                    </p>
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-4">
                    <h2>Arbitrary Code Execution</h2>
                    <p>Arbitrary Code Execution is used to describe an attacker's ability to execute any commands of the attacker's choice on a target machine or in a target process.</p>
                    <p><a class="btn btn-default disabled" href="#" role="button">View demonstration &raquo;</a>
                    </p>
                </div>
                <div class="col-md-4">
                    <h2>Denial Of Service Attack (DoS)</h2>
                    <p>In computing, a denial-of-service (DoS) or distributed denial-of-service (DDoS) attack is an attempt to make a machine or network resource unavailable to its intended users.</p>
                    <p><a class="btn btn-default disabled" href="#" role="button">View demonstration &raquo;</a>
                    </p>
                </div>
                <div class="col-md-4">
                    <h2>Cross-site request forgery</h2>
                    <p>Cross-site request forgery, also known as a one-click attack or session riding and abbreviated as CSRF (sometimes pronounced sea-surf) or XSRF, is a type of malicious exploit of a website whereby unauthorized commands are transmitted from a user that the website trusts.</p>
                    <p><a class="btn btn-default disabled" href="#" role="button">View demonstration &raquo;</a>
                    </p>
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-4">
                    <h2>Data Breach</h2>
                    <p>A data breach is the intentional or unintentional release of secure information to an untrusted environment. Other terms for this phenomenon include unintentional information disclosure, data leak and also data spill.</p>
                    <p><a class="btn btn-default disabled" href="#" role="button">View demonstration &raquo;</a>
                    </p>
                </div>
                <div class="col-md-4">
                    <h2>Arbitrary file inclusion</h2>
                    <p>File inclusion vulnerability is a type of vulnerability most often found on websites. It allows an attacker to include a file, usually through a script on the web server.</p>
                    <p><a class="btn btn-default disabled" href="#" role="button">View demonstration &raquo;</a>
                    </p>
                </div>
                <div class="col-md-4">
                    <h2>Local file inclusion</h2>
                    <p>Local File Inclusion (also known as LFI) is the process of including files, that are already locally present on the server, through the exploiting of vulnerable inclusion procedures implemented in the application.</p>
                    <p><a class="btn btn-default disabled" href="#" role="button">View demonstration &raquo;</a>
                    </p>
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-4">
                    <h2>Remote file inclusion</h2>
                    <p>Remote File Include (RFI) is an attack technique used to exploit "dynamic file include" mechanisms in web applications. When web applications take user input (URL, parameter value, etc.) and pass them into file include commands, the web application might be tricked into including remote files with malicious code.</p>
                    <p><a class="btn btn-default disabled" href="#" role="button">View demonstration &raquo;</a>
                    </p>
                </div>
                <div class="col-md-4">
                    <h2>Buffer overflow</h2>
                    <p>In computer security and programming, a buffer overflow, or buffer overrun, is an anomaly where a program, while writing data to a buffer, overruns the buffer's boundary and overwrites adjacent memory. This is a special case of violation of memory safety.</p>
                    <p><a class="btn btn-default disabled" href="#" role="button">View demonstration &raquo;</a>
                    </p>
                </div>
                <div class="col-md-4">
                    <h2>Other code injection</h2>
                    <p>Code injection is the exploitation of a computer bug that is caused by processing invalid data. Code injection can be used by an attacker to introduce (or "inject") code into a computer program to change the course of execution. The results of a code injection attack can be disastrous. For instance, code injection is used by some computer worms to propagate.</p>
                    <p><a class="btn btn-default disabled" href="#" role="button">View demonstration &raquo;</a>
                    </p>
                </div>
            </div>


        </div>
<?php
	echo getFooter();
?>