<?php
    defined('site') or die('Acces denied');
    date_default_timezone_set("Asia/Tehran");

$link = new mysqli("localhost", "root", "", "pharmacy_db");
    if ($link===false) {
        echo "Error: Unable to connect to MySQL." . PHP_EOL;
    }
    $link->query("set names utf8");
    mb_internal_encoding("UTF-8");

    function clean_id($id)
    {
        if (!is_numeric($id)) {
            die('Access denied');
        }
        if ($id < 0) {
            die('Access denied');
        }
        return $id;
    }
    function clean_data($value)
    {
        $value = trim($value);
        $value = str_replace('ي', 'ی', $value);
        $value = strip_tags($value);
        return $value;
    }
?>