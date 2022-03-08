<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require __DIR__ . '/PHPMailer/src/Exception.php';
require __DIR__ . '/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/PHPMailer/src/SMTP.php';

require_once   '../session.php';

function check_structure($data_json) {
    foreach(array('name', 'password', 'email', 'rank') as $value) {
        if (!in_array($value, Array_keys($data_json))) return false;
    }
    if (!is_numeric($data_json['rank'])) return false;
    if (filter_var($data_json['email'], FILTER_VALIDATE_EMAIL) ) return true;
    else return true;
}

$data = json_decode(file_get_contents('php://input'), true);
if (enter_to_view_by_rank(2) && check_structure($data)) {
    require_once  '../utilis/config.php';
    $con = make_con();
    $resoult = $con->query("Select ID from Users where Login = '" . filter_var($data['name'], FILTER_SANITIZE_STRING) . "';");
    if ($resoult->num_rows == 0) {
        $con->query("Insert into Users (Name, Login, Password, Image_id, email, Rank) values ('" .
        filter_var($data['name'], FILTER_SANITIZE_STRING)  . "', '" . filter_var($data['name'], FILTER_SANITIZE_STRING) . "','" . 
        hash('sha256', filter_var($data['password'], FILTER_SANITIZE_STRING) ) . "' , 1, '" . filter_var($data['email'], FILTER_SANITIZE_EMAIL)  . "' , " . filter_var($data['rank'], FILTER_SANITIZE_STRING)  . ");");
        $user_id = $con->insert_id;
        $con->query("Insert into Calendars (Name, Description, Owner) values ('Kalendarz Główny','Kalendarz Główny', " . $user_id .");" );
        $con->query("Insert into Calendars_perm (Cal_ID, User_id) values (" . $con->insert_id . ", " . $user_id . " )");
        try {
            $mail = new PHPMailer(true);
            $mail->IsSMTP();
            $mail->CharSet = 'UTF-8';
            $mail->Host       = $smtp_host;  
            $mail->SMTPDebug  = 0;                  
            $mail->SMTPAuth   = true;           
            $mail->Port       = $smtp_port;                    
            $mail->Username   = $smtp_login;            
            $mail->Password   = $smtp_password ;
            $mail->setFrom($smtp_login);          
            $mail->addAddress($data['email']); 
            $mail->isHTML(true);                                  
            $mail->Subject = 'Stworzono ci konto w kalendarzu!';
            $mail->Body = 'Login to <b>' . $data['name'] . '</b><br>Hasło to <b>' . $data['password'] .'</b>';
            $mail->send();
        } catch (Exception $e) {}
        echo 'OK';
    } else {
        echo 'Uzytkownik z takim loginie juz istnieje!';
    }
    $con->close();
}