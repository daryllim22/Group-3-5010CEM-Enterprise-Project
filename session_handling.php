<?php

    //start the session with the logged in user
    session_start();

    if (isset($_SESSION['userID'])) {
        //retrieving the user ID from the session
        $userID = $_SESSION['userID'];
    }
    else {
        //userID set to null if user is viewing as a guest
        $userID = null;
    }

?>