<?php

$page = isset($_GET['page']) ? $_GET['page'] : 0;

if (is_numeric($page)) {
    if ($page != 0 ) $page -= 1;
    require_once dirname(__DIR__) . '/utilis/config.php';
    $page = $offset_page * $page;
    $con = make_con();
    $resoult = $con->query("Select * from Images limit " . $offset_page . " offset " . $page );
    if ($resoult-> num_rows == 0) {
        echo 'Nie ma zdjec w bazie danych';
    } else {
        $output = Array();
        for ($i = 0; $i < $resoult->num_rows; $i++) {
            $resoult->data_seek($i);
            $row = $resoult->fetch_assoc();
            $output[$i] = Array(
                'ID' => $row['ID'],
                'Path' => $row['Path']                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       
            );
        }
        echo Json_encode($output);
    }
    $con->close();
} else echo 'Nie poprawny format danych';

