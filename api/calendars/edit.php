<?php
require_once  '../session.php';

$cal_id =  (isset($_GET['id']) ? $_GET['id'] : NULL);

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
    global $cal_id;
    $con = make_con();
    $user_id = get_user_id_by_ses($con);
    if ($user_id == NULL) {
        $con->close();
        echo "error 3";
        return false;
    }
    $con->autocommit(true);
    $resoult = $con->query('Select Owner from Calendars where Cal_ID = ' . $cal_id . ' and Owner = ' . $user_id);
    if ($resoult->num_rows == 0) {
        echo 'Brak kalendarzy';
        $con->close();
        return false;
    } else {
        $con->query("Update Calendars Set Name = '" . filter_var($data_json['title'], FILTER_SANITIZE_STRING) . 
        "', Description = '" . str_replace(array("'", '"'), '', $data_json['Desc']) . "' where Cal_ID = " . $cal_id );
        $con->close();   
        return true;        
    }
}

$data = json_decode(file_get_contents('php://input'), true);
// echo var_dump(check_structure($data));
if (enter_to_view()) {
    if (check_structure($data) && isHTML($data['Desc']) && $cal_id != NULL) {
        require_once  '../utilis/config.php';
        if (add_event($data)) echo "OK";
        else echo 'ERROR 1';
    } else echo 'ERROR 2';    
}
