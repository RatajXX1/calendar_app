<?php 

header("Access-Control-Allow-Origin: *");
$eve_id = $_GET['evid'];


function check_param() {
    if (!is_numeric($eve_id)) return false;
    return true;
}

if (!check_param()) {
    require_once '../utilis/config.php';
    $con = make_con();
    $result = $con->query('Select events.ID,events.title,events.content,events.time_start,events.time_end,events.mode,Calendars.Name from events join Calendars on events.calendar_id = Calendars.Cal_ID where events.ID = ' . $eve_id);
    if ($result->num_rows == 0) {
        echo 'Event nie istnieje';
    } else {
        $result = $result->fetch_assoc();
        echo json_encode(array(
            'ID' => $result['ID'],
            'Title' => $result['title'],
            'Content' => $result['content'],
            'Time_start' => $result['time_start'],
            'Time_end' => $result['time_end'],
            'Mode' => $result['mode'],
            'Cal_name' => $result['Name'],
        ));
    }
    $con->close();
} else echo 'Nie poprawny argument!';
