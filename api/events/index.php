<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once  '../session.php';

header("Access-Control-Allow-Origin: *");
$mode = (isset($_GET['mode']) ? $_GET['mode'] : 1);
$dates = (isset($_GET['date']) ? $_GET['date'] : date('Y-m-d'));
$page =  (isset($_GET['page']) ? $_GET['page'] : 1);
$user_id = 1;

// mode 1 week 2 one-day
function check_all_param() {
    global $mode, $dates, $page, $user_id;
    if (!is_numeric($mode) || !is_numeric($page) || !is_numeric($user_id)) return false;
    if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $dates)) return false;
    return true;
}

function get_week($date_time) {
    $output = array();
    $timestamp = strtotime($date_time);
    $date_time = date_create($date_time);
    date_sub($date_time, date_interval_create_from_date_string(date('N', $timestamp)  . ' days'));
    $output[0] = date_format($date_time ,'Y-m-d');
    date_add($date_time, date_interval_create_from_date_string('8 days'));
    $output[1] = date_format($date_time, 'Y-m-d');
    return $output;
}

if (check_all_param() && enter_to_view()) {
    require_once '../utilis/config.php';
    $con = make_con();
    $user_id = get_user_id_by_ses($con);
    if ($page != 0 ) $page -= 1;
    $page = $offset_page * $page;
    if ($user_id == NULL) {
        $con->close();
        echo "error 3";
        exit();
    }
    $results;
    if ($mode == 1) {
        $dates = get_week($dates);
        // var_dump($dates);
        $results = $con->query("select ID,title,time_start,time_end,mode,color from events where calendar_id in (Select Cal_ID from Calendars_perm where Selected = 1 and User_id = " . $user_id . ") and ((time_start BETWEEN '" . $dates[0] . "' and '" . $dates[1] . "') or (time_end <= '" . $dates[1] . "' and time_end >= '" . $dates[0] . "' and mode = 6) or (mode > 1 and mode < 6 and MONTH(time_start) <= '" . date("m",strtotime($dates[0])) . "' and YEAR(time_start) <= '" . date("Y",strtotime($dates[0])) . "' and CASE WHEN MONTH(time_start) = '" . date("m",strtotime($dates[0])) . "' and YEAR(time_start) = '" . date("Y",strtotime($dates[0])) . "' then (Case WHEN DAYOFMONTH(time_start) <= '" . date("d",strtotime($dates[0])) . "' then true else false end) else true end)) limit " . $offset_page . " offset " . $page);
    }
    elseif ($mode == 2)
        $results = $con->query("select ID,title,time_start,time_end,mode,color from events where calendar_id in (Select Cal_ID from Calendars_perm where Selected = 1 and User_id = " . $user_id . ") and ((Date(time_start) = '" . $dates . "' and Date(time_end) = '" . $dates. "') or ((Date(time_start) <= '" . $dates . "' or Date(time_start) = '" . $dates . "') and (Date(time_end) >= '" . $dates . "' or Date(time_end) = '" . $dates . "'  ) and mode = 6) or (mode > 1 and mode < 6 and time_start <= '" . $dates . "')) limit " . $offset_page . " offset " . $page ) ;
    if ($results->num_rows == 0) {
        echo 'Nie ma zadnych wydazen w kalendarzu!<br>'. $con->error;
    } else {
        $main_output = array();
        for($row_id = 0 ; $row_id < $results->num_rows; $row_id++) {
            $results->data_seek($row_id);
            $row = $results->fetch_assoc();
            $main_output[$row_id] = array(
                "ID" => $row['ID'],
                "Title" => $row['title'],
                "Time_start" => $row['time_start'],
                "Time_end" => $row['time_end'],
                'Mode' => $row['mode'],
                'Color' => $row['color']
            );
        }
        echo json_encode($main_output);
    }
    $con->close();
} else echo 'Nie poprawny paramentr!';
