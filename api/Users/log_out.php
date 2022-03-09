<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once  dirname(__DIR__) . '/session.php';

if (enter_to_view()) {
    require_once dirname(__DIR__) . '/utilis/config.php';
    $con = make_con();
    $user_id = get_user_id_by_ses($con);
    if ($user_id == NULL) {
        echo 'Error 120';
        return 0;
    }
    clear_ses_user($user_id, $con);
    unset($_COOKIE['Ses_id']); 
    setcookie('Ses_id', null, -1, '/'); 
    echo 'ok';
    $con->close();
} else echo 'xd';