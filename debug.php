<?php

function debug($msg)
{
    $msg = str_replace('"', '\\"', $msg); // Escaping double quotes
    echo "<script>console.log(\"$msg\")</script>";
}

?>