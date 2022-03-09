<?php

$page =  (isset($_GET['page']) ? $_GET['page'] : 1);

require_once  '../session.php';

if (enter_to_view() && is_numeric($page)) {
    require_once '../utilis/config.php';
    if ($page > 0) $page -= 1;
    $page = $page  * $offset_page;
    $con = make_con();
    // $con->set_charset("utf8");
    $user_id = get_user_id_by_ses($con);
    if ($user_id != NULL) {
        $resoult = $con->query("Select Calendars.Cal_ID, Calendars.Name, Calendars.Owner,Calendars_perm.Selected From Calendars Join Calendars_perm on Calendars.Cal_ID = Calendars_perm.Cal_iD where Calendars_perm.User_id = " . $user_id . " Order by Calendars_perm.Selected DESC Limit " . $offset_page . " offset  " . $page );
        if ($resoult->num_rows == 0) {
            echo 'Brak Kalendarzy';
        } else {
            $output = Array();
            foreach($resoult as $row) {
                array_push($output, Array(
                    'ID' => $row["Cal_ID"],
                    'Name' => $row["Name"],
                    'Owner' => $row["Owner"],
                    'Selected' => $row["Selected"],
                ));
            }
            echo Json_encode($output);
        }
    } else {
        echo 'Error 1';
    }
    $con->close();
} else echo 'Zły format danych';