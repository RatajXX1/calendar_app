<?php
require_once '../session.php';

$page = (isset($_GET['ID']) ? $_GET['ID'] : 0);

if (enter_to_view_by_rank(2) && is_numeric($page)) {
    require_once '../utilis/config.php';
    $con = make_con();
    $user_id = get_user_id_by_ses($con);
    $resoult = $con->query("Select ID from Users where ID = " . $page );
    if ($resoult->num_rows == 0) {
        echo 'Brak uztykownika';
    } else {
        $con->query("Update Users SET Force_pass = 1 where ID = " . $page);
        echo 'OK';
    }
    $con->close();
}