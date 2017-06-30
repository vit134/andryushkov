<?php

    include '../../core/config.php';
    include SITE_PATH . 'core/dbconnect.php';

    if (count($_POST) != 0){
        $formFields = $_POST;
    }
    $query = "INSERT INTO `templates`(
        `id`,
        `name`,
        `alias`
    )
     VALUES (
        '',
        '". $formFields['name'] ."',
        '". $formFields['alias'] ."'
    )";

    $response = array(
        'fieldsVal' => $formFields['name']
    );


    if ($mysqli->query($query)) {
        $response['status'] = 'success';
    } else {
        $response['status'] = 'danger';
    }

    echo json_encode($response);

?>