<?php
    include '../../core/config.php';
    include SITE_PATH . 'core/dbconnect.php';

    //$uploads_dir = '../../uploads';
    $uploads_dir = SITE_PATH . '/uploads';

    if (count($_POST) != 0){
        $formFields = $_POST;
    }

    $response = array(
        'fieldsVal' => $formFields
    );

    if ($formFields['date_create'] != '') {
        $dateCreate = date("Y-m-d H:i:s", strtotime($formFields['date_create']));
    } else {
        $dateCreate = date("Y-m-d H:i:s");
    }


    function createCatalog() {
        global $uploads_dir, $formFields;

        $catName = $formFields['alias'];
        $path = $uploads_dir . '/' . $catName;

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        return $path;
    }


    foreach($_FILES as $key => $file) {
        if (move_uploaded_file($file["tmp_name"], $path = createCatalog() . '/' . $file["name"])) {
            $response['file_upload'] = 'success';
        } else {
            $response['file_upload'] = 'error';
        }

        $filesArr[$key] = array(
            'path'=> $path,
            'file'=> $file
        );
        //$response['files'][] = $key;
    }

    $response['files'] = $filesArr;

    if ($formFields['form_type'] == 'add_site') {
        $addSiteQuery = "INSERT INTO `sites`(
            `id`,
            `name`,
            `description`,
            `type`,
            `author`,
            `date_create`,
            `design_raiting`,
            `creativity_raiting`,
            `usability_raiting`,
            `speed_raiting`,
            `alias`,
            `big_img_file`,
            `small_img_file`,
            `link`
        )
         VALUES (
            '',
            '". $formFields['site_name'] ."',
            '". $formFields['site_description'] ."',
            '". $formFields['site_type'] ."',
            '". $formFields['site_author'] ."',
            '". $dateCreate ."',
            '". $formFields['design_raiting'] ."',
            '". $formFields['creativity_raiting'] ."',
            '". $formFields['usability_raiting'] ."',
            '". $formFields['speed_raiting'] ."',
            '". $formFields['alias'] ."',
            '". $filesArr['big_img_file']['path'] ."',
            '". $filesArr['small_img_file']['path'] ."',
            '". $formFields['link'] ."'
        )";



        if ($mysqli->query($addSiteQuery)) {
            $response['status'] = 'success';
        } else {
            $response['status'] = 'danger';
        }
    }

    echo json_encode($response);
?>