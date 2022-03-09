<?php

require_once  '../session.php';

$page = (isset($_GET['ID']) ? $_GET['ID'] : 0);

if (enter_to_view() && is_numeric($page)) {
    require_once '../utilis/config.php';
    $con = make_con();
    $user_id = get_user_id_by_ses($con);
    if ($user_id == NULL) {
        $con->close();
        echo "error 3";
        exit();
    }
    $resoult = $con->query("Select Owner from Calendars where Cal_ID = " . $page . " and Owner = " . $user_id);
    if ($resoult->num_rows == 0) {
        echo 'Brak kalendarza';
    } else {
        // $con->query("Delete from Calendars where Cal_ID = " . $page . " and Owner = " . $user_id);
        $con->query("Delete from Calendars_perm where User_id = " . $page );
        echo 'OK';
    }
    $con->close();
}