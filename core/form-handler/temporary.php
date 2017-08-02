<?php

    include '../../core/config.php';
    include SITE_PATH . 'core/dbconnect.php';

    $editSiteQuery = 'SELECT `alias` FROM `sites`';

    $editSiteResult = $mysqli->query($editSiteQuery);
    $arrayName = array();

    if ($editSiteResult) {
        foreach ($editSiteResult as $key => $row) {
            //echo $row;
            $arrayName[] = $row;

            if (mkdir($path . $formFields['alias'], 0777, true)) {
                $fp = fopen($path . $formFields['alias'] . '/main.html', "w");
                if (!$fp) {
                    $response['folder'] = 'error';
                } else {
                    fclose($fp);
                    $response['folder'] = 'success';
                }
            } else {
                $response['status'] = 'danger';
            }
        }
    } else {
        echo 'false';
    }

    echo json_encode($arrayName);

?>