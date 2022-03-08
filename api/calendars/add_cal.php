<?php

require_once '../session.php';


function isHTML($string){
    if($string != strip_tags($string)){
        return true;
    }else{
        return false;
    }
}

function check_structure($data_json) {
    foreach(array('title', 'Desc') as $value) {
        if (!in_array($value, Array_keys($data_json))) return false;
    }
    return true;
}

function add_event($data_json) {
    $con = make_con();
    $user_id = get_user_id_by_ses($con);
    if ($user_id == NULL) {
        $con->close();
        echo "error 3";
        return false;
    }
    $con->autocommit(true);
    $con->query("Insert into Calendars (Name, Description, Owner) values ('" . filter_var($data_json['title'], FILTER_SANITIZE_STRING) . "','" . str_replace(array("'", '"'), '', $data_json['Desc']) . "', " . $user_id. ");" );
    $con->query("Insert into Calendars_perm (Cal_ID, User_id) values (" . $con->insert_id . ", " . $user_id . " )");
    $con->close();   
    return true;
}

$data = json_decode(file_get_contents('php://input'), true);
if (enter_to_view()) {
    if (check_structure($data) && isHTML($data['Desc'])) {
        require_once  '../utilis/config.php';
        if (add_event($data)) echo "OK";
        else echo 'ERROR 1';
    } else echo 'ERROR 2';    
}

