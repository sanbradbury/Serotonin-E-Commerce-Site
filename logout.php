<?php 
session_start();

//unset and destroy the session
session_unset();
session_destroy();

//redirect the user
header("Location: index.php");
exit();

?>