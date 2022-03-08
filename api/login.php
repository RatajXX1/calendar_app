<?php
header("Access-Control-Allow-Origin: *");
function check_structure($data_object) {
    if (count($data_object) != 2) return false;
    if (!in_array('login', Array_keys($data_object))) return false;
    if (!in_array('password', Array_keys($data_object))) return false;
    return true;
}

function sanitize_data($data_object) {
    $data_object[0] = filter_var($data_object[0], FILTER_SANITIZE_STRING);
    $data_object[1] = filter_var($data_object[1], FILTER_SANITIZE_STRING);
    return $data_object;
}

$data = json_decode(file_get_contents('php://input'), true);
if (check_structure($data)) {
    require_once './utilis/config.php';
    require_once  'session.php';
    $data = sanitize_data($data);
    $con = make_con();
    $result = $con->query("Select ID from Users where Login = '" . $data['login'] ."' and Password = '" . hash('sha256',$data['password']) . "' ;");
    if ($result->num_rows == 0) {
        echo 'Haslo lub login jest błedne lub podany uzytkownik nie istnieje!';
    } else {
        echo 'OK';
        // make session and send cookies
        $result = $result->fetch_assoc();
        ini_ses_cursor($result['ID'], $con);
    }
    $con->close();
} else echo 'Nie poprawny format danych!';

