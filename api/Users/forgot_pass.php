<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require __DIR__ . '/PHPMailer/src/Exception.php';
require __DIR__ . '/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/PHPMailer/src/SMTP.php';

$login = (isset($_GET['login']) ? $_GET['login'] : NULL);
$email = isset($_GET['email']) ? $_GET['email'] : NULL;

function check_structure() {
    global $login, $email;
    if ($login == NULL || $email == NULL) return false;
    $login = filter_var($login, FILTER_SANITIZE_STRING);
    if (filter_var($email, FILTER_VALIDATE_EMAIL) ) return true;
    else return true;
}

function generate_pass() {
    $ses_id_length = 8;
    $output = "";
    $chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    for ($i = 0; $i < $ses_id_length; $i++) {
        $output .= $chars[rand(0, strlen($chars) - 1)];
    }
    return $output;
}

if (check_structure()) {
    require_once  '../utilis/config.php';
    $con = make_con();
    $resoult = $con->query("Select ID,Name,email from Users where Login = '" . $login . "' and email = '" . $email . "' ;");
    if ($resoult->num_rows > 0) {
        $row = $resoult->fetch_assoc();
        $pass = generate_pass();
        $con->query("Update Users SET Password = '" . hash("sha256",$pass) . "' where Login = '" . $login . "' and email = '" . $email . "';");
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
            $mail->addAddress($row['email']); 
            $mail->isHTML(true);                                  
            $mail->Subject = 'Hasło zostało zresetowane!';
            $mail->Body    = 'Nowe haslo dla konta o nazwie <b>' . $row['Name'] . '</b> to <b>' . $pass .'</b>.';
            $mail->send();
        } catch (Exception $e) {}
        echo 'OK';
    } else {
        echo '12';
    }
    $con->close();
} else echo 'Zły format danych!';
