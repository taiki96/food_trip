<?php
header("Content-Type: ".$_SESSION['image_type']);
echo $_SESSION['image_data'];
?>