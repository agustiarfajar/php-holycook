<?php
function dbConnect()
{
    $db = new mysqli("localhost", "root", "", "holycook");
    if (!$db) {
        die("Koneksi Error");
    }

    return $db;
}
?>