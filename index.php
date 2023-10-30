<?php
    require("session_handling.php");

    //userID value assigned in `session_handling.php`
    if ($userID != null) {
        include("index_userview.php");
    }
    else {
        include("index_guestview.php");
    }
?>