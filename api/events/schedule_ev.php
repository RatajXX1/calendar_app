<?php 

// todo modes only and session 
require_once '../session.php';
$page = (isset($_GET['page']) ? $_GET['page'] : 0);
$year = isset($_GET['year']) ? $_GET['year'] : date('Y');
$month = isset($_GET['month']) ? $_GET['month'] : 1;

function next_moth($month_date, $year_date) {
    if ($month_date == 12) return Array(1, $year + 1);
    else return Array($month_date + 1, $year_date);
}

function dateDifference($date_1 , $date_2 , $differenceFormat = '%a' ) {
    $datetime1 = date_create($date_1);
    $datetime2 = date_create($date_2);
    $interval = date_diff($datetime1, $datetime2);
    return $interval->format($differenceFormat);  
}

function add_days($dates, $days_count) {
    $date_time = date_create($dates);
    date_add($date_time, date_interval_create_from_date_string($days_count . ' days'));
    return date_format($date_time, 'Y-m-d') . ' ' . explode(' ' , $dates)[1];
}

if ( enter_to_view() && is_numeric($year) && is_numeric($month) && is_numeric($page)) {
    require_once '../utilis/config.php';
    $con = make_con();
    $user_id = get_user_id_by_ses($con);
    if ($page > 0) $page -= 1;
    // $page = 2 * $page;
    $page = $offset_page * $page;
    if ($user_id == NULL) {
        $con->close();
        echo "error 3";
        exit();
    }
    $nex_month = next_moth($month, $year);
    // echo ("Select ID, title, time_start, time_end,color,mode from events where calendar_id in (Select Cal_ID from Calendars_perm where Selected = 1 and User_id = " . $user_id . ") and (time_start  > '" . $year . '-' . $month . "-1' and time_start < '" . $nex_month[1] . '-' . $nex_month[0] . "-1' or mode > 1) order by time_start desc  Limit " . $offset_page . " OFFSET " . $page);
    if ($month == 1) $result = $con->query("Select ID, title, time_start, time_end,color,mode from events where calendar_id in (Select Cal_ID from Calendars_perm where Selected = 1 and User_id = " . $user_id . ") and (time_start  > '" . $year . '-' . $month . "-1' and time_start < '" . $nex_month[1] . '-' . $nex_month[0] . "-1' or mode > 1) order by time_start desc  Limit " . $offset_page . " OFFSET " . $page);
    else $result = $con->query("Select ID, title, time_start, time_end,color,mode from events where calendar_id in (Select Cal_ID from Calendars_perm where Selected = 1 and User_id = " . $user_id . ") and time_start  > '" . $year . '-' . $month . "-1' and time_start < '" . $nex_month[1] . '-' . $nex_month[0] . "-1' order by time_start desc  Limit " . $offset_page . " OFFSET " . $page);
    if ($result->num_rows == 0) echo 'brak danych';
    else {
        $out_put = Array();
        foreach($result as $row) {
            $time_started = $row['time_start'];
            for($i = 0; $i <= dateDifference($row['time_start'], $row['time_end']); $i++) {
                if ($i > 0) $time_started = add_days($time_started, 1);
                array_push($out_put, Array(
                    'ID' => $row['ID'],
                    'Tittle' => $row['title'],
                    'Time_start' => $time_started,
                    'time_end' => $row['time_end'],
                    'Color' => $row['color'],
                    'Mode' => $row['mode']
                ));
            }
        }
        echo json_encode($out_put);
    }
    $con->close();
} else echo 'Nie poprawny format danych';