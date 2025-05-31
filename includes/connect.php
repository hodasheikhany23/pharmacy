<?php
    defined('site') or die('Acces denied');
    date_default_timezone_set("Asia/Tehran");

    $link = new mysqli("localhost", "root", "", "pharmacy_db");
    if ($link===false) {
        echo "Error: Unable to connect to MySQL." . PHP_EOL;
    }
    $link->query("set names utf8");
    mb_internal_encoding("UTF-8");
    require_once "time/jdf.php";
    function clean_id($id)
    {
        if (!is_numeric($id)) {
            die('Acces denied');
        }
        if ($id < 0) {
            die('Acces denied');
        }
        return $id;
    }
    function dateFormat($value){
        $value=jdate('d F Y',$value);
        return $value;
    }
    function clean_data($value)
    {
        $value = trim($value);
        $value = str_replace('ي', 'ی', $value);
        $value = strip_tags($value);
        return $value;
    }
    if(isset($_SESSION['user_id']) && $_SESSION['is_admin'] == 1){
        $perm=[];
        $role = $link->query("SELECT * FROM admin_role WHERE ar_user_id = '".$_SESSION['user_id']."'");
        while($row_role = $role->fetch_assoc()) {
            $perm[] = $row_role['ar_permission_id'];
        }
    }

?>