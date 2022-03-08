<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once  '../session.php';

$page = (isset($_GET['ID']) ? $_GET['ID'] : 0);

if (enter_to_view_by_rank(2) && is_numeric($page)) {
    require_once  '../utilis/config.php';
    $con = make_con();
    $user_id = get_user_id_by_ses($con);
    // echo $page;
    $resoult = $con->query("Select ID from Users where ID = " . $page );
    if ($resoult->num_rows == 0) {
        echo 'Brak uztykownika';
    } else {
        $con->query("Delete from Users where ID = " . $page);
        echo 'OK';
    }
    $con->close();
} else echo 'XD';