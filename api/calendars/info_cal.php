<?php
header('Content-Type: text/html; charset=utf-8');
$cal_id =  (isset($_GET['id']) ? $_GET['id'] : NULL);

require_once  '../session.php';

if (enter_to_view()) {
    if ($cal_id != NULL && is_numeric($cal_id)) {
        require_once '../utilis/config.php';
        $con=make_con();

        $resoult = $con->query("Select Calendars.Name as Cal_name, Calendars.Description, Calendars.Owner, Calendars.Time_added, Users.Name from Calendars join Users on Users.ID = Calendars.Owner where Calendars.Cal_ID = " . $cal_id);
        if ($resoult->num_rows == 0) {
            echo "Brak danych!";
        } else {
            $resoult = $resoult->fetch_assoc();
            echo json_encode(Array(
                "Cal_name" => $resoult["Cal_name"],
                "Cal_desc" => $resoult["Description"],
                "Cal_owner_id" => $resoult["Owner"],
                "Cal_date" => $resoult["Time_added"],
                "Cal_owner_name" => $resoult["Name"]
            ));
        }
        $con->close();
    } else echo 'Zły format danych';
}