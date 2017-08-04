<?php

    $data = array();
    $siteID = $_GET['siteId'];
    $error = false;
    $files = array();


    $uploaddir = '../../uploads/temporary/' . $siteID . '/'; // . - текущая папка где находится submit.php
    //echo $uploaddir;
    // Создадим папку если её нет

    if (!is_dir($uploaddir)) {
        mkdir( $uploaddir, 0777 );
    }

    // переместим файлы из временной директории в указанную
    foreach( $_FILES as $file ){
        if ( move_uploaded_file( $file['tmp_name'], $uploaddir . basename($file['name']) ) ){
            $files[] = array(
                'title' => $file['name'],
                'value' => '/uploads/temporary/' . $siteID . '/' . $file['name']
            );
        }
        else{
            $error = true;
        }
    }

    $data = $error ? array('error' => 'Ошибка загрузки файлов.') : array('files' => $files );
    echo json_encode( $data );

?>