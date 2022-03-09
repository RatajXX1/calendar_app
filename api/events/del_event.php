<?php

require_once '../session.php';

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
    $resoult = $con->query("Select calendar_id from events where ID = " . $page);
    if ($resoult->num_rows == 0) {
        echo 'Brak kalendarza';
    } else {
        $resoult = $con->query("Select Cal_ID from Calendars_perm where User_id = " . $user_id);
        if ($resoult->num_rows == 0) {
            echo 'Nie masz uprawnień do tego kalendarza'; 
        } else {
            $con->query("Delete from events where ID = " . $page );
            echo 'OK';            
        }
    }
    $con->close();
}