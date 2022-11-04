<?php

    session_start();
    
    
    if (isset($_SESSION["username"])) {
        http_response_code(200);
        echo $_SESSION["username"];
    
    } else {
       http_response_code(406);
    }
