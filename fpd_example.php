<?php

    if (isset($_GET['page'])) {
        echo file_get_contents(getcwd() . '/' . $_GET['page'] . '.php');
    } else {
        echo 'Please enter a GET page value, or click here for a example: <a href="/full-path-disclosure/example?page=test">Click me! :)</a>';   
    }

?>