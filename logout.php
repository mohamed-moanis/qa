<?php
session_start();

if (isset($_SESSION['user_id']))
{
    // remove all session variables
    session_unset();

    // destroy the session
    session_destroy();
}

header('url=http://localhost/qa/index.php');
?>
