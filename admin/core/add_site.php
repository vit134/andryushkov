<?php 
    include '../../core/dbconnect.php';

    if (count($_POST) != 0){
        $formFields = $_POST;
    }

    if ($formFields['date_create'] != '') {
      $dateCreate = date("Y-m-d H:i:s", strtotime($formFields['date_create']));
    } else {
      $dateCreate = '';
    }

    if ($formFields['form_type'] == 'add_site') {
        $addSiteQuery = "INSERT INTO `sites`(`id`, `name`, `description`, `type`, `author`, `date_create`, `design_raiting`, `alias`) VALUES ('','". $formFields['site_name'] ."','". $formFields['site_description'] ."','". $formFields['site_type'] ."','". $formFields['site_author'] ."','". $dateCreate ."','". $formFields['design_raiting'] ."', '". $formFields['alias'] ."')";

        if ($mysqli->query($addSiteQuery)) {
            header('Location: /andryushkov/admin/index.php');
            exit();
        };
    }
?>