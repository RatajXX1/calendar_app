<?php
$ses_id_length = 8;
// echo dirname(__DIR__) . '/api/utilis/config.php';
require_once   dirname(__DIR__) . '/api/utilis/config.php';

if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $user_ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $user_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $user_ip = $_SERVER['REMOTE_ADDR'];
}

function generate_ses_id($user_id = 0) {
    // global $ses_id_length;
    // $output = "";
    // $chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    // for ($i = 0; $i < $ses_id_length; $i++) {
    //     $output .= $chars[rand(0, strlen($chars) - 1)];
    // }
    return hash('sha256', $user_id);
}

function clear_old_ses($sql_curosr) {
    $sql_curosr->query('delete from sessions where Last_time < CURRENT_TIMESTAMP');
}

function clear_ses_user($user_id, $sql_curosr) {
    $sql_curosr->query("delete from sessions where User_id = " . $user_id);
}

function is_exist_ses($user_id, $sql_curosr) {
    clear_old_ses($sql_curosr);
    $resoult = $sql_curosr->query('select User_id from sessions where User_id = ' . $user_id);
    if ($resoult->num_rows == 0) return false;
    else return true;
}

function load_ses($user_id, $sql_curosr) {
    global $user_ip;
    $resoult = $sql_curosr->query('Select * from sessions where User_id = ' . $user_id);
    if ($resoult->num_rows != 0) {
        $resoult = $resoult->fetch_assoc();
        setcookie('Ses_id', $resoult['Ses_id'], time() + 86400);
        $sql_curosr->query("Update sessions set Last_time = TIMESTAMPADD(day, 1, CURRENT_TIMESTAMP), User_agent = '" . $_SERVER['HTTP_USER_AGENT'] . "', User_ip = '" . $user_ip . "'  where User_id = " . $user_id);
    } else create_ses($user_id, $sql_curosr);
}

function create_ses($user_id, $sql_curosr) {
    global $user_ip;
    $ses_id = "";
    do {
        $ses_id = generate_ses_id($user_id);
    } while (mysqli_num_rows($sql_curosr->query("Select User_id from sessions where Ses_id = '" . $ses_id. "' ")) != 0);
    $sql_curosr->query("Insert into sessions (User_id, User_agent, User_ip, Ses_id, Last_time) values (" . $user_id. ", '" . $_SERVER['HTTP_USER_AGENT'] . "' , '" . $user_ip . "' , '" . $ses_id . "', TIMESTAMPADD(day, 1, CURRENT_TIMESTAMP)) ;");
    setcookie('Ses_id', $ses_id, time() + 86400);
}

function get_ses_id($user_id, $sql_curosr) {
    $resoult = $sql_curosr->query('Select * from sessions where User_id = ' . $user_id);
    if ($resoult->num_rows != 0) {
        $resoult = $resoult->fetch_assoc();
        return $resoult['Ses_id'];
    } else return NULL;
}

function init_ses($user_id) {
    $con = make_con();
    if (!is_exist_ses($user_id, $con)) {
        create_ses($user_id, $con);
    } else {
        load_ses($user_id, $con);
    }
    $con->close();
}

function ini_ses_cursor($user_id, $sql_curosr) {
    if (!is_exist_ses($user_id, $sql_curosr)) {
        create_ses($user_id, $sql_curosr);
    } else {
        load_ses($user_id, $sql_curosr);
    }
}

function get_user_id_by_ses($sql_cursor) {
    $resoult = $sql_cursor->query("Select User_id from sessions where Ses_id = '" . $_COOKIE['Ses_id'] . "';");
    if ($resoult->num_rows == 0) return NULL;
    else return $resoult->fetch_assoc()['User_id'];
}

function enter_to_view() {
    if (isset($_COOKIE['Ses_id'] )) {
        $con = make_con();
        $user_id = get_user_id_by_ses($con);
        if ($user_id == NULL) {
            $con->close();
            return false;
        } else {
            if (is_exist_ses($user_id, $con)) {
                load_ses($user_id, $con);
                $con->close();
                return true;
            } else {
                $con->close();
                return false;
            }
        }
    } else return false;
}

function enter_to_view_by_rank($rank) {
    if (isset($_COOKIE['Ses_id'] )) {
        $con = make_con();
        $user_id = get_user_id_by_ses($con);
        if ($user_id == NULL) {
            $con->close();
            return false;
        } else {
            $resoult = $con->query("Select ID from Users where ID = " . $user_id . " and Rank >= " . $rank);
            if ($resoult->num_rows == 0) {
                $con->close();
                return false;                
            }
            if (is_exist_ses($user_id, $con)) {
                load_ses($user_id, $con);
                $con->close();
                return true;
            } else {
                $con->close();
                return false;
            }
        }
    } else return false;
}



