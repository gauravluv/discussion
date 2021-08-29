


<?php

session_start();
echo "Logging you out. Please wait...";

session_destroy();
header("Location: /onlineforum/index.php");
?>




