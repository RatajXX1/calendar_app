<?php

require_once   '../session.php';
// 1 who have permission  2 who not have permission
$perm_mode =  (isset($_GET['mode']) ? $_GET['mode'] : 1);
$cal_id =  (isset($_GET['id']) ? $_GET['id'] : NULL);
$page = (isset($_GET['page']) ? $_GET['page'] : 0);


if (enter_to_view() && is_numeric($perm_mode) && is_numeric($page) && is_numeric($cal_id)) {
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
    $resoult = $con->query("Select Owner from Calendars where Cal_ID = " . $cal_id . " and Owner = " . $user_id);
    if ($resoult->num_rows == 0) {
        $con->close();
        echo "Brak kalendarza";
        exit();
    } else {
        if ($perm_mode == 1) {
            $resoult = $con->query("Select Users.Name, Users.ID ,Images.path from Users Join Images on Images.ID = Users.Image_id Join Calendars_perm on Calendars_perm.User_id = Users.ID where Calendars_perm.Cal_ID = " . $cal_id . " Limit " . $offset_page . " OFFSET " . $page);  
            // echo ("Select Users.Name, Users.ID ,Images.path from Users Join Images on Images.ID = Users.Image_id Join Calendars_perm on Calendars_perm.User_id = Users.ID where Calendars_perm.Cal_ID = " . $cal_id . " Limit " . $offset_page . " OFFSET " . $page);  
            if ($resoult->num_rows == 0) {
                echo 'Brak uzytkowników';
                exit();
            } else {
                $output = Array();
                foreach($resoult as $row) {
                    array_push($output, array(
                        'User_name' => $row['Name'],
                        'User_ID' => $row['ID'],
                        'Image' => $row['path'],
                    ));
                }
                echo json_encode($output);
            } 
        } else {
            $resoult = $con->query("Select Users.Name, Users.ID ,Images.path from Users Join Images on Images.ID = Users.Image_id where not Users.ID in (Select User_id From Calendars_perm WHERE Cal_ID = " . $cal_id . ")  Limit " . $offset_page . " OFFSET " . $page );  
            if ($resoult->num_rows == 0) {
                echo 'Brak uzytkowników';
                exit();
            } else {
                $output = Array();
                foreach($resoult as $row) {
                    array_push($output, array(
                        'User_name' => $row['Name'],
                        'User_ID' => $row['ID'],
                        'Image' => $row['path'],
                    ));
                }
                echo json_encode($output);
            } 
        }
    }
    $con->close();
}



