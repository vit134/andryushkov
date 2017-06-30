<?php
    include '../../core/dbconnect.php';

    $response = array();

    if ($_POST['siteId'] != '') {

        $removeSiteQuery = "DELETE FROM `templates` WHERE `id`= " . $_POST['siteId'] ."";

        if ($mysqli->query($removeSiteQuery)) {
            $response['status'] = 'success';
        } else {
            $response['status'] = 'danger';
        }
    } else {
        $response['status'] = 'wrong request';
    }

    echo json_encode($response);
?>