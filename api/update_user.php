<?php

$data = json_decode(file_get_contents('php://input'), true);
require_once '/session.php';

// email, prof, pass
function check_el() {
    global $data;
    $flag = false;
    if (array_key_exists('email', $data)) {
        $data['email'] = filter_var($data['email'], FILTER_SANITIZE_STRING);
        $flag = true;
    }
    if (array_key_exists('prof', $data)) {
        $data['prof'] = filter_var($data['prof'], FILTER_SANITIZE_STRING);        
        $flag = true;
    }
    if (array_key_exists('name', $data)) {
        $data['name'] = filter_var($data['name'], FILTER_SANITIZE_STRING);        
        $flag = true;
    }
    if (array_key_exists('pass', $data) && array_key_exists('rpass', $data)) {
        $data['pass'] = filter_var($data['pass'], FILTER_SANITIZE_STRING);        
        $data['rpass'] = filter_var($data['rpass'], FILTER_SANITIZE_STRING);        
        $flag = true;
    }
    return $flag;
}

if (enter_to_view() && check_el()) {
    require_once  './utilis/config.php';
    $con = make_con();
    $user_id = get_user_id_by_ses($con);
    $flag = false;
    if ($user_id == NULL) {
        echo 'Error 120';
        return 0;
    }
    if (array_key_exists('email', $data)) {
        $con->query("Update Users SET email = '" . $data['email'] . "' where ID = " . $user_id);
        $flag = true;
    }
    if (array_key_exists('prof', $data)) {  
        $con->query("Update Users SET Image_id = (SELECT ID FROM Images WHERE Path = '" . $data['prof'] . "' LIMIT 1) where ID = " . $user_id);   
        $flag = true; 
    }
    if (array_key_exists('name', $data)) {
        $con->query("Update Users SET Name = '" . $data['name'] . "' where ID = " . $user_id);     
        $flag = true; 
    }
    if (array_key_exists('pass', $data)) {  
        $resoult = $con->query("Select ID from Users where ID = " . $user_id . " and Password = '" . hash('sha256', $data['pass']) . "'");
        if ($resoult->num_rows > 0) {
            $con->query("Update Users SET Password = '" . hash('sha256', $data['rpass']) . "' where ID = " . $user_id);
            $flag = true;
        } else {
            $flag = false;
        }
    }
    echo $flag ? 'OK' : 'Error 222';
    $con->close();
} else echo 'Zły format danych!';
