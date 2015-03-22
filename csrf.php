<?php
	require('includes/functions.php');
	echo getHeader('Cross-Site Request Forgery');
?>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
        <div class="container">
            <h1>Cross-Site Request Forgery</h1>
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
				
				<h2>Request Forgery</h2>
				<span>Cross-Site Request Forgery (CSRF) is a type of attack that occurs when malicious code is executed without the users knowledge. Typically as a result of social engineering, or another type of hack on a web application which places malicious content to be clicked on.</span>
                <span>The impact of CSRF can vary depending of the type of website it is discovered on. If a vulnerability is discovered on a bank's website for example, it could mean your personal money is at risk.</span>
				<br><br>
				<h4>HTML</h4>
				<pre>
					<code class="html">
						<?php echo htmlentities('
<form action="http://somecrappybank.com/accounts/transfer.do" method="post">
    <input type="hidden" name="accountID" value="84673448383">
    <input type="hidden" name="amount" value="500">
    <input type="submit" value="View this cute cat video!">
</form>
						'); ?>
					</code>
				</pre>
				
                <span>There is a small window of opportunity for this attack to work, the attacker must know that the user is currently signed into this bank's website, and must know rougly the amount of money is in the user's account, so the attacker should start out small, with <strong>500</strong> being transferred to the attackers account <strong>84673448383</strong>. </span>
                <br>
                <span>Now, to trick the user into clicking this button, we need to either hack one of their most frequent websites, or instead go phishing and send a malicious e-mail. Both of these methods require information you may not have, such as the user's frequent websites and/or their e-mail address.</span><br><br>
                
                <h4>Why can this happen?</h4>
                <span>You might think that this is a massive vulnerability and why it is so easy to exploit. It really is up to the developers for the most part to make secure websites, although the end-users can help protect themselves as well.</span><br><br>
                <h4>How can the user protect themselves?</h4>
                <br>
                <ul>
                    <li>Logoff immediately after using a Web application</li>
                    <li>Do not allow your browser to save username/passwords, and do not allow sites to "remember" your login</li>
                    <li>Do not use the same browser to access sensitive applications and to surf the Internet freely (tabbed browsing).</li>
                    <li>The use of plugins such as No-Script makes POST based CSRF vulnerabilities difficult to exploit. This is because JavaScript is used to automatically submit the form when the exploit is loaded. Without JavaScript the attacker would have to trick the user into submitting the form manually.</li>
                </ul>
                <small>Source: <a href="https://www.owasp.org/index.php/Cross-Site_Request_Forgery_%28CSRF%29_Prevention_Cheat_Sheet#Client.2FUser_Prevention">OWASP CSRF Cheat Sheet</a></small>
                
                <br><br>
                <h4>How can the developer protect their web applications?</h4>
                <br>
                <span>
                    The developer can protect their apps by denying requests from sources other than the website itself. Origin HTTP Headers are sent with every request which shows where the request originated from. Example: A website, <strong>www.superhightechwebsite.com</strong>, has a form with a server side element which the developer wants the server side function to work if the request came from <strong>www.superhightechwebsite.com</strong>. Without Origin HTTP headers, any form could be created with the same input names and action URL which would POST or GET data to the form on <strong>www.superhightechwebsite.com</strong>
                </span>
                <br><br>
                <span>Other solutions for developers include:</span>
                <ul>
                    <li>Add a per-request nonce to the URL and all forms in addition to the standard session. This is also referred to as "form keys". Many frameworks (e.g., Drupal.org 4.7.4+) either have or are starting to include this type of protection "built-in" to every form so the programmer does not need to code this protection manually.</li>
                    <li>Add a hash (session id, function name, server-side secret) to all forms.</li>
                    <li>For .NET, add a session identifier to ViewState with MAC</li>
                </ul>
                <small>Source: <a href="https://www.owasp.org/index.php/Cross-Site_Request_Forgery_%28CSRF%29_Prevention_Cheat_Sheet#Client.2FUser_Prevention">OWASP CSRF Cheat Sheet</a></small>
			</div>
		</div>

<?php
	echo getFooter();
?>