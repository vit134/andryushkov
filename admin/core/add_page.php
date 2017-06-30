<?php
    include '../../core/config.php';
    include SITE_PATH . 'core/dbconnect.php';

    //$uploads_dir = '../../uploads';
    $uploads_dir = SITE_PATH . 'admin/uploads';


    function createCatalog() {
        global $uploads_dir, $formFields;

        $catName = $formFields['alias'];
        $path = $uploads_dir . '/' . $catName;

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        return $path;
    }


    echo json_encode($response);
?>