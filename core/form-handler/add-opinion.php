<?php

    include '../config.php';
    include '../dbconnect.php';

    $fields = $_POST;
    $response = array();

    if (count($_POST) != 0){

        $selectQuery = "SELECT * FROM `liked_sites` WHERE `site_id` =" . $fields['site_id'] . " and `user_id` = " . $fields['user_id'];

        $response['query'] = $selectQuery;



        $result = $mysqli->query($selectQuery);

        if (!$mysqli->query($selectQuery)) {
            $response['query'] = $selectQuery;
            $response['status'] = 'ERROR selectQuery -- ' .  $mysqli->error;
        }

        if ($result->num_rows > 0) {
            $updateQuery = "UPDATE `liked_sites` SET
                `opinion`='" . $fields['opinion'] ."',
                `design_raiting`='" . $fields['design'] ."',
                `usability_raiting`='" . $fields['usability'] ."',
                `creativity_raiting`='" . $fields['creativity'] ."',
                `speed_raiting`='" . $fields['speed'] ."',
                `is_like`='" . $fields['like'] ."'
            WHERE `site_id` = ". $fields['site_id'] ." and `user_id` = " . $fields['user_id'];


            if ($mysqli->query($updateQuery)) {
                $response['status'] = 'success';
                $response['query'] = $updateQuery;
            } else {
                $response['query'] = $updateQuery;
                $response['status'] = 'ERROR updateQuery -- ' . $mysqli->error;
            }
        } else {
            $insertQuery = "INSERT INTO `liked_sites`(
                `site_id`,
                `user_id`,
                `opinion`,
                `design_raiting`,
                `usability_raiting`,
                `creativity_raiting`,
                `speed_raiting`,
                `is_like`)
            VALUES (
                '". $fields['site_id'] ."',
                '". $fields['user_id'] ."',
                '". $fields['opinion'] ."',
                '". $fields['design'] ."',
                '". $fields['usability'] ."',
                '". $fields['creativity'] ."',
                '". $fields['speed'] ."',
                '". $fields['like'] ."'
            )";

            if ($mysqli->query($insertQuery)) {
                $response['status'] = 'success';
                $response['query'] = $insertQuery;
                $response['user_id'] = $fields['user_id'];
            } else {
                $response['query'] = $insertQuery;
                $response['status'] = 'ERROR insertQuery -- ' .  $mysqli->error;
            }
        }
    } else {
        $response = array(
            'status' => 'error post request'
        );
    }


    echo json_encode($response);
?>