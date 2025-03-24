<?php
    defined('site') or die('Acces denied');

    $link = mysqli_connect("localhost", "root", "", "pharmacy_db");
    if ($link===false) {
        echo "Error: Unable to connect to MySQL." . PHP_EOL;
    }
    $link->query("set names utf8");
?>