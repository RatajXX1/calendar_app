<?php

require_once  '../session.php';

function check_structure($data_json) {
    foreach(array('cal_id', 'ids') as $value) {
        if (!in_array($value, Array_keys($data_json))) return false;
    }
    return true;
}

$data = json_decode(file_get_contents('php://input'), true);
if (enter_to_view()) {
    if (check_structure($data) && is_numeric($data['cal_id']) && is_array($data['ids'])) {
        require_once '../utilis/config.php';
        $con = make_con();
        $user_id = get_user_id_by_ses($con);
        if ($user_id == NULL) {
            $con->close();
            echo "error 3";
            exit();
        }
        $resolut = $con->query('Select Cal_ID from Calendars_perm where Cal_ID = ' . $data['cal_id']);
        if ($resolut->num_rows == 0) {
            echo 'Brak kalendarza';
        } else {
            if (count($data['ids']) > 0) {
                $qers = "Insert into Calendars_perm (Cal_ID, User_id, Selected) VALUES ";
                for ($i = 0; $i < count($data['ids']); $i++) {
                    if (is_numeric($data['ids'][$i])) {
                        $qers .= "(" . $data['cal_id'] . ",  " . $data['ids'][$i] . " ,0)";
                        if ($i == 0 && count($data['ids']) > 1) $qers .= ', ';
                        elseif ($i > 0 && $i < count($data['ids']) - 1 ) $qers .= ', ';
                        elseif ($i == count($data['ids']) - 1) $qers .= ';' ;                 
                    }
                }
                $con->query($qers);
                echo 'OK';
            } else {
                echo 'Brak danych!';
            }
        }
        $con->close();
    } else echo 'Zły format danych!';
}