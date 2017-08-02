<?php
    include '../../core/config.php';
    include SITE_PATH . 'core/dbconnect.php';


    $login = $_POST['login'];
    $pass = $_POST['pass'];

    $res = array();

    if ($login == ''){
        $res['status'] = 'no login';
    } else if ($pass == '') {
        $res['status'] = 'no pass';
    } else {

        $query = "SELECT * FROM `users` WHERE `login` like '". $login ."' AND `pass` like '" . $pass . "'";
        $result = $mysqli->query($query);


        //echo $result->num_rows;
        if ($result->num_rows != 0) {
            foreach ($result->fetch_array(MYSQLI_ASSOC) as $key => $value) {
                $res[$key] = $value;
            }

            $_SESSION['login'] = $res;
            $res['status'] = true;

        } else {
            $res['status'] = false;
        }
    }



    echo json_encode($res);

?>