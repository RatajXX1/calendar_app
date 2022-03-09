<?php

require_once  '../session.php';

$page = (isset($_GET['page']) ? $_GET['page'] : 0);

if (enter_to_view_by_rank(2) && is_numeric($page)) {
    require_once  '../utilis/config.php';
    if ($page > 0) $page -= 1;
    $page = $offset_page * $page;
    $con = make_con();
    $resoult = $con->query("Select Users.ID, Users.Name, Images.Path from Users join Images on Users.Image_id = Images.ID Order by Users.ID ASC Limit " . $offset_page . " offset " . $page);
    if ($resoult->num_rows == 0) {
        echo 'Brak uzytkowników';
    } else {
        $output = array();
        foreach($resoult as $row) {
            array_push($output, array(
                'ID' => $row['ID'],
                'Name' => $row['Name'],
                'Path' => $row['Path'],
            ));
        }
        echo json_encode($output);
    }
    $con->close();
}