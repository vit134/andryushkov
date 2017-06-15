<?php
    include '../../core/config.php';
    include '../../core/dbconnect.php';

    require_once 'vendor/autoload.php';

    $loader = new Twig_Loader_Filesystem('../../tmp');
    $twig = new Twig_Environment($loader, array(
        'debug' => true
    ));

    $twig->addExtension(new Twig_Extension_Debug());

    $id = $_GET['site'];
    //echo $id;

    $siteTypesQuery = "SELECT * FROM `sites` WHERE" . "'" . $id . "' in (`id`, `alias`)";
    $siteTypesResult = $mysqli->query($siteTypesQuery);
   //echo $siteTypesResult;
    foreach ($siteTypesResult as $key => $row) {
        foreach ($row as $keyRow => $valueRow) {
            if ($keyRow == 'tags' && $valueRow != '') {
                $tags = explode(',', trim($valueRow));
                $data['site'][$keyRow] = $tags;
            } else {
                $data['site'][$keyRow] = $valueRow;
            }

        }
    }

    /*echo '<h1>' . $data['site']['name'] . '</h1>';

    echo '<pre>';
    var_dump($data);
    echo '<pre>';*/

    echo $twig->render('layout/layout_sites.html', array('data' => $data['site']));

?>