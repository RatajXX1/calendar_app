<?php

require_once  '../session.php';

function check_structure($data_json) {
    foreach(array('ids', 'idn') as $value) {
        if (!in_array($value, Array_keys($data_json))) return false;
    }
    return true;
}

$data = json_decode(file_get_contents('php://input'), true);
if (enter_to_view()) {
    if (check_structure($data)) {
        require_once '../utilis/config.php';
        $con = make_con();
        $user_id = get_user_id_by_ses($con);
        if ($user_id == NULL) {
            $con->close();
            echo "error 3";
            exit();
        }
        if (count($data['ids']) > 0 && is_array($data['ids']) && ctype_digit(implode('',$data['ids']))) {
            $qers = "Update Calendars_perm Set selected = 1 where User_id = " . $user_id . " and Cal_ID in (" . implode("," , $data['ids']) . ")";
            $con->query($qers);
        }
        if (count($data['idn']) > 0 && is_array($data['idn']) && ctype_digit(implode('',$data['idn']))) {
            $qers = "Update Calendars_perm Set selected = 0 where User_id = " . $user_id . " and Cal_ID in (" . implode("," , $data['idn']) . ")";
            $con->query($qers);
        }
        echo 'OK';
        $con->close();
    } else echo 'Zły format danych!';
}