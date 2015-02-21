<?php

    if (isset($_GET['command'])) {
        system($_GET['command']);
    } else {
        echo 'Please enter a GET page value, or click here for a example: <a href="/arbitrary-code-execution/example?command=dir">Click me! :)</a>';   
    }

?>