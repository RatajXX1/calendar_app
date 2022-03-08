<?php

require_once  '../session.php';

function check_structure($data_json) {
    foreach(array('name', 'email', 'rank', 'id') as $value) {
        if (!in_array($value, Array_keys($data_json))) return false;
    }
    if (!is_numeric($data_json['rank']) || !is_numeric($data_json['id'])) return false;
    if (filter_var($data_json['email'], FILTER_VALIDATE_EMAIL) ) return true;
    else return true;
}

$data = json_decode(file_get_contents('php://input'), true);
if (enter_to_view_by_rank(2) && check_structure($data)) {
    require_once  '../utilis/config.php';
    $con = make_con();
    
    $resoult = $con->query("Select ID from Users where ID = " . $data['id'] .  ";");
    // echo ("Select ID from Users where ID = " . $data['id'] .  ";");
    if ($resoult->num_rows != 0) {
        $con->query("Update Users Set Name = '" . $data['name'] . "', email = '" . $data['email'] . "', Rank = " . $data['rank'] . " where ID = " . $data['id']);
        echo 'OK';
    } else {
        echo 'Uzytkownik z nie istnieje!';
    }
    $con->close();
}