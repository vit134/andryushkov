<?php
    include '../core/config.php';
    include SITE_PATH . 'core/dbconnect.php';

    require_once '/vendor/autoload.php';

    $loader = new Twig_Loader_Filesystem('tmp');
    $twig = new Twig_Environment($loader, array(
        'debug' => true
    ));

    $twig->addExtension(new Twig_Extension_Debug());

    $indexData = array();
    $route;

    /*function route() {
        $params = $_GET;

        return $params['page'];
    }*/

    function route() {
        $url = $_SERVER['REQUEST_URI'];
        //echo $url;
        $url = str_replace('/admin/', "", $url);

        return array_splice(explode('/', $url), 0);
    }


    function getEditSiteData($id) {
        if ($id != '') {
            global $mysqli, $indexData;

            $editSiteQuery = 'SELECT * FROM `sites` WHERE `id` like ' .  (integer) $id;

            $editSiteResult = $mysqli->query($editSiteQuery);

            if ($editSiteResult) {
                foreach ($editSiteResult as $key => $row) {
                    //echo $row;
                    $indexData['edit_site'] = $row;
                }
            } else {
                echo 'false';
            }
            //var_dump($row1);


        } else {
            echo 'no ID';
        }

    }

    function getEditTemplateData($id) {
        if ($id != '') {
            global $mysqli, $indexData;

            $editSiteQuery = 'SELECT * FROM `templates` WHERE `id` like ' .  (integer) $id;

            $editSiteResult = $mysqli->query($editSiteQuery);

            if ($editSiteResult) {
                foreach ($editSiteResult as $key => $row) {
                    //echo $row;
                    $indexData['edit_template'] = $row;
                }
            } else {
                echo 'false';
            }
            //var_dump($row1);
        } else {
            echo 'no ID';
        }

        return $indexData['edit_template'];

    }

    function init() {
        global $route, $indexData;

        getSiteTypes();
        getSiteTags();
        getUsers();
        getSite();
        getTemplates();
        $indexData['route'] = $route = route();
        //var_dump($indexData);
    }

    init();

    if ($route[0] == 'edit_site') {

        $editSiteId = $route[1];
        getEditSiteData($editSiteId);
    }


    switch ($route[0]) {
         case 'templates':
            if ( $route[1] == '' ) {
                echo $twig->render('pages/'. $route[0] .'/index.html', array('data' => $indexData));
            } else if ($route[1] == 'edit_template')  {
                echo $twig->render('pages/' . $route[0] . '/' .$route[1].'.html', array('data' =>  getEditTemplateData($route[2])));
            } else  {
                echo $twig->render('pages/' . $route[0] . '/' .$route[1].'.html', array('data' => $indexData));
            }
            break;
        case 'pages':
            echo $twig->render('pages/' . $route[0] . '/' .$route[1].'.html', array('data' => $indexData));
            break;
        case 'sites':
            echo $twig->render('pages/'. $route[1] .'.html', array('data' => $indexData));
            break;
        case '':
            echo $twig->render('pages/index.html', array('data' => $indexData));
            break;
    }

?>


