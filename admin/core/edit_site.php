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
            'path'=> '/uploads/' . $formFields['alias'] . '/' . $file["name"],
            'file'=> $file
        );
    }

    $response['files'] = $filesArr;

    if ($formFields['form_type'] == 'edit_site') {
        $addSiteQuery = "UPDATE `sites` SET
            `name`              = '". $formFields['site_name'] ."',
            `description`       = '". $formFields['site_description'] ."',
            `type`              = '". $formFields['site_type'] ."',
            `link`              = '". $formFields['link'] ."',
            `author`            = '". $formFields['site_author'] ."',
            `date_create`       = '". $dateCreate ."',
            `design_raiting`    = '". $formFields['design_raiting'] ."',
            `usability_raiting` = '". $formFields['usability_raiting'] ."',
            `creativity_raiting`= '". $formFields['creativity_raiting'] ."',
            `speed_raiting`     = '". $formFields['speed_raiting'] ."',
            `alias`             = '". $formFields['alias'] ."',
            `tags`              = '". $formFields['tags'] ."',
            `colors`            = '". $formFields['colors'] ."',
            `create_template`   = '". $formFields['create_template'] ."',
            `content`   = '". $formFields['content'] ."'

        WHERE `id`=" . $formFields['site_id'];

        if ($filesArr['small_img_file']['path'] != '') {
            $addSmallImgQuery = "UPDATE `sites` SET
                `small_img_file` = '". $filesArr['small_img_file']['path'] ."'
            WHERE `id`=" . $formFields['site_id'];

            if ($mysqli->query($addSmallImgQuery)) {
                $response['status-small-img'] = 'success';
            } else {
                $response['status-small-img'] = $mysqli->error;
            }
        } else if ($filesArr['big_img_file']['path'] != '') {
            $addBigImgQuery = "UPDATE `sites` SET
                `big_img_file` = '". $filesArr['big_img_file']['path'] ."'
            WHERE `id`=" . $formFields['site_id'];

            if ($mysqli->query($addBigImgQuery)) {
                $response['status-big-img'] = 'success';
            } else {
                $response['status-big-img'] = $mysqli->error;
            }
        }

        if ($mysqli->query($addSiteQuery)) {
            $response['status'] = 'success';
        } else {
            $response['status'] = $mysqli->error;
        }
    }

    echo json_encode($response);
?>