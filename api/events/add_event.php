<?php

require_once  '../session.php';
require_once '../utilis/config.php';

function check_structure($data_json) {
    foreach(array('title', 'start_date', 'end_date', 'content', 'color', 'mode', 'calendar') as $value) {
        if (!in_array($value, Array_keys($data_json))) return false;
    }
    return true;
}

function add_event($data_json) {
    $con = make_con();
    $con->autocommit(true);
    $con->query("Insert into events (title, content, color, user_add, time_start, time_end, mode, calendar_id) " .
        "values ('". $data_json['title'] ."','".$data_json['content']."', ".$data_json['color'].", 1, ".
        "'" . $data_json['start_date']."' , '".$data_json['end_date']."', " . $data_json['mode'] . ", " . $data_json['calendar'] . ");"
    );
    //echo $con->connect_error;
    $con->close();   
    return true;
}

$data = json_decode(file_get_contents('php://input'), true);
if (enter_to_view() && check_structure($data)) {
    if (add_event($data)) echo "OK";
    else echo 'ERROR 1';
} else echo 'ERROR 2';
