<?php

require_once  '../session.php';
// 1 who have permission  2 who not have permission
// $perm_mode =  (isset($_GET['mode']) ? $_GET['mode'] : 1);
// $cal_id =  (isset($_GET['id']) ? $_GET['id'] : NULL);
$page = (isset($_GET['page']) ? $_GET['page'] : 0);


if (enter_to_view() && is_numeric($page)) {
    require_once  '../utilis/config.php';
    if ($page > 0) $page -= 1;
    $page = $offset_page * $page;
    $con = make_con();
    $user_id = get_user_id_by_ses($con);
    if ($user_id == NULL) {
        $con->close();
        echo "error 3";
        exit();
    }
    $resoult = $con->query("Select Cal_ID from Calendars_perm where Selected = 1 and User_id = " . $user_id);
    if ($resoult->num_rows == 0) {
        $con->close();
        echo "Brak kalendarza";
        exit();
    } else {
        $resoult = $con->query("Select Calendars.Cal_ID, Calendars.Name from Calendars Join Calendars_perm on Calendars_perm.Cal_ID = Calendars.Cal_ID where Calendars_perm.Selected = 1 and Calendars_perm.User_id = " . $user_id . " Limit " . $offset_page . " OFFSET " . $page);  
        if ($resoult->num_rows == 0) {
            echo 'Brak uzytkowników';
            exit();
        } else {
            $output = Array();
            foreach($resoult as $row) {
                array_push($output, array(
                    'ID' => $row['Cal_ID'],
                    'Name' => $row['Name']
                ));
            }
            echo json_encode($output);
        } 
    }
    $con->close();
}



