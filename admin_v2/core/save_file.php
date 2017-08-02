<?php

/*// Здесь нужно сделать все проверки передаваемых файлов и вывести ошибки если нужно

// Переменная ответа

$data = array();
$siteID = $_POST['siteId'];



if( isset( $_GET['uploadfiles'] ) ){
    $error = false;
    $files = array();

    $uploaddir = '/uploads/'; // . - текущая папка где находится submit.php

    // Создадим папку если её нет

    if( ! is_dir( $uploaddir ) ) mkdir( $uploaddir, 0777 );

    // переместим файлы из временной директории в указанную
    foreach( $_FILES as $file ){
        if( move_uploaded_file( $file['tmp_name'], $uploaddir . basename($file['name']) ) ){
            $files[] =  $uploaddir . $file['name'];
        }
        else{
            $error = true;
        }
    }

    $data = $error ? array('error' => 'Ошибка загрузки файлов.') : array('files' => $files );
    echo '=---' . $siteId . '---';
    echo json_encode( $data );
}*/
  /*******************************************************
   * Only these origins will be allowed to upload images *
   ******************************************************/
  $accepted_origins = array("http://andryushkov", "http://192.168.1.1", "http://example.com");

  /*********************************************
   * Change this line to set the upload folder *
   *********************************************/
  $imageFolder = "../../uploads/temporary/" . $_GET['siteid'] . '/';

  reset ($_FILES);
  $temp = current($_FILES);
  if (is_uploaded_file($temp['tmp_name'])){
    if (isset($_SERVER['HTTP_ORIGIN'])) {
      // same-origin requests won't set an origin. If the origin is set, it must be valid.
      if (in_array($_SERVER['HTTP_ORIGIN'], $accepted_origins)) {
        header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
      } else {
        header("HTTP/1.0 403 Origin Denied");
        return;
      }
    }

    /*
      If your script needs to receive cookies, set images_upload_credentials : true in
      the configuration and enable the following two headers.
    */
    // header('Access-Control-Allow-Credentials: true');
    // header('P3P: CP="There is no P3P policy."');

    // Sanitize input
    if (preg_match("/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $temp['name'])) {
        header("HTTP/1.0 500 Invalid file name.");
        return;
    }

    // Verify extension
    if (!in_array(strtolower(pathinfo($temp['name'], PATHINFO_EXTENSION)), array("gif", "jpg", "png"))) {
        header("HTTP/1.0 500 Invalid extension.");
        return;
    }

    // Accept upload if there was no origin, or if it is an accepted origin
    $filetowrite = $imageFolder . $temp['name'];

    if (!file_exists($imageFolder)) {
        mkdir($imageFolder, 0700, true);
    }

    if (move_uploaded_file($temp['tmp_name'], $filetowrite)) {

        // Respond to the successful upload with JSON.
        // Use a location key to specify the path to the saved image resource.
        // { location : '/your/uploaded/image/file'}
        echo json_encode(array('location' => '/uploads/temporary/' . $_GET['siteid'] . '/' . $temp['name']));
    } else {
        echo json_encode(array('status' => 'error'));
    }
  } else {
    // Notify editor that the upload failed
    header("HTTP/1.0 500 Server Error");
  }

?>