<?php
    include '../../core/config.php';
    include SITE_PATH . 'core/dbconnect.php';

    require_once 'd:/OpenServer/modules/php/PHP-5.6/vendor/autoload.php';

    /*$loader = new Twig_Loader_String();
    $twig = new Twig_Environment($loader);*/

    $loader = new Twig_Loader_Filesystem('../tmp');
    $twig = new Twig_Environment($loader, array(
        'cache' => '../compilation_cache',
    ));

    $getAllFieldQuery = 'SELECT * FROM `sites`';

    /*if ($result = $mysqli->query($getAllFieldQuery)) {

        for ($i = 0; $result->field_count > $i; ++$i) {
            $finfo = $result->fetch_field_direct($i);
            $sitesMetaData[$finfo->name] = array(
                'type' => getMysqlFieldType($finfo->type),
                'length' => $finfo->length
            );
        }
    }*/

    if ($result = $mysqli->query($getAllFieldQuery)) {
        echo $twig->render('add-edit-site.html', array('name' => 'Fabien'));
    }

?>