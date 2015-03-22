<?php

    if (isset($_GET['page'])) {
        echo include($_GET['page'] . '.php');
    } else {
        echo 'Please enter a GET page value, or click here for a example: <a href="/local-file-inclusion/example?page=movies">Click me! :)</a>';   
    }

?>