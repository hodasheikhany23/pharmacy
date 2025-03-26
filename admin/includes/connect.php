<?php
    defined('site') or die('Acces denied');

    $link = new mysqli("localhost", "root", "", "pharmacy_db");
    if ($link===false) {
        echo "Error: Unable to connect to MySQL." . PHP_EOL;
    }
    $link->query("set names utf8");
    mb_internal_encoding("UTF-8");

    function clean_id($id)
    {
        if (!is_numeric($id)) {
            die('Acces denied');
        }
        if ($id < 0) {
            die('Acces denied');
        }
    }
    function clean_data($value)
    {
        $value = trim($value);
        $value = str_replace('ي', 'ی', $value);
        $value = strip_tags($value);
        return $value;
    }
?>