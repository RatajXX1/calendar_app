<?php
header('Content-Type: text/html; charset=utf-8');
$cal_id =  (isset($_GET['id']) ? $_GET['id'] : NULL);

require_once   '../session.php';

if (enter_to_view_by_rank(2)) {
    if ($cal_id != NULL && is_numeric($cal_id)) {
        require_once  '../utilis/config.php';
        $con=make_con();

        $resoult = $con->query("Select Name, email, Rank from Users where ID = " . $cal_id);
        if ($resoult->num_rows == 0) {
            echo "Brak danych!";
        } else {
            $resoult = $resoult->fetch_assoc();
            echo json_encode(Array(
                "Name" => $resoult["Name"],
                "Email" => $resoult["email"],
                "Rank" => $resoult["Rank"]
            ));
        }
        $con->close();
    } else echo 'Zły format danych';
}