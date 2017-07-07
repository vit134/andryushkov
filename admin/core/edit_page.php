<?php
    include '../../core/config.php';
    include SITE_PATH . 'core/dbconnect.php';

    //$uploads_dir = '../../uploads';
    $uploads_dir = SITE_PATH . '/uploads';

    if (count($_POST) != 0){
        $formFields = $_POST;
    }

    $response['formFields'] =  $formFields;

    $query = "UPDATE `pages` SET
        `name`='".$formFields['name']."',
        `alias`='".$formFields['alias']."',
        `template`='".$formFields['template']."',
        `available_in_menu`='".$formFields['available_in_menu']."'
    WHERE `id` like " . $formFields['id'];

    $response['query'] = $query;

    if ($mysqli->query($query)) {
        $response['status'] = 'success';
    } else {
        $response['status'] = $mysqli->error;
    }

    echo json_encode($response);
?>