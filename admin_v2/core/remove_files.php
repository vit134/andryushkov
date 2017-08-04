<?php

    $filePath = $_POST['filePath'];
    $res = [];

    if (unlink('../../' . $filePath)) {
        $res['status'] = 'success';
    } else {
        $res['status'] = 'error';
    }

    echo json_encode($res);
?>