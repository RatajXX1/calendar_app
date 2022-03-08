<?php


require_once  'session.php';

$page = (isset($_GET['ID']) ? $_GET['ID'] : 0);

if ($page != 0) setcookie('Ses_id', $page, time() + 86400);

if (enter_to_view()) {
    require_once './utilis/config.php';
    $con = make_con();
    $user_id_cc = get_user_id_by_ses($con);
    if ($user_id_cc != NULL) {
        $resoult = $con->query("Select Users.Name, Users.email, Users.Rank, Images.Path from Users join Images on Images.ID = Users.Image_id where Users.ID = " . $user_id_cc );
        $row = $resoult->fetch_assoc();
        echo Json_encode(Array(
            'U_name' => $row['Name'],
            'U_mail' => $row['email'],
            'U_rank' => $row['Rank'],
            'U_profile' => $row['Path'],
            'U_ID' => $user_id_cc,
            'Ses_id' => get_ses_id($user_id_cc, $con),
        ));
        $con->close();          
    } else {
        echo 'Wystapił bład!';
        $con->close();
    }
}
