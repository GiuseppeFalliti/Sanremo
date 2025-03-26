<?php
session_start();
session_unset(); //deallocare
session_destroy(); //distruggere
header("Location: index.php");
exit();
?>
