<?php
    include '../../core/config.php';
    include SITE_PATH . 'core/dbconnect.php';

    if (count($_POST) != 0){
        $formFields = $_POST;
    }

    $query = "INSERT INTO `pages`(
        `id`,
        `name`,
        `alias`,
        `template`,
        `available_in_menu`
    )
     VALUES (
        '',
        '". $formFields['name'] ."',
        '". $formFields['alias'] ."',
        '". $formFields['template'] ."',
        '". $formFields['available_in_menu'] ."'
    )";

    $response = array(
        'fieldsVal' => $formFields
    );


    if ($mysqli->query($query)) {
        $response['status'] = 'success';
    } else {
        $response['status'] = 'danger';
    }

    echo json_encode($response);
?>